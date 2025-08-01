<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama',
        'harga_jual',
        'harga_beli',
        'kode_operator',
        'kategori_id',
        'aktif',
        'gangguan',
        'nominal',
        'fisik',
        'postpaid',
        'qty',
        'poin',
        'link_gambar',
    ];

    // Relasi ke Operator
    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class, 'kode_operator', 'kode');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(\App\Models\ProductCategory::class, 'kategori_id', 'id');
    }

    // Harga khusus reseller (one-to-one, lazy load, opsional)
    public function hargaReseller($resellerId = null)
    {
        $resellerId = $resellerId ?? auth()->guard('reseller')->id();
        return $this->hasOne(\App\Models\ProdukHargaReseller::class, 'produk_kode', 'kode')
            ->where('reseller_id', $resellerId);
    }
}