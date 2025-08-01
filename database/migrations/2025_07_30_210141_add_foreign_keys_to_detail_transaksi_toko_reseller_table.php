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
        Schema::table('detail_transaksi_toko_reseller', function (Blueprint $table) {
            $table->foreign(['transaksi_id'])->references(['id'])->on('transaksi_toko_reseller')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transaksi_toko_reseller', function (Blueprint $table) {
            $table->dropForeign('detail_transaksi_toko_reseller_transaksi_id_foreign');
        });
    }
};
