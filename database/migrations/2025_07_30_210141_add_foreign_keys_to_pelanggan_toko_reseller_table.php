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
        Schema::table('pelanggan_toko_reseller', function (Blueprint $table) {
            $table->foreign(['reseller_id'])->references(['id'])->on('reseller')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggan_toko_reseller', function (Blueprint $table) {
            $table->dropForeign('pelanggan_toko_reseller_reseller_id_foreign');
        });
    }
};
