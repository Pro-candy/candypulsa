<?php

namespace App\Http\Controllers\Ngaji;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

class IosiControllerNgaji extends Controller
{
    public function show($surat, $ayat)
    {
        try {
            $client = new Client();
            $response = $client->get("https://quran.nu.or.id/{$surat}");
            $html = (string) $response->getBody();

            $crawler = new Crawler($html);

            // Ambil semua ayat dari halaman surat (untuk tahu jumlah ayat)
            $jumlahAyat = $crawler->filter('div[id]')->count();

            // Sekarang fetch halaman detail ayat
            $responseDetail = $client->get("https://quran.nu.or.id/{$surat}/{$ayat}");
            $htmlDetail = (string) $responseDetail->getBody();
            $detailCrawler = new Crawler($htmlDetail);

            $arabic = $detailCrawler->filter('span.__className_6952f9')->first()?->text() ?? '';
            $latin = $detailCrawler->filter('span.text-primary-500')->first()?->text() ?? '';
            $terjemah = $detailCrawler->filter('span.text-neutral-700')->first()?->text() ?? '';
            $tafsir = $detailCrawler->filter('div.border span.text-neutral-700')->first()?->text() ?? '';

            // Navigasi ayat
            $ayat = (int) $ayat;
            $prevAyat = $ayat > 1 ? ['slug' => $surat, 'ayat' => $ayat - 1] : null;
            $nextAyat = $ayat < $jumlahAyat ? ['slug' => $surat, 'ayat' => $ayat + 1] : null;

            return view('ngaji.show', compact(
                'surat',
                'ayat',
                'arabic',
                'latin',
                'terjemah',
                'tafsir',
                'prevAyat',
                'nextAyat'
            ));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data'], 500);
        }
    }

}
