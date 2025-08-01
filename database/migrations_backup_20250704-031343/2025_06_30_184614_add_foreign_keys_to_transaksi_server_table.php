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
        Schema::table('transaksi_server', function (Blueprint $table) {
            $table->foreign(['id_inbox_supplier'])->references(['id'])->on('inbox_supplier')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['reseller_id'])->references(['id'])->on('reseller')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['supplier_id'])->references(['id'])->on('suppliers')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_server', function (Blueprint $table) {
            $table->dropForeign('transaksi_server_id_inbox_supplier_foreign');
            $table->dropForeign('transaksi_server_reseller_id_foreign');
            $table->dropForeign('transaksi_server_supplier_id_foreign');
        });
    }
};
