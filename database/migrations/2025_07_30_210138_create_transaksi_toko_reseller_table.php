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
        Schema::create('transaksi_toko_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id')->index('transaksi_toko_reseller_reseller_id_foreign');
            $table->unsignedBigInteger('customer_id')->nullable()->index('transaksi_toko_reseller_customer_id_foreign');
            $table->string('invoice_no', 50)->unique();
            $table->dateTime('tanggal_waktu');
            $table->decimal('total', 18);
            $table->decimal('diskon', 18)->default(0);
            $table->decimal('pembayaran', 18);
            $table->decimal('kembalian', 18)->default(0);
            $table->string('status', 20)->default('lunas');
            $table->string('jenis_pembayaran', 30);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_toko_reseller');
    }
};
