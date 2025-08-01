<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundTransaksiTokoReseller extends Model
{
    protected $table = 'refund_transaksi_toko_reseller';

    protected $fillable = [
        'transaksi_id',
        'reseller_id',
        'pelanggan_id',
        'jumlah',
        'tanggal_refund',
        'alasan',
        'keterangan',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiTokoReseller::class, 'transaksi_id');
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(PelangganTokoReseller::class, 'pelanggan_id');
    }
}
