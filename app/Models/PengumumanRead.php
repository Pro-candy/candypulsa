<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanRead extends Model
{
    protected $table = 'pengumuman_read';

    protected $fillable = [
        'pengumuman_id',
        'reseller_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    // Relasi ke Pengumuman
    public function pengumuman()
    {
        return $this->belongsTo(Pengumuman::class, 'pengumuman_id');
    }
}