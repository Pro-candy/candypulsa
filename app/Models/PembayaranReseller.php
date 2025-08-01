<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranReseller extends Model
{
    protected $table = 'pembayaran_reseller';

    protected $fillable = [
        'transaksi_id',
        'pelanggan_id',
        'reseller_id',
        'jumlah_bayar',
        'tanggal_bayar',
        'metode_pembayaran',
        'keterangan',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiTokoReseller::class, 'transaksi_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(PelangganTokoReseller::class, 'pelanggan_id');
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}
