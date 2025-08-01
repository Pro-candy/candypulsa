<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResellerController;

Route::get('/v1/reseller/{url}', [ResellerController::class, 'handleRequest']);
