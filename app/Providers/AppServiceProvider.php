<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Admin;
use App\Models\Internal\Admin as InternalAdmin;
use App\Models\DetailTransaksiTokoReseller;
use App\Models\FinancialReport;
use App\Models\InboxReseller;
use App\Models\Operator;
use App\Models\OutboxReseller;
use App\Models\Parameter;
use App\Models\Payment;
use App\Models\PelangganTokoReseller;
use App\Models\PembayaranReseller;
use App\Models\Pengirim;
use App\Models\Pengumuman;
use App\Models\PengumumanRead;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPurchase;
use App\Models\ProductVariant;
use App\Models\Produk;
use App\Models\ProdukHargaReseller;
use App\Models\RefundTransaksiTokoReseller;
use App\Models\Reseller;
use App\Models\Sale;
use App\Models\SaleCancel;
use App\Models\SaleItem;
use App\Models\SaleReturn;
use App\Models\Setting;
use App\Models\StockReport;
use App\Models\SupplierReseller;
use App\Models\TiketDeposit;
use App\Models\TransaksiTokoReseller;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        
        $models = [
            \App\Models\Admin::class,
            InternalAdmin::class,
            \App\Models\DetailTransaksiTokoReseller::class,
            \App\Models\FinancialReport::class,
            \App\Models\InboxReseller::class,
            \App\Models\Operator::class,
            \App\Models\OutboxReseller::class,
            \App\Models\Parameter::class,
            \App\Models\Payment::class,
            \App\Models\PelangganTokoReseller::class,
            \App\Models\PembayaranReseller::class,
            \App\Models\Pengirim::class,
            \App\Models\Pengumuman::class,
            \App\Models\PengumumanRead::class,
            \App\Models\Product::class,
            \App\Models\ProductCategory::class,
            \App\Models\ProductPurchase::class,
            \App\Models\ProductVariant::class,
            \App\Models\Produk::class,
            \App\Models\ProdukHargaReseller::class,
            \App\Models\RefundTransaksiTokoReseller::class,
            \App\Models\Reseller::class,
            \App\Models\Sale::class,
            \App\Models\SaleCancel::class,
            \App\Models\SaleItem::class,
            \App\Models\SaleReturn::class,
            \App\Models\Setting::class,
            \App\Models\StockReport::class,
            \App\Models\SupplierReseller::class,
            \App\Models\TiketDeposit::class,
            \App\Models\TransaksiTokoReseller::class,
            \App\Models\User::class,
        ];

        foreach ($models as $model) {
            $model::observe(\App\Observers\FirebaseSyncObserver::class);
        }


        view()->composer('member-area.partial.header', function ($view) {
            $pengumumanUnreadCount = 0;
            $pengumumanUnreadList = [];

            if (auth()->guard('reseller')->check()) {
                $userId = auth()->guard('reseller')->id();
                // Ambil id pengumuman yang sudah dibaca user
                $readIds = PengumumanRead::where('reseller_id', $userId)->pluck('pengumuman_id')->toArray();
                // Ambil pengumuman aktif yang belum dibaca
                $pengumumanUnreadList = Pengumuman::where('status', 'active')
                    ->where(function($q){
                        $now = now();
                        $q->whereNull('mulai')->orWhere('mulai', '<=', $now);
                    })
                    ->where(function($q){
                        $now = now();
                        $q->whereNull('berakhir')->orWhere('berakhir', '>=', $now);
                    })
                    ->whereNotIn('id', $readIds)
                    ->orderBy('prioritas', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
                $pengumumanUnreadCount = $pengumumanUnreadList->count();
            }

            $view->with(compact('pengumumanUnreadCount', 'pengumumanUnreadList'));
        });
    }
}