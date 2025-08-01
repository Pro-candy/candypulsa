<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\FirebaseHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class RestoreFromFirebase extends Command
{
    protected $signature = 'restore:from-firebase';
    protected $description = 'Restore seluruh data dari Firebase Realtime Database ke database lokal';

    public function handle()
    {
        $this->info("\n🚀 Memulai restore seluruh data dari Firebase sesuai urutan...");

        $this->ensureDatabaseExists();

        $firebase = FirebaseHelper::database();
        $data = $firebase->getReference()->getValue();

        if (!$data) {
            $this->warn("⚠️  Tidak ada data di Firebase.");
            return;
        }

        $restoreOrder = [
            'admin',
            'product_categories',
            'operator',
            'produk',
            'products',
            'parameter',
            'supplier_reseller',
            'reseller',
            'pengirim'
        ];

        $orderedTables = array_merge(
            array_intersect($restoreOrder, array_keys($data)),
            array_diff(array_keys($data), $restoreOrder)
        );

        foreach ($orderedTables as $table) {
            $rows = $data[$table] ?? null;

            if (!$rows) {
                $this->warn("⚠️  Data untuk tabel '$table' tidak ditemukan. Lewati...");
                continue;
            }

            if (!Schema::hasTable($table)) {
                $this->warn("⚠️  Tabel '$table' tidak ditemukan di database lokal. Lewati...");
                continue;
            }

            if (!is_array($rows)) {
                $this->warn("⚠️  Data untuk tabel '$table' bukan array. Lewati...");
                continue;
            }

            // Normalize
            if ($this->isAssoc($rows)) {
                $first = reset($rows);
                if (is_array($first)) {
                    $rows = array_values($rows);
                } else {
                    $rows = [$rows];
                }
            } elseif (!is_array(reset($rows))) {
                $this->warn("⚠️  Format data Firebase untuk tabel '$table' tidak valid. Lewati...");
                $this->line("↪️  Contoh isi: [" . var_export(reset($rows), true) . "]");
                \Log::warning("Format salah tabel $table", ['rows' => $rows]);
                continue;
            }

            Schema::disableForeignKeyConstraints();
            DB::table($table)->truncate();
            Schema::enableForeignKeyConstraints();

            $chunks = array_chunk($rows, 500);
            foreach ($chunks as $chunk) {
                $clean = array_map(function ($row) use ($table) {
                    return $this->sanitizeRow($row, $table);
                }, $chunk);
                DB::table($table)->insert($clean);
            }

            $this->info("✅ Tabel '$table' berhasil direstore (" . count($rows) . " baris).");
        }

        $this->info("\n🎉 Restore selesai tanpa error!");
    }

    private function sanitizeRow(array $row, string $table): array
    {
        $columns = Schema::getColumnListing($table);
        $cleanRow = [];

        foreach ($columns as $col) {
            $value = $row[$col] ?? null;

            if (is_array($value)) {
                if ($this->isNumericArray($value)) {
                    $value = implode(',', $value);
                } else {
                    $value = json_encode($value);
                }
            }

            if (is_object($value)) {
                $value = json_encode($value);
            }

            if (is_string($value)) {
                $value = trim($value);
            }

            $cleanRow[$col] = $value;
        }

        return $cleanRow;
    }

    private function isNumericArray(array $arr): bool
    {
        return array_keys($arr) === range(0, count($arr) - 1);
    }

    private function isAssoc(array $arr): bool
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    private function ensureDatabaseExists()
    {
        $dbname = DB::connection()->getConfig('database');
        $charset = DB::connection()->getConfig('charset') ?? 'utf8mb4';
        $collation = DB::connection()->getConfig('collation') ?? 'utf8mb4_unicode_ci';

        try {
            DB::statement("USE `$dbname`");
        } catch (\Exception $e) {
            $this->warn("⚠️  Database '$dbname' tidak ditemukan. Mencoba membuat...");
            DB::statement("CREATE DATABASE `$dbname` CHARACTER SET $charset COLLATE $collation");
            DB::statement("USE `$dbname`");
            Artisan::call('migrate');
            $this->info("✅ Database '$dbname' berhasil dibuat dan dimigrasi.");
        }
    }
}
