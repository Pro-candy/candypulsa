<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_transaksi_toko_reseller', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('qty');
            $table->decimal('harga', 18, 2);
            $table->decimal('subtotal', 18, 2);
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksi_toko_reseller');
            // produk_id: sesuaikan foreign ke products jika ada
        });
    }
};
