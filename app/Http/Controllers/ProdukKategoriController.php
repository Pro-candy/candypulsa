<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategory;
use App\Models\Produk;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProdukKategoriController extends Controller
{
    public function index()
    {
        $resellerId = Auth::guard('reseller')->id();

        $categories = ProductCategory::select('*')
            ->selectSub(function ($query) {
                $query->from('produk')
                    ->selectRaw('count(*)')
                    ->whereColumn('produk.kategori_id', 'product_categories.id');
            }, 'jumlah_produk_pulsa')
            ->selectSub(function ($query) use ($resellerId) {
                $query->from('products')
                    ->selectRaw('count(*)')
                    ->whereColumn('products.category_id', 'product_categories.id')
                    ->where('products.reseller_id', $resellerId);
            }, 'jumlah_produk_reseller')
            ->where(function ($query) use ($resellerId) {
                $query->whereNull('reseller_id')
                      ->orWhere('reseller_id', $resellerId);
            })
            ->orderBy('nama')
            ->get();

        return view('member-area.produk.kategori', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        ProductCategory::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kode' => uniqid('CAT-'),
            'reseller_id' => Auth::guard('reseller')->id(),
        ]);

        return redirect()->route('member-area.produk.kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function updateHargaPulsa(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|exists:produk,kode',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $resellerId = Auth::guard('reseller')->id();

        // Simpan atau update harga
        $harga = ProdukHargaReseller::updateOrCreate(
            [
                'produk_kode' => $validated['kode'],
                'reseller_id' => $resellerId,
            ],
            [
                'harga_jual' => $validated['harga_jual'],
            ]
        );

        return redirect()->route('produk.index')->with('success', 'Harga pulsa berhasil disimpan.');
    }

}