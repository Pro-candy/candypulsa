<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outbox_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reseller_kode', 20); // ganti id jadi kode
            $table->string('channel', 30)->nullable();
            $table->string('nomor_tujuan', 30)->nullable();
            $table->longText('pesan')->nullable(); // longText agar bisa pesan panjang
            $table->string('keterangan', 100)->nullable(); // kolom baru
            $table->enum('status', ['sent','pending','failed'])->default('pending');
            $table->string('trx_code', 50)->nullable();
            $table->enum('read', ['yes','no'])->default('no');
            $table->timestamps();

            $table->index('reseller_kode');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outbox_reseller');
    }
};