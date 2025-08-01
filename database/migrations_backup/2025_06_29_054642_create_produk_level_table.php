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
        Schema::create('produk_level', function (Blueprint $table) {
            $table->string('kode_level', 10);
            $table->string('kode_produk', 10)->index('kode_produk');
            $table->decimal('harga', 19, 4)->nullable();
            $table->dateTime('tgl_data', 3)->nullable();

            $table->primary(['kode_level', 'kode_produk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_level');
    }
};
