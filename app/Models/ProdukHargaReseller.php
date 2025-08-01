<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukHargaReseller extends Model
{
    protected $table = 'produk_harga_reseller';

    public $timestamps = false; // <- ini penting untuk mencegah error

    protected $fillable = [
        'reseller_id',
        'produk_kode',
        'harga_jual',
    ];

    public function produk()
    {
        return $this->belongsTo(\App\Models\Produk::class, 'produk_kode', 'kode');
    }

    public function reseller()
    {
        return $this->belongsTo(\App\Models\Reseller::class, 'reseller_id');
    }
}
