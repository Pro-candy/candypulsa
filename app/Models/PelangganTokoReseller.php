<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class PelangganTokoReseller extends Model
{
    protected $table = 'pelanggan_toko_reseller';

    protected $fillable = [
        'reseller_id',
        'kode_pelanggan',
        'nama',
        'phone',
        'alamat',
        'email',
        'info_tambahan',
    ];

    public static function boot()
    {
        parent::boot();

        // Generate kode otomatis saat create jika kosong
        static::creating(function ($model) {
            if (empty($model->kode_pelanggan)) {
                // Ambil kode reseller (pastikan field 'kode' ada di model Reseller)
                $reseller = $model->reseller()->first();
                $kodeReseller = $reseller ? $reseller->kode : 'RSL';
                $model->kode_pelanggan = Helper::generateKodePelanggan($kodeReseller, $model->nama);
            }
        });
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiTokoReseller::class, 'customer_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(PembayaranReseller::class, 'pelanggan_id');
    }

    public function refund()
    {
        return $this->hasMany(RefundTransaksiTokoReseller::class, 'pelanggan_id');
    }
    
}
