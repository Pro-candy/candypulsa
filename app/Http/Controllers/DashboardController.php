<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user reseller login
        $reseller = Auth::guard('reseller')->user();
        $saldo = $reseller->saldo ?? 0;

        // Contoh statistik lain (jika ada tabelnya)
        $totalTransaksi = 0;
        $produkToko = 0;
        $transaksiHariIni = 0;

        // Total transaksi (jika ada model Transaction)
        if (class_exists('\App\Models\Transaction')) {
            $totalTransaksi = \App\Models\Transaction::where('reseller_id', $reseller->id)->count();
            $transaksiHariIni = \App\Models\Transaction::where('reseller_id', $reseller->id)
                ->whereDate('created_at', now()->toDateString())
                ->sum('amount'); // atau field nominal transaksi
        }

        // Total produk
        $produkToko = Product::where('reseller_id', $reseller->id)->count();

        return view('member-area.dashboard', [
            'saldo' => $saldo,
            'totalTransaksi' => $totalTransaksi,
            'produkToko' => $produkToko,
            'transaksiHariIni' => $transaksiHariIni,
            'reseller' => $reseller,
        ]);
    }
}