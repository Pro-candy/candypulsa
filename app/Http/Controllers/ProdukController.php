<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Produk;
use App\Models\ProdukHargaReseller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ProductPurchase;
use App\Models\SupplierReseller;



class ProdukController extends Controller
{

    public function supplierIndex()
    {
        $resellerId = Auth::guard('reseller')->id();
        $suppliers = SupplierReseller::withCount('purchases')
            ->where('reseller_id', $resellerId)
            ->get();

        return view('member-area.produk.suplier', compact('suppliers'));
    }

    public function supplierStore(Request $request)
    {
        $resellerId = Auth::guard('reseller')->id();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'telepon' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:255',
        ]);

        SupplierReseller::create([
            'reseller_id' => $resellerId,
            'nama' => $validated['nama'],
            'telepon' => $validated['telepon'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('produk.supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }


    public function index(Request $request)
    {
        $kategoriId = $request->input('kategori');
        $categories = ProductCategory::all();
        $resellerId = Auth::guard('reseller')->id();
        $page = $request->input('page', 1);
        $perPage = 20;

        // Jika filter kategori KOSONG, tampilkan SEMUA produk pulsa + produk reseller
        if (!$kategoriId) {
            // Produk pulsa
            $pulsa = Produk::all();
            $hargaReseller = ProdukHargaReseller::where('reseller_id', $resellerId)
                ->whereIn('produk_kode', $pulsa->pluck('kode'))->get()->keyBy('produk_kode');
            $saldo = Auth::guard('reseller')->user()->saldo ?? 0;
            foreach ($pulsa as $product) {
                    $product->stok = $saldo;
                    $product->kategori_nama = "Pulsa";
                    $product->harga_beli = $product->harga_jual;
                    $product->harga_jual = $hargaReseller[$product->kode]->harga_jual ?? null;
            }

            // Produk milik reseller
            $produkReseller = Product::with('category')->where('reseller_id', $resellerId)->get();

            // Gabungkan
            $allProducts = $pulsa->concat($produkReseller);

            // Manual pagination
            $offset = ($page - 1) * $perPage;
            $paginatedProducts = new LengthAwarePaginator(
                $allProducts->slice($offset, $perPage)->values(),
                $allProducts->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            $products = $paginatedProducts;
            $is_pulsa = false;
        } else {
            $is_pulsa = $kategoriId == 1;
            if ($is_pulsa) {
                // Produk pulsa kategori 1
                $pulsa = Produk::where('kategori_id', 1)->get();
                $hargaReseller = ProdukHargaReseller::where('reseller_id', $resellerId)
                    ->whereIn('produk_kode', $pulsa->pluck('kode'))->get()->keyBy('produk_kode');
                $saldo = Auth::guard('reseller')->user()->saldo ?? 0;
                foreach ($pulsa as $product) {
                    $product->stok = $saldo;
                    $product->kategori_nama = "Pulsa";
                    $product->harga_beli = $product->harga_jual;
                    $product->harga_jual = $hargaReseller[$product->kode]->harga_jual ?? null;
                }
                // Pagination
                $offset = ($page - 1) * $perPage;
                $products = new LengthAwarePaginator(
                    $pulsa->slice($offset, $perPage)->values(),
                    $pulsa->count(),
                    $perPage,
                    $page,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                // Produk reseller kategori lain
                $produkReseller = Product::with('category')
                    ->where('reseller_id', $resellerId)
                    ->where('category_id', $kategoriId)
                    ->get();
                // Pagination
                $offset = ($page - 1) * $perPage;
                $products = new LengthAwarePaginator(
                    $produkReseller->slice($offset, $perPage)->values(),
                    $produkReseller->count(),
                    $perPage,
                    $page,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }
        }

        return view('member-area.produk.index', [
            'products' => $products,
            'categories' => $categories,
            'selected_category' => $kategoriId,
            'is_pulsa' => $is_pulsa ?? false,
        ]);
    }

    public function ajaxSearch(Request $request)
    {
        try {
            $q = $request->input('q');
            $kategoriId = $request->input('kategori');
            $resellerId = Auth::guard('reseller')->id();
            $page = $request->input('page', 1);
            $perPage = 20;

            if ($q && strlen($q) < 3) {
                return response()->json([
                    'html' => '<tr><td colspan="7" class="text-center text-muted">Ketik minimal 3 huruf...</td></tr>',
                    'pagination' => '',
                ]);
            }

            if (!$kategoriId) {
                $pulsa = Produk::where('nama', 'like', "%$q%")->get();
                $hargaReseller = ProdukHargaReseller::where('reseller_id', $resellerId)
                    ->whereIn('produk_kode', $pulsa->pluck('kode'))->get()->keyBy('produk_kode');
                $saldo = Auth::guard('reseller')->user()->saldo ?? 0;
                foreach ($pulsa as $product) {
                    $product->stok = $saldo;
                    $product->kategori_nama = "Pulsa";
                    $product->harga_beli = $product->harga_jual;
                    $product->harga_jual = $hargaReseller[$product->kode]->harga_jual ?? null;
                }
                $produkReseller = Product::with('category')->where('reseller_id', $resellerId)
                    ->where('nama', 'like', "%$q%")->get();

                $products = $pulsa->concat($produkReseller);
                $is_pulsa = false;
            } else {
                $is_pulsa = $kategoriId == 1;
                if ($is_pulsa) {
                    $pulsa = Produk::where('kategori_id', 1)
                        ->where('nama', 'like', "%$q%")
                        ->get();
                    $hargaReseller = ProdukHargaReseller::where('reseller_id', $resellerId)
                        ->whereIn('produk_kode', $pulsa->pluck('kode'))->get()->keyBy('produk_kode');
                    $saldo = Auth::guard('reseller')->user()->saldo ?? 0;
                    foreach ($pulsa as $product) {
                        $product->stok = $saldo;
                        $product->kategori_nama = "Pulsa";
                        $product->harga_beli = $product->harga_jual;
                        $product->harga_jual = $hargaReseller[$product->kode]->harga_jual ?? null;
                    }
                    $products = $pulsa;
                } else {
                    $produkReseller = Product::with('category')->where('reseller_id', $resellerId)
                        ->where('category_id', $kategoriId)
                        ->where('nama', 'like', "%$q%")->get();
                    $products = $produkReseller;
                }
            }

            // PAGINATION MANUAL
            $total = $products->count();
            $sliced = $products->slice(($page - 1) * $perPage, $perPage)->values();
            $paginated = new LengthAwarePaginator($sliced, $total, $perPage, $page, [
                'path' => url()->current(),
                'query' => $request->except('page'),
            ]);

            $html = view('member-area.produk._table_rows', [
                'products' => $paginated,
                'is_pulsa' => $is_pulsa ?? false,
            ])->render();

            $pagination = $paginated->appends($request->except('page'))->links('pagination::bootstrap-5')->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
            ]);
        } catch (\Throwable $e) {
            \Log::error('AJAX Produk Error: ' . $e->getMessage());
            return response()->json([
                'html' => '<tr><td colspan="7" class="text-danger">Error: ' . $e->getMessage() . '</td></tr>',
                'pagination' => '',
            ], 500);
        }
    }
    // Proses simpan produk baru reseller (bukan pulsa)
   public function store(Request $request)
    {
        $resellerId = Auth::guard('reseller')->id();

        // Validasi input. category_id != 1 (bukan pulsa)
        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'kode'        => 'nullable|string|max:50|unique:products,kode',
            'barcode'     => 'nullable|string|max:100',
            'category_id' => 'required|integer|not_in:1|exists:product_categories,id',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:255',
        ], [
            'category_id.not_in' => 'Tidak bisa menambah produk kategori Pulsa.'
        ]);

        // Simpan ke tabel products
        $product = new Product();
        $product->nama        = $validated['nama'];
        $product->kode        = $validated['kode'] ?? strtoupper(uniqid('PRD'));
        $product->category_id = $validated['category_id'];
        $product->stok        = 0;
        $product->harga_beli  = $validated['harga_beli'];
        $product->harga_jual  = $validated['harga_jual'];
        $product->deskripsi   = $validated['deskripsi'] ?? '';
        $product->reseller_id = $resellerId;
        $product->barcode     = $validated['barcode'] ?? null;
        $product->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan dan disinkronkan ke Firebase.');
    }


    public function updateProduk(Request $request)
    {
        $resellerId = Auth::guard('reseller')->id();

        $validated = $request->validate([
            'id'          => 'required|exists:products,id',
            'nama'        => 'required|string|max:100',
            'kode'        => 'nullable|string|max:50',
            'barcode'     => 'nullable|string|max:100',
            'category_id' => 'required|integer|not_in:1|exists:product_categories,id',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:255',
        ]);


        $product = Product::where('id', $validated['id'])->where('reseller_id', $resellerId)->firstOrFail();

        $product->nama        = $validated['nama'];
        $product->kode        = $validated['kode'] ?? $product->kode;
        $product->category_id = $validated['category_id'];
        $product->harga_beli  = $validated['harga_beli'];
        $product->harga_jual  = $validated['harga_jual'];
        $product->deskripsi   = $validated['deskripsi'] ?? '';
        $product->barcode     = $validated['barcode'] ?? null;
        // stok TIDAK DIUBAH
        $product->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function updateHargaPulsa(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'harga_jual' => 'required|integer|min:0',
        ]);

        ProdukHargaReseller::updateOrInsert(
            [
                'reseller_id' => auth()->id(),
                'produk_kode' => $request->kode,
            ],
            [
                'harga_jual' => $request->harga_jual,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Harga jual pulsa berhasil disimpan.');
    }

}