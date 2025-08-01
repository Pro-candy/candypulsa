<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LandingSettingController;

// ✅ Route login (tidak pakai middleware)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');

// ✅ Route yang dilindungi oleh middleware
Route::middleware('auth.admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Parameter
    Route::prefix('parameter')->name('parameter.')->group(function () {
        Route::get('/', [ParameterController::class, 'index'])->name('index');
        Route::post('/update', [ParameterController::class, 'update'])->name('update');
    });
        // Supplier
    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/add', [SupplierController::class, 'create'])->name('create');
        Route::post('/add', [SupplierController::class, 'store'])->name('store');
        Route::get('/{id}', [SupplierController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('edit');        
        Route::get('/{id}/log-modul', [SupplierController::class, 'logmodul'])->name('logmodul');
        Route::put('/{id}', [SupplierController::class, 'update'])->name('update');
        Route::post('/{id}/hapus', [SupplierController::class, 'hapus'])->name('hapus');
        Route::post('/{id}/aktifkan', [SupplierController::class, 'aktifkan'])->name('aktifkan');
        Route::post('/{id}/nonaktifkan', [SupplierController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/aktifkan-semua', [SupplierController::class, 'aktifkanSemua'])->name('aktifkan_semua');
        Route::post('/nonaktifkan-semua', [SupplierController::class, 'nonaktifkanSemua'])->name('nonaktifkan_semua');
    });

    // transaksi
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
    });

    // inbox
    Route::prefix('inbox')->group(function () {
        Route::get('/', [InboxController::class, 'index'])->name('inbox.index');
    });

    // outbox
    Route::prefix('outbox')->group(function () {
        Route::get('/', [OutboxController::class, 'index'])->name('outbox.index');
    });

   // Landing Page Settings
    Route::prefix('landing-settings')->name('landing-settings.')->group(function () {
        Route::get('/', [LandingSettingController::class, 'index'])->name('index');
        Route::post('/update', [LandingSettingController::class, 'update'])->name('update');
    });

    // Log Sistem
    Route::get('/log-sistem', [\App\Http\Controllers\Admin\LogSistemController::class, 'index'])->name('log-sistem.index');



});
