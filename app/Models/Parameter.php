<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameter';

    protected $fillable = [
        'group',
        'nama',
        'value',
        'keterangan',
        'tgl_data',
    ];

    public $timestamps = false; // karena tidak ada created_at / updated_at
}
