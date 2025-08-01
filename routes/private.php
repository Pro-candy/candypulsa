<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Internal\AdminAuthController;
use App\Http\Controllers\Internal\ResellerController;

// Login routes
Route::get('/pemilik-server', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/pemilik-server', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/pemilik-logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Group routes dengan middleware auth:admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/pemilik-dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pemilik-dashboard/reseller', [ResellerController::class, 'index'])->name('admin.reseller.index');
    Route::get('/pemilik-dashboard/reseller/{id}/edit', [ResellerController::class, 'edit'])->name('admin.reseller.edit');
    Route::get('/pemilik-dashboard/reseller/{kode}/pengirim', [ResellerController::class, 'pengirim'])->name('admin.reseller.pengirim');

Route::post('/update-parameter', [AdminAuthController::class, 'updateParameter'])->name('admin.parameter.update');

// Tampilkan modal pengirim
Route::get('/reseller/pengirim/{kode}', [ResellerController::class, 'pengirim'])->name('admin.reseller.pengirim.show');

// Simpan pengirim (AJAX post)
Route::post('/reseller/simpan-pengirim', [ResellerController::class, 'simpanPengirim'])->name('admin.reseller.simpan_pengirim');


});
