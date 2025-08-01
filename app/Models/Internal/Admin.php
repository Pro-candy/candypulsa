<?php

namespace App\Models\Internal;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin'; // pastikan nama table sesuai

    protected $fillable = [
        'nip', 'nama', 'email', 'pin', 'password', 'last_login', 'role'
    ];

    protected $hidden = [
        'password',
        'pin',
    ];

}