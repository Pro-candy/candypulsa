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
        Schema::create('refund_transaksi_toko_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaksi_id')->index('refund_transaksi_toko_reseller_transaksi_id_foreign');
            $table->unsignedBigInteger('reseller_id')->index('refund_transaksi_toko_reseller_reseller_id_foreign');
            $table->unsignedBigInteger('pelanggan_id')->nullable()->index('refund_transaksi_toko_reseller_pelanggan_id_foreign');
            $table->decimal('jumlah', 18);
            $table->dateTime('tanggal_refund');
            $table->string('alasan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_transaksi_toko_reseller');
    }
};
