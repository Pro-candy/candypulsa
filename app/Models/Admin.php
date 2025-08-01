<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'pin',
        'password',
        'last_login',
        'role',
    ];

    protected $hidden = [
        'password',
        'pin',
    ];

    public $timestamps = true; // Sesuai kolom created_at & updated_at

    protected $casts = [
        'last_login' => 'datetime',
    ];
}
