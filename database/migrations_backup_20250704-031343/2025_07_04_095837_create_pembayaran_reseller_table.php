<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayaran_reseller', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->unsignedBigInteger('reseller_id');
            $table->decimal('jumlah_bayar', 18, 2);
            $table->dateTime('tanggal_bayar');
            $table->string('metode_pembayaran', 30);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksi_toko_reseller');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan_toko_reseller');
            $table->foreign('reseller_id')->references('id')->on('reseller');
        });
    }
};
