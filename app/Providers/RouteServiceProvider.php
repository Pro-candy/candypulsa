<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route; // <-- Import Route di sini

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // Secara default, Laravel sudah meng-load routes/web.php dan routes/api.php secara otomatis.
          parent::boot();

        Route::middleware('web')
            ->group(base_path('routes/private.php'));

        Route::middleware('web')
            ->group(base_path('routes/ngaji.php'));

        Route::middleware('web')
            ->group(base_path('routes/matrix.php'));

        Route::middleware('api')
        ->prefix('api')
        ->group(base_path('routes/api.php'));
            
    }
}