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
        Schema::table('tiket_deposit', function (Blueprint $table) {
            $table->foreign(['kode_bank'])->references(['kode'])->on('rekening_bank')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['mutasi_bank_id'])->references(['id'])->on('cek_mutasi_bank')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['reseller_id'])->references(['id'])->on('reseller')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tiket_deposit', function (Blueprint $table) {
            $table->dropForeign('tiket_deposit_kode_bank_foreign');
            $table->dropForeign('tiket_deposit_mutasi_bank_id_foreign');
            $table->dropForeign('tiket_deposit_reseller_id_foreign');
        });
    }
};
