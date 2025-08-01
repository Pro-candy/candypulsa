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
        Schema::table('mutasi', function (Blueprint $table) {
            $table->foreign(['reseller_id'])->references(['id'])->on('reseller')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['trx_id'])->references(['id'])->on('transaksi_server')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->dropForeign('mutasi_reseller_id_foreign');
            $table->dropForeign('mutasi_trx_id_foreign');
        });
    }
};
