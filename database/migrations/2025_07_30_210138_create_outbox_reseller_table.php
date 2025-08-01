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
        Schema::create('outbox_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reseller_kode', 20)->index();
            $table->string('channel', 30)->nullable();
            $table->string('nomor_tujuan', 30)->nullable();
            $table->longText('pesan')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->enum('status', ['sent', 'pending', 'failed'])->default('pending');
            $table->string('trx_code', 50)->nullable();
            $table->enum('read', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outbox_reseller');
    }
};
