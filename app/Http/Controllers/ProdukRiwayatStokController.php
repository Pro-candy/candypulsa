<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukRiwayatStokController extends Controller
{
    
    public function show(Product $product)
    {
        $resellerId = Auth::guard('reseller')->id();

        if ($product->reseller_id != $resellerId) {
            abort(403);
        }

        // Jika kategori = 1 (Pulsa), tampilkan mutasi saldo
        if ($product->category_id == 1) {
            return response()->json([
                'html' => view('member-area.produk._mutasi_saldo', compact('product'))->render()
            ]);
        }

        // Selain itu tampilkan riwayat stok biasa
        $riwayat = StockReport::where('reseller_id', $resellerId)
            ->where('product_id', $product->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'html' => view('member-area.produk._modal_riwayat_stok', compact('product', 'riwayat'))->render()
        ]);
    }


}
