<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\StockReport;
use App\Models\SupplierReseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProdukPembelianController extends Controller
{
    public function index(Request $request)
    {
        $resellerId = Auth::guard('reseller')->id();

        $products = Product::where('reseller_id', $resellerId)->get();
        $suppliers = SupplierReseller::where('reseller_id', $resellerId)->get();

        // Step 1: Ambil data dari DB dengan filter
        $query = ProductPurchase::with(['product', 'supplier'])
            ->where('reseller_id', $resellerId);

        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->invoice) {
            $query->where('invoice', 'like', '%' . $request->invoice . '%');
        }

        $purchases = $query->get();

        // Step 2: Grouping manual setelah semua data difilter
        $purchases = $purchases->groupBy(fn($item) => $item->supplier_id . '_' . $item->invoice);

        return view('member-area.produk.pembelian', compact('products', 'suppliers', 'purchases'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'supplier_id' => 'nullable|exists:supplier_reseller,id',
            'invoice' => [
                'required',
                Rule::unique('product_purchases')->where(function ($query) use ($request) {
                    return $query->where('supplier_id', $request->supplier_id)
                                ->where('invoice', $request->invoice);
                }),
            ],
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.jumlah' => 'required|numeric|min:1',
            'items.*.harga_beli' => 'required|numeric|min:0',
        ], [
            'invoice.unique' => 'Nomor invoice ini sudah pernah digunakan untuk supplier ini.',
        ]);


        $resellerId = Auth::guard('reseller')->id();
        $tanggal = $request->tanggal;
        $supplierId = $request->supplier_id;

        foreach ($request->items as $item) {
            $product = Product::where('reseller_id', $resellerId)->findOrFail($item['product_id']);

            $stokAwal = $product->stok;
            $stokMasuk = $item['jumlah'];
            $stokAkhir = $stokAwal + $stokMasuk;

            // Update stok dan harga beli
            $product->update([
                'stok' => $stokAkhir,
                'harga_beli' => $item['harga_beli']
            ]);

            // Catat pembelian
            ProductPurchase::create([
                'reseller_id' => $resellerId,
                'product_id' => $product->id,
                'jumlah' => $stokMasuk,
                'harga_beli' => $item['harga_beli'],
                'tanggal' => $tanggal,
                'supplier_id' => $supplierId,
                'invoice' => $request->invoice
            ]);

            // Catat mutasi stok
            StockReport::create([
                'reseller_id' => $resellerId,
                'product_id' => $product->id,
                'tanggal' => $tanggal,
                'stok_awal' => $stokAwal,
                'stok_masuk' => $stokMasuk,
                'stok_keluar' => 0,
                'stok_akhir' => $stokAkhir
            ]);
        }
        return redirect()->back()->with('success', 'Pembelian produk berhasil disimpan.');
    
    }
    
    public function detail($supplier_id, $invoice)
    {
        $resellerId = Auth::guard('reseller')->id();

        $purchases = ProductPurchase::with(['product', 'supplier'])
            ->where('reseller_id', $resellerId)
            ->where('supplier_id', $supplier_id)
            ->where('invoice', $invoice)
            ->get();

        $supplier = SupplierReseller::findOrFail($supplier_id);

        // Ambil stock report yang cocok untuk setiap pembelian
        $stockReports = [];
        foreach ($purchases as $p) {
            $stockReports[$p->id] = \App\Models\StockReport::where('reseller_id', $resellerId)
                ->where('product_id', $p->product_id)
                ->where('tanggal', $p->tanggal)
                ->first();
        }

        return view('member-area.produk._pembelian_detail', compact('purchases', 'supplier', 'invoice', 'stockReports'));
    }



}
