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
        Schema::table('produk_harga_reseller', function (Blueprint $table) {
            $table->foreign(['reseller_id'], 'produk_harga_reseller_ibfk_1')->references(['id'])->on('reseller')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['produk_kode'], 'produk_harga_reseller_ibfk_2')->references(['kode'])->on('produk')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_harga_reseller', function (Blueprint $table) {
            $table->dropForeign('produk_harga_reseller_ibfk_1');
            $table->dropForeign('produk_harga_reseller_ibfk_2');
        });
    }
};
