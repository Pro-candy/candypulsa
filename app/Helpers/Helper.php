<?php

namespace App\Helpers;

use App\Models\Parameter;
use Kreait\Firebase\Factory;

class Helper
{
    // Generate kode member unik per reseller
    public static function generateKodePelanggan($resellerKode, $nama)
    {
        $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $namaClean = preg_replace('/[^A-Za-z]/', '', strtoupper($nama));
        $huruf = substr($namaClean, 0, 3);

        return "{$resellerKode}-{$randomNumber}-{$huruf}";
    }

    // Generate invoice (contoh)
    public static function generateInvoice($prefix = 'INV')
    {
        return $prefix . '-' . date('Ymd') . '-' . strtoupper(str_random(5));
    }

    public static function param($group, $nama, $default = '')
    {
        $param = Parameter::where('group', $group)->where('nama', $nama)->first();
        return $param ? $param->value : $default;
    }

}
