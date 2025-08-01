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

        $tables = array_map(function ($row) use ($tableKey) {
            return $row->$tableKey;
        }, $rawTables);


        foreach ($tables as $table) {
            if (in_array($table, $this->skipTables)) {
                $this->warn("Lewati tabel: $table");
                continue;
            }

            $this->info("Backup tabel: $table");

            $rows = DB::table($table)->get();

            foreach ($rows as $row) {
                $array = (array) $row;
                $primaryKey = $array['id'] ?? uniqid();

                $db->getReference($table . '/' . $primaryKey)->set($array);
            }
        }

        $this->info("✅ Backup seluruh database ke Firebase selesai!");
    }
}
