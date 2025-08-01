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
        Schema::create('produk', function (Blueprint $table) {
            $table->enum('aktif', ['yes', 'no'])->nullable()->default('yes');
            $table->string('kode', 10)->primary();
            $table->string('nama', 50)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->string('kode_operator', 10)->nullable()->index('fk_produk_operator');
            $table->unsignedBigInteger('kategori_id')->nullable()->default(1)->index('fk_produk_kategori');
            $table->enum('gangguan', ['yes', 'no'])->nullable()->default('no');
            $table->decimal('nominal', 19, 4)->nullable();
            $table->enum('fisik', ['yes', 'no'])->nullable()->default('no');
            $table->enum('postpaid', ['yes', 'no'])->nullable()->default('no');
            $table->string('qty', 100)->nullable();
            $table->decimal('poin', 19, 4)->nullable();
            $table->string('link_gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
