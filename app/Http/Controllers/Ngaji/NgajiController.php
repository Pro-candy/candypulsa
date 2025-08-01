<?php
namespace App\Http\Controllers\Ngaji;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

class NgajiController extends Controller
{
    public function index()
    {
        $surat = json_decode(file_get_contents(storage_path('quran/surat.json')), true);
        return view('ngaji.surat', compact('surat'));
    }

    public function surat($slug)
    {
        $list = json_decode(file_get_contents(storage_path('quran/surat.json')), true);
        $data = json_decode(file_get_contents(storage_path("quran/{$slug}.json")), true);

        if (!is_array($data)) abort(500, 'File surat tidak ditemukan atau rusak');

        $index = collect($list)->search(fn($s) => $s['slug'] === $slug);
        $prev = $index > 0 ? $list[$index - 1] : null;
        $next = $index < count($list) - 1 ? $list[$index + 1] : null;

        return view('ngaji.surat-detail', [
            'surat' => $data,
            'prevSurat' => $prev,
            'nextSurat' => $next,
        ]);
    }


public function ayat($slug, $ayat)
{
    $list = json_decode(file_get_contents(storage_path('quran/surat.json')), true);
    $meta = collect($list)->firstWhere('slug', $slug);
    if (!$meta) abort(404, 'Surat tidak ditemukan');

    $path = storage_path("quran/{$slug}.json");
    if (!file_exists($path)) abort(404, 'File surat tidak ditemukan');

    $data = json_decode(file_get_contents($path), true);
    if (!isset($data['ayat'])) abort(500, 'Struktur surat tidak valid');

    $ayat = (int) $ayat;
    $index = collect($list)->search(fn($s) => $s['slug'] === $slug);
    $jumlahAyat = count($data['ayat']);

    $ayatData = collect($data['ayat'])->firstWhere('ayat', $ayat);
    if (!$ayatData) abort(404, 'Ayat tidak ditemukan');

    // Ambil tafsir dari quran.nu.or.id
    try {
        $client = new \GuzzleHttp\Client();
        $res = $client->get("https://quran.nu.or.id/{$slug}/{$ayat}");
        $html = (string) $res->getBody();
        $crawler = new Crawler($html);

        $ayatData['teks'] = $crawler->filter('span.__className_6952f9')->first()?->text() ?? $ayatData['teks'];
        $ayatData['latin'] = $crawler->filter('span.text-primary-500')->first()?->text() ?? $ayatData['latin'];
        $ayatData['terjemah'] = $crawler->filter('span.text-neutral-700')->first()?->text() ?? $ayatData['terjemah'];
        $ayatData['tafsir'] = $crawler->filter('div.border span.text-neutral-700')->first()?->text() ?? null;
    } catch (\Exception $e) {
        // Biarkan data tetap dari lokal jika scraping gagal
    }

    // Navigasi Prev
    $prevAyat = null;
    if ($ayat > 1) {
        $prevAyat = ['slug' => $slug, 'ayat' => $ayat - 1];
    } elseif ($index > 0) {
        $prevSurat = $list[$index - 1];
        $prevDataPath = storage_path("quran/{$prevSurat['slug']}.json");
        if (file_exists($prevDataPath)) {
            $prevData = json_decode(file_get_contents($prevDataPath), true);
            $prevAyat = [
                'slug' => $prevSurat['slug'],
                'ayat' => count($prevData['ayat']),
            ];
        }
    }

    // Navigasi Next
    $nextAyat = null;
    if ($ayat < $jumlahAyat) {
        $nextAyat = ['slug' => $slug, 'ayat' => $ayat + 1];
    } elseif ($index < count($list) - 1) {
        $nextSurat = $list[$index + 1];
        $nextDataPath = storage_path("quran/{$nextSurat['slug']}.json");
        if (file_exists($nextDataPath)) {
            $nextAyat = [
                'slug' => $nextSurat['slug'],
                'ayat' => 1,
            ];
        }
    }

    $surat = [
        'slug' => $slug,
        'nama_latin' => $data['nama_latin'] ?? '',
        'jumlah_ayat' => $data['jumlah_ayat'] ?? $jumlahAyat,
        'arti' => $data['arti'] ?? '',
    ];

    return view('ngaji.show', compact(
        'surat', 'ayat', 'ayatData', 'prevAyat', 'nextAyat'
    ));
}

   
}
