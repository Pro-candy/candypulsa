<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\OutboxReseller;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Hanya jalankan di web, bukan console!
        if ($this->app->runningInConsole()) {
            return;
        }

        View::composer('member-area.partial.header', function ($view) {
            $user = auth()->guard('reseller')->user();
            $userKode = $user ? $user->kode : null;
            $outboxUnreadCount = 0;
            $outboxUnreadList = collect();

            if ($userKode) {
                $outboxUnreadCount = OutboxReseller::where('reseller_kode', $userKode)
                    ->where('read', 'no')
                    ->count();
                $outboxUnreadList = OutboxReseller::where('reseller_kode', $userKode)
                    ->where('read', 'no')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            }

            $view->with(compact('outboxUnreadCount', 'outboxUnreadList'));
        });
    }
}