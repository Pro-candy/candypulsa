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
        Schema::create('pembayaran_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaksi_id')->index('pembayaran_reseller_transaksi_id_foreign');
            $table->unsignedBigInteger('pelanggan_id')->nullable()->index('pembayaran_reseller_pelanggan_id_foreign');
            $table->unsignedBigInteger('reseller_id')->index('pembayaran_reseller_reseller_id_foreign');
            $table->decimal('jumlah_bayar', 18);
            $table->dateTime('tanggal_bayar');
            $table->string('metode_pembayaran', 30);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_reseller');
    }
};
