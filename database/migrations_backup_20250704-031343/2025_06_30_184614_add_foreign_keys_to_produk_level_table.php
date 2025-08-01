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
        Schema::table('produk_level', function (Blueprint $table) {
            $table->foreign(['kode_level'], 'produk_level_ibfk_1')->references(['kode'])->on('level')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['kode_produk'], 'produk_level_ibfk_2')->references(['kode'])->on('produk')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_level', function (Blueprint $table) {
            $table->dropForeign('produk_level_ibfk_1');
            $table->dropForeign('produk_level_ibfk_2');
        });
    }
};
