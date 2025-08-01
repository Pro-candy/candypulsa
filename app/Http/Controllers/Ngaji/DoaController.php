<?php

namespace App\Http\Controllers\Ngaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class DoaController extends Controller
{
    public function index()
    {
        $url = 'https://quran.nu.or.id/doa';
        $html = Http::get($url)->body();

        $crawler = new Crawler($html);

        $doaList = $crawler->filter('.nui-CardDoa')->each(function ($node) {
            // Ambil parent <a> node
            $linkNode = $node->getNode(0)->parentNode;
            $slug = $linkNode->getAttribute('href');

            $crawler = new \Symfony\Component\DomCrawler\Crawler($node->outerHtml());

            $title = $crawler->filter('h2')->text();
            $count = $crawler->filter('span.text-xs')->text();
            $number = $crawler->filter('span.text-xl')->text();

            return [
                'nomor' => trim($number),
                'judul' => trim($title),
                'slug' => trim($slug),
                'jumlah' => trim($count),
            ];
        });


        return view('doa.index', compact('doaList'));
    }
    

    public function show($slug)
    {
        $url = "https://quran.nu.or.id/doa/{$slug}";
        $response = Http::get($url);

        if (!$response->ok()) {
            abort(404, 'Doa tidak ditemukan');
        }

        $html = $response->body();
        $crawler = new \Symfony\Component\DomCrawler\Crawler($html);

        // Ambil judul
        $judul = $crawler->filter('h1')->first()->text('');

        // Ambil daftar bacaan doa
        $bacaanList = $crawler->filter('.nui-CardDoaItem')->each(function ($node) {
            $sub = $node->filter('h2')->text('');
            $arab = $node->filter('.arab')->text('');
            $latin = $node->filter('.latin')->text('');
            $arti = $node->filter('.arti')->text('');

            return [
                'judul' => trim($sub),
                'arab' => trim($arab),
                'latin' => trim($latin),
                'arti' => trim($arti),
            ];
        });

        return view('doa.detail', compact('judul', 'bacaanList'));
    }

    public function detail($slug)
{
    $url = "https://quran.nu.or.id/doa/$slug";
    $html = Http::get($url)->body();

    $crawler = new Crawler($html);

    $judul_kumpulan = $crawler->filter('.text-center.space-y-2.mb-5 h1')->text();
    $total_bacaan = $crawler->filter('.text-center.space-y-2.mb-5 span')->text();

    $doaList = [];

    // Ambil semua <div> yang berisi daftar bacaan doa
    $sections = $crawler->filter('.max-w-screen-lg.mx-auto.mt-5')->children();

    for ($i = 0; $i < $sections->count(); $i += 2) {
        $judulDoa = $sections->eq($i)->filter('h1')->text();

        $doaContent = $sections->eq($i + 1)->filter('.flex.flex-col.space-y-3');
        $arab = $doaContent->filter('span')->eq(0)->text();
        $latin = $doaContent->filter('span')->eq(1)->text();
        $terjemahan = $doaContent->filter('span')->eq(2)->text();

        $doaList[] = [
            'judul' => $judulDoa,
            'arab' => $arab,
            'latin' => $latin,
            'terjemahan' => $terjemahan,
        ];
    }

    return view('doa.detail', [
        'judul' => $judul_kumpulan,
        'jumlah' => $total_bacaan,
        'doaList' => $doaList,
    ]);
}
}
