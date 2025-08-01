<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul', 'isi', 'tipe', 'mulai', 'berakhir', 'prioritas', 'status'
    ];

    protected $casts = [
        'mulai' => 'datetime',
        'berakhir' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke pengumuman_read
    public function reads()
    {
        return $this->hasMany(PengumumanRead::class, 'pengumuman_id');
    }
}