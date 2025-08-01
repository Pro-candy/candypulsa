<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function mutasi()
    {
        return view('member-area.saldo.mutasi');
    }

}
