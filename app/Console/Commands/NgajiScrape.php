<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class NgajiScrape extends Command
{
    protected $signature = 'ngaji:scrape {slug?} {--all}';
    protected $description = 'Scrape surat dari quran.nu.or.id dan simpan sebagai JSON';

    public function handle()
    {
        if ($this->option('all')) {
            $this->info('🔍 Mengambil daftar surat dari https://quran.nu.or.id/ ...');
            $client = HttpClient::create();
            $response = $client->request('GET', 'https://quran.nu.or.id/');
            $html = $response->getContent();
            $crawler = new Crawler($html);

            $links = $crawler->filter('a.line-clamp-1');
            $suratList = [];

            foreach ($links as $index => $link) {
                $href = $link->getAttribute('href'); // misalnya: /al-maidah
                $slug = ltrim($href, '/');

                $title = $link->getAttribute('title');
                $text = $link->textContent; // untuk nomor di dalam span

                $nomor = null;
                $numNode = (new Crawler($link))->filter('span.text-xl.font-bold');
                if ($numNode->count()) {
                    $nomor = (int) trim($numNode->text());
                }

                if ($slug && $nomor) {
                    $suratList[] = [
                        'slug' => $slug,
                        'nomor' => $nomor
                    ];
                }
            }

            foreach ($suratList as $surat) {
                $slug = $surat['slug'];
                $nomor = $surat['nomor'];
                $this->info("🔄 Scraping: $slug");
                $this->scrapeSlug($slug, $nomor);
            }

            $this->info('✅ Semua surat berhasil disimpan!');
        } else {
            $slug = $this->argument('slug');
            if (!$slug) {
                $this->error('❌ Slug tidak boleh kosong kecuali pakai --all');
                return;
            }

            $this->scrapeSlug($slug);
            $this->info("✅ Selesai untuk: $slug");
        }
    }

    private function scrapeSlug($slug)
    {
        $url = "https://quran.nu.or.id/{$slug}";
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $html = $response->getContent();
        $crawler = new Crawler($html);

        // ✅ Ambil info surat: nama, arti, jumlah ayat
        $titleNode = $crawler->filter('.text-center .mb-10');
        $namaLatin = $titleNode->filter('h1')->text('');
        $infoText = $titleNode->filter('span')->text(''); // contoh: "Makkiyah · 7"
        [$tipe, $jumlahAyat] = explode('·', $infoText . '·');
        $jumlahAyat = trim($jumlahAyat);
        $tipe = trim($tipe);

        // ✅ Ambil daftar ayat
        $results = [];

        $crawler->filter('div.flex.flex-col.space-y-3')->each(function ($node) use (&$results) {
            $arabFull = $node->filter('span[dir="rtl"]')->text('');

            // Tetap ambil nomor (jika dibutuhkan terpisah)
            preg_match('/۝([٠-٩]+)/u', $arabFull, $match);
            $nomor = isset($match[1]) ? arabicToInteger($match[1]) : null;

            // ❌ Jangan hapus nomor lingkaran dari teks
            $arab = trim($arabFull);

            $latin = trim($node->filter('span.text-primary-500')->text(''));
            $terjemah = trim($node->filter('span.text-neutral-700')->text(''));

            $results[] = [
                'ayat' => $nomor,
                'arab' => $arab, // Sudah mengandung ۝١
                'latin' => $latin,
                'terjemah' => $terjemah,
            ];
        });

        $data = [
            'nama_latin' => $namaLatin,
            'arti' => $tipe,
            'jumlah_ayat' => (int) $jumlahAyat,
            'slug' => $slug,
            'ayat' => $results,
        ];

        $path = storage_path("quran/{$slug}.json");
        file_put_contents($path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}

// Fungsi bantu untuk konversi angka Arab ke Latin
function arabicToInteger($arabic)
{
    $map = ['٠'=>'0','١'=>'1','٢'=>'2','٣'=>'3','٤'=>'4','٥'=>'5','٦'=>'6','٧'=>'7','٨'=>'8','٩'=>'9'];
    return (int) strtr($arabic, $map);
}
