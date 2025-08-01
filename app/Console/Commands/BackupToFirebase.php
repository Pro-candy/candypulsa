<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\FirebaseHelper;
use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\TransaksiPulsa;
use App\Models\ProductCategory;
use App\Models\ProdukRiwayatStok;

class BackupToFirebase extends Command
{
    protected $signature = 'backup:to-firebase';
    protected $description = 'Backup seluruh data dari database ke Firebase';

    public function handle()
    {
        $db = FirebaseHelper::database();

        // Produk
        $this->info('Menyinkronkan produk...');
        $products = Product::all();
        foreach ($products as $product) {
            $db->getReference('produk/' . $product->id)->set($product->toArray());
        }

        // Pelanggan
        $this->info('Menyinkronkan pelanggan...');
        $pelanggan = Pelanggan::all();
        foreach ($pelanggan as $p) {
            $db->getReference('pelanggan/' . $p->id)->set($p->toArray());
        }

        // Transaksi Pulsa
        $this->info('Menyinkronkan transaksi pulsa...');
        $transaksi = TransaksiPulsa::all();
        foreach ($transaksi as $trx) {
            $db->getReference('transaksi/' . $trx->id)->set($trx->toArray());
        }

        // Kategori Produk (opsional)
        $this->info('Menyinkronkan kategori produk...');
        $kategori = ProductCategory::all();
        foreach ($kategori as $kat) {
            $db->getReference('kategori/' . $kat->id)->set($kat->toArray());
        }

        // Riwayat Stok (opsional)
        $this->info('Menyinkronkan riwayat stok...');
        $riwayat = ProdukRiwayatStok::all();
        foreach ($riwayat as $r) {
            $db->getReference('stok_riwayat/' . $r->id)->set($r->toArray());
        }

        $this->info('✅ Backup selesai! yaang mantap boss okay ');
    }
}
