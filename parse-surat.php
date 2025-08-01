<?php

$dir = __DIR__ . '/storage/quran';
$files = glob("$dir/*.json");
$results = [];

foreach ($files as $file) {
    $json = json_decode(file_get_contents($file), true);

    if (!isset($json['nomor'], $json['nama_latin'], $json['arti'], $json['jumlah_ayat'], $json['slug'])) {
        echo "⚠️ Struktur tidak lengkap di: " . basename($file) . "\n";
        continue;
    }

    $results[] = [
        'nomor' => (int) $json['nomor'],
        'nama_latin' => $json['nama_latin'],
        'arti' => $json['arti'],
        'jumlah_ayat' => (int) $json['jumlah_ayat'],
        'slug' => $json['slug'],
    ];
}

usort($results, fn($a, $b) => $a['nomor'] <=> $b['nomor']);

file_put_contents("$dir/surat.json", json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo "🎉 surat.json berhasil dibuat berdasarkan nomor surat!\n";
