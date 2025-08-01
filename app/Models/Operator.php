<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = 'operator';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode', 'nama', 'menu', 'prefix_tujuan', 'kode_menu',
        'cutoff_awal', 'cutoff_akhir', 'cutoff_ket',
        'link_gambar', 'aktif', 'gangguan',
        'head_property', 'prioritas'
    ];
}
