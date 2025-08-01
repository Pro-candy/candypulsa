<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Database;
use App\Http\Controllers\AuthResellerController;
use App\Http\Controllers\ProdukKategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OutboxResellerController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\InboxResellerController;
use App\Http\Controllers\ProfileResellerController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiPulsaController;
use App\Http\Controllers\ProdukPembelianController;
use App\Http\Controllers\ProdukRiwayatStokController;

// LANDING PAGE - satu route saja
Route::get('/', function () {
    if (Auth::guard('reseller')->check()) {
        return redirect()->route('reseller.dashboard');
    }
    return app(LandingController::class)->index();
})->name('landing');

// REGISTER
Route::post('/register', [AuthResellerController::class, 'register'])->name('reseller.register.submit');

// MEMBER AREA
Route::prefix('member-area')->group(function () {
    // LOGIN
    Route::get('/login', function () {
        if (Auth::guard('reseller')->check()) {
            return redirect()->route('reseller.dashboard');
        }
        return app(AuthResellerController::class)->showLogin();
    })->name('login');
    Route::post('/login', [AuthResellerController::class, 'login'])->name('reseller.login.submit');
    Route::post('/logout', [AuthResellerController::class, 'logout'])->name('reseller.logout');
    // GET logout dihapus demi keamanan

    Route::middleware('auth:reseller')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('reseller.dashboard');

        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/produk/ajax-search', [ProdukController::class, 'ajaxSearch'])->name('produk.ajax-search');
        Route::post('/produk/store-produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::post('/produk/update-harga-pulsa', [ProdukController::class, 'updateHargaPulsa'])->name('produk.update-harga-pulsa');
        
        
        Route::get('/produk/pembelian', [ProdukPembelianController::class, 'index'])->name('produk.pembelian.index');
        Route::post('/produk/pembelian', [ProdukPembelianController::class, 'store'])->name('produk.pembelian.store');
        Route::get('/produk/pembelian/{id}', [ProdukPembelianController::class, 'show'])->name('produk.pembelian.show');
        Route::get('/produk/pembelian/detail/{supplier_id}/{invoice}', [ProdukPembelianController::class, 'detail'])->name('produk.pembelian.detail');

        Route::get('/produk/stok/{product}', [ProdukRiwayatStokController::class, 'show'])->name('produk.stok.riwayat');

        Route::get('/produk/kategori', [ProdukKategoriController::class, 'index'])->name('member-area.produk.kategori');
        Route::post('/produk/kategori', [ProdukKategoriController::class, 'store'])->name('member-area.produk.kategori.store');

        Route::get('/inbox-reseller', [OutboxResellerController::class, 'index'])->name('inbox-reseller.index');
        Route::post('/inbox-reseller/mark-all-read', [OutboxResellerController::class, 'markAllRead'])->name('inbox-reseller.markAllRead');
        Route::get('/inbox-reseller/{id}', [OutboxResellerController::class, 'show'])->name('inbox-reseller.show');

        Route::get('/produk/supplier', [ProdukController::class, 'supplierIndex'])->name('produk.supplier.index');
        Route::post('/produk/supplier/store', [ProdukController::class, 'supplierStore'])->name('produk.supplier.store');


        Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');

        Route::get('/profile', [ProfileResellerController::class, 'index'])->name('profile-reseller.index');
        Route::post('/profile', [ProfileResellerController::class, 'update'])->name('profile-reseller.update');

        Route::get('/outbox-reseller', [InboxResellerController::class, 'index'])->name('outbox-reseller.index');
        Route::get('/outbox-reseller/{id}', [InboxResellerController::class, 'show'])->name('outbox-reseller.show');

        Route::get('/saldo-mutasi', [SaldoController::class, 'mutasi'])->name('mutasi.saldo');

        Route::get('/pelanggan', [PelangganController::class, 'index'])->name('reseller.pelanggan');
        Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('reseller.pelanggan.create');
        Route::post('/pelanggan', [PelangganController::class, 'store'])->name('reseller.pelanggan.store');

        // Aman dengan throttle
        Route::get('/transaksi/pulsa/produk', [TransaksiPulsaController::class, 'cariProduk'])
              ->middleware('throttle:30,1')->name('transaksi.pulsa.produk');

        Route::get('/pelanggan/autocomplete', [PelangganController::class, 'autocomplete'])
              ->middleware('throttle:20,1')->name('pelanggan.autocomplete');
        
        
    });
});

// VERIFIKASI EMAIL
Route::get('/member-area/verifikasi', function () {
    if (Auth::guard('reseller')->check()) {
        return redirect()->route('reseller.dashboard');
    }
    return view('member-area.verifikasi');
})->name('reseller.verifyEmail.confirm');
Route::post('/verify-email', [AuthResellerController::class, 'verifyEmail'])->name('reseller.verifyEmail');
Route::post('/resend-verification', [AuthResellerController::class, 'resendVerification'])->name('reseller.resendVerification');

// REDIRECT KE LOGIN / DASHBOARD JIKA AKSES /member-area
Route::get('/member-area', function () {
    if (Auth::guard('reseller')->check()) {
        return redirect()->route('reseller.dashboard');
    }
    return redirect()->route('login');
});

// routes sitemap
Route::get('/sitemap.xml', function () {
    $list = json_decode(file_get_contents(storage_path('quran/surat.json')), true);

    return response()->view('sitemap', compact('list'))
        ->header('Content-Type', 'application/xml');
});
