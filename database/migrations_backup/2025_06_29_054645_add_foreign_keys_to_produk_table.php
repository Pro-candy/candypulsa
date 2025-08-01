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
        Schema::table('produk', function (Blueprint $table) {
            $table->foreign(['kategori_id'], 'fk_produk_kategori')->references(['id'])->on('product_categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['kode_operator'], 'fk_produk_operator')->references(['kode'])->on('operator')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign('fk_produk_kategori');
            $table->dropForeign('fk_produk_operator');
        });
    }
};
