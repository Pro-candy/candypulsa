<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InboxReseller extends Model
{
    protected $table = 'inbox_reseller';

    protected $fillable = [
        'reseller_kode',
        'channel',
        'nomor_tujuan',
        'kode_produk',
        'pengulangan',
        'pin',
        'trx_code',
        'pesan',
        'status',
        'transaksi_id',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}