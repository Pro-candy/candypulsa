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
        Schema::create('pelanggan_toko_reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->string('kode_pelanggan', 32);
            $table->string('nama', 100);
            $table->string('phone', 20)->nullable();
            $table->string('alamat')->nullable();
            $table->string('email', 100)->nullable();
            $table->text('info_tambahan')->nullable();
            $table->timestamps();

            $table->unique(['reseller_id', 'kode_pelanggan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan_toko_reseller');
    }
};
