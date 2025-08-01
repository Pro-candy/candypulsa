<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Helpers\FirebaseHelper;

class FullBackupToFirebase extends Command
{
    protected $signature = 'backup:all-to-firebase';
    protected $description = 'Backup semua isi tabel ke Firebase Realtime Database';

    protected $skipTables = [
        'migrations', 'sessions', 'failed_jobs', 'jobs', 'job_batches',
        'cache', 'cache_locks', 'password_reset_tokens'
    ];

    public function handle()
    {
        $db = FirebaseHelper::database();
        $rawTables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . DB::getDatabaseName(); // contoh: Tables_in_candypulsa

        $tables = array_map(fn($row) => $row->$tableKey, $rawTables);

        foreach ($tables as $table) {
            if (in_array($table, $this->skipTables)) {
                $this->warn("Lewati tabel: $table");
                continue;
            }

            $this->info("🔄 Backup tabel: $table");

            $rows = DB::table($table)->get()->map(function ($row) {
                return array_map(function ($value) {
                    return is_array($value) ? implode(',', $value) : $value;
                }, (array) $row);
            });

            foreach ($rows as $row) {
                $array = (array) $row;

                foreach ($array as $key => $val) {
                    if (is_array($val)) {
                        $array[$key] = implode(',', $val); // sudah benar
                    }
                }

                // PERBAIKAN UTAMA:
                if (isset($array['prefix_tujuan']) && is_string($array['prefix_tujuan'])) {
                    // hilangkan spasi tak perlu
                    $array['prefix_tujuan'] = trim($array['prefix_tujuan']);
                    // jika array koma TANPA kutip, kita pastikan tidak akan meledak di restore
                    $array['prefix_tujuan'] = str_replace(["\n", "\r"], '', $array['prefix_tujuan']);
                }

                $primaryKey = $array['id'] ?? uniqid();
                $db->getReference($table . '/' . $primaryKey)->set($array);
            }

        }

        $this->info("✅ Backup seluruh database ke Firebase selesai! mantap boss");
    }
}
