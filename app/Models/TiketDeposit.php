<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiketDeposit extends Model
{
    protected $table = 'tiket_deposit';

    protected $fillable = [
        'kode_tiket',
        'reseller_id',
        'tgl_ambil_tiket',
        'jumlah',
        'kode_bank',
        'status',
        'kode_inbox_reseller',
        'mutasi_bank_id',
        'catatan_admin',
    ];

    protected $casts = [
        'tgl_ambil_tiket' => 'datetime',
        'jumlah' => 'decimal:4',
    ];

    // Relasi ke reseller (jika kamu punya model Reseller)
    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}
