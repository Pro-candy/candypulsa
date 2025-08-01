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
        Schema::table('parsing', function (Blueprint $table) {
            $table->foreign(['kode_produk'], 'parsing_ibfk_1')->references(['kode'])->on('produk')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parsing', function (Blueprint $table) {
            $table->dropForeign('parsing_ibfk_1');
        });
    }
};
