<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class TransaksiTokoController extends Controller
{
    public function semuaProduk()
    {
        $resellerId = auth('reseller')->id();

        $produk = Product::where('reseller_id', $resellerId)
            ->where('category_id', '!=', 1) // Kecualikan pulsa
            ->select('id', 'kode', 'nama', 'harga_jual as harga', 'stok')
            ->get();

        return response()->json($produk);
    }
}
