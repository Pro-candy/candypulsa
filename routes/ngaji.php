<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ngaji\NgajiController;
use App\Http\Controllers\Ngaji\DoaController;

Route::get('/ngaji/surat', [NgajiController::class, 'index']);
Route::get('/ngaji/surat/{slug}', [NgajiController::class, 'surat']);
Route::get('/ngaji/surat/{slug}/{ayat}', [NgajiController::class, 'ayat']);// Pindahkan ke NgajiController
Route::redirect('/ngaji', '/ngaji/surat', 301);
Route::get('/doa', [DoaController::class, 'index']);
Route::get('/doa/{slug}', [DoaController::class, 'show']);
Route::get('/doa/{slug}', [\App\Http\Controllers\Ngaji\DoaController::class, 'detail']);