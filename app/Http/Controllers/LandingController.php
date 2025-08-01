<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\Produk;

class LandingController extends Controller
{
    public function index()
    {
        $totalOperatorAktif = Operator::where('aktif', 1)->count();
        $totalProdukAktif = Produk::where('aktif', 1)->count();

        $produks = Produk::with('operator')
            ->where('produk.aktif', 1)
            ->join('operator', 'produk.kode_operator', '=', 'operator.kode')
            ->orderBy('operator.kode')
            ->orderBy('produk.harga_jual')
            ->select('produk.*')
            ->get();

        $groupedProduk = $produks->groupBy(function ($item) {
            return optional($item->operator)->nama ?? $item->kode_operator;
        });

        return view('index', [
            'totalOperatorAktif' => $totalOperatorAktif,
            'totalProdukAktif'   => $totalProdukAktif,
            'groupedProduk'      => $groupedProduk,
        ]);
    }
}