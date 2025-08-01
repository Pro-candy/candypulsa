<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reseller extends Authenticatable
{
    use HasFactory;

    protected $table = 'reseller';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode', 'nama', 'nama_toko','alamat', 'kecamatan', 'kabupaten', 'provinsi', 'pin', 'password',
        'nomor_ktp', 'nomor_hp', 'email', 'link_foto_ktp', 'link_foto_profile', 'google_id',
        'aktif', 'saldo', 'saldo_minimal', 'poin', 'komisi', 'keterangan',
        'verify_token', 'verify_token_created_at', 'tgl_daftar', 'tgl_aktivitas', 'suspend', 'deleted'
    ];

    protected $hidden = [
        'password', 'pin', 'remember_token',
    ];

    protected $casts = [
        'tgl_daftar' => 'datetime',
        'tgl_aktivitas' => 'datetime',
        'verify_token_created_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'saldo' => 'float',
        'saldo_minimal' => 'float',
        'komisi' => 'float'
    ];

    // Untuk Auth
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    // Relasi ke OutboxReseller
    public function outboxes()
    {
        return $this->hasMany(OutboxReseller::class, 'reseller_kode', 'kode');
    }
}