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
        Schema::create('detail_transaksi_toko_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaksi_id')->index('detail_transaksi_toko_reseller_transaksi_id_foreign');
            $table->unsignedBigInteger('produk_id');
            $table->integer('qty');
            $table->decimal('harga', 18);
            $table->decimal('subtotal', 18);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi_toko_reseller');
    }
};
