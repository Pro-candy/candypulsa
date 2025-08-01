<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\FirebaseHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class RestoreAdminCategories extends Command
{
    protected $signature = 'restore:admin-categories';
    protected $description = "Restore data 'admin' dan 'product_categories' dari Firebase sesuai urutan dan lanjutkan dengan tabel lain";

    public function handle()
    {
        $this->info("\n🚀 Memulai restore seluruh data dari Firebase sesuai urutan...");

        $this->ensureDatabaseExists();

        $firebase = FirebaseHelper::database();

        $restoreOrder = [
            'admin',
            'product_categories',
            'operator',
            'produk',
            'products',
            'parameter',
            'reseller',
            'supplier_reseller',
            'pengirim',
            'pengumuman',
            'pengumuman_read'
        ];

        $firebaseKeys = $firebase->getReference()->getChildKeys();
        $orderedTables = array_merge(
            array_intersect($restoreOrder, $firebaseKeys),
            array_diff($firebaseKeys, $restoreOrder)
        );

        foreach ($orderedTables as $table) {
            $snapshot = $firebase->getReference($table)->getSnapshot();

            if (!$snapshot->exists()) {
                $this->warn("⚠️  Data untuk tabel '$table' tidak tersedia di Firebase. Lewati...");
                continue;
            }

            $rows = $snapshot->getValue();

            if (!is_array($rows)) {
                $rows = [$rows];
            }

            // Ambil hanya data yang array valid
            $rows = array_filter($rows, fn($row) => is_array($row) && !empty($row));
            $rows = array_values($rows);

            if (empty($rows)) {
                $this->warn("⚠️  Tidak ada baris valid untuk tabel '$table'. Lewati...");
                continue;
            }

            if (!Schema::hasTable($table)) {
                $this->warn("⚠️  Tabel '$table' tidak ditemukan di database lokal. Lewati...");
                continue;
            }

            Schema::disableForeignKeyConstraints();
            DB::table($table)->truncate();
            Schema::enableForeignKeyConstraints();

            $chunks = array_chunk($rows, 500);
            foreach ($chunks as $chunk) {
                $chunk = array_map(function ($row) use ($table) {
                    return $this->sanitizeRow($row, $table);
                }, $chunk);
                DB::table($table)->insert($chunk);
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
        $database = DB::getDatabaseName();
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
