<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksi_toko_reseller', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reseller_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('invoice_no', 50)->unique();
            $table->dateTime('tanggal_waktu');
            $table->decimal('total', 18, 2);
            $table->decimal('diskon', 18, 2)->default(0);
            $table->decimal('pembayaran', 18, 2);
            $table->decimal('kembalian', 18, 2)->default(0);
            $table->string('status', 20)->default('lunas'); // lunas, hutang, cancel, dll
            $table->string('jenis_pembayaran', 30); // cash, transfer, hutang, e-money, dll
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // index / foreign key
            $table->foreign('reseller_id')->references('id')->on('reseller');
            $table->foreign('customer_id')->references('id')->on('pelanggan_toko_reseller');
        });
    }
};
