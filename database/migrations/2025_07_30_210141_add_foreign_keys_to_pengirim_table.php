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
        Schema::table('pengirim', function (Blueprint $table) {
            $table->foreign(['kode_reseller'], 'pengirim_ibfk_1')->references(['kode'])->on('reseller')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengirim', function (Blueprint $table) {
            $table->dropForeign('pengirim_ibfk_1');
        });
    }
};
