<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiTokoReseller extends Model
{
    protected $table = 'detail_transaksi_toko_reseller';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'qty',
        'harga',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiTokoReseller::class, 'transaksi_id');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}
