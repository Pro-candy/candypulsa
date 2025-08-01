<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pembayaran_reseller', function (Blueprint $table) {
            $table->foreign(['pelanggan_id'])->references(['id'])->on('pelanggan_toko_reseller')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['reseller_id'])->references(['id'])->on('reseller')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['transaksi_id'])->references(['id'])->on('transaksi_toko_reseller')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran_reseller', function (Blueprint $table) {
            $table->dropForeign('pembayaran_reseller_pelanggan_id_foreign');
            $table->dropForeign('pembayaran_reseller_reseller_id_foreign');
            $table->dropForeign('pembayaran_reseller_transaksi_id_foreign');
        });
    }
};
