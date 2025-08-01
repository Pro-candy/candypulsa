<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTokoReseller extends Model
{
    protected $table = 'transaksi_toko_reseller';

    protected $fillable = [
        'reseller_id',
        'customer_id',
        'invoice_no',
        'tanggal_waktu',
        'total',
        'diskon',
        'pembayaran',
        'kembalian',
        'status',
        'jenis_pembayaran',
        'keterangan',
    ];

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function customer()
    {
        return $this->belongsTo(PelangganTokoReseller::class, 'customer_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksiTokoReseller::class, 'transaksi_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(PembayaranReseller::class, 'transaksi_id');
    }

    public function refunds()
    {
        return $this->hasMany(RefundTransaksiTokoReseller::class, 'transaksi_id');
    }
}
