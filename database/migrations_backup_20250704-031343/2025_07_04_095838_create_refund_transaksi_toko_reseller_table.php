<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('refund_transaksi_toko_reseller', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('reseller_id');
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->decimal('jumlah', 18, 2);
            $table->dateTime('tanggal_refund');
            $table->string('alasan', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksi_toko_reseller');
            $table->foreign('reseller_id')->references('id')->on('reseller');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan_toko_reseller');
        });
    }
};
