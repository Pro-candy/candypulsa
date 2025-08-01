<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeSuratJson extends Command
{
    protected $signature = 'make:surat';
    protected $description = 'Buat ulang surat.json berdasarkan file JSON surat hasil scraping';

    public function handle()
    {
        $path = storage_path('quran');
        $files = glob("$path/*.json");

        $suratList = [];

        foreach ($files as $file) {
            // Lewati surat.json itu sendiri
            if (basename($file) === 'surat.json') continue;

            $data = json_decode(file_get_contents($file), true);

            if (
                empty($data['nama_latin']) ||
                empty($data['arti']) ||
                empty($data['jumlah_ayat']) ||
                empty($data['slug'])
            ) {
                $this->warn("⚠️ Melewati file tidak valid: " . basename($file));
                continue;
            }

            $suratList[] = [
                'nama_latin' => $data['nama_latin'],
                'arti' => $data['arti'],
                'jumlah_ayat' => $data['jumlah_ayat'],
                'slug' => $data['slug'],
            ];
        }

        // Urutkan berdasarkan nama_latin atau slug jika belum ada urutan
        usort($suratList, fn($a, $b) => strcmp($a['slug'], $b['slug']));

        // Tambahkan nomor urut
        foreach ($suratList as $i => &$s) {
            $s['nomor'] = $i + 1;
        }

        $targetFile = "$path/surat.json";
        file_put_contents($targetFile, json_encode($suratList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info("✅ Berhasil membuat $targetFile dengan " . count($suratList) . " surat.");
    }
}
