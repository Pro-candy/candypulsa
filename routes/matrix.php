<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Matrix\MatrixController;

Route::get('/matrix', [MatrixController::class, 'index']);
Route::post('/matrix/result', [MatrixController::class, 'calculate'])->name('matrix.calculate');
