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
        Schema::create('inbox_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reseller_kode', 20)->nullable();
            $table->string('channel', 30)->nullable();
            $table->string('nomor_tujuan', 30)->nullable();
            $table->string('kode_produk', 30)->nullable();
            $table->integer('pengulangan')->nullable();
            $table->string('pin', 30)->nullable();
            $table->string('trx_code', 50)->nullable();
            $table->text('pesan')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'invalid_pin', 'insufficient_balance'])->default('pending');
            $table->unsignedBigInteger('transaksi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbox_reseller');
    }
};
