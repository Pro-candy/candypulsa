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
        Schema::table('cek_mutasi_bank', function (Blueprint $table) {
            $table->foreign(['rekening_bank_id'])->references(['id'])->on('rekening_bank')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['tiket_deposit_id'])->references(['id'])->on('tiket_deposit')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cek_mutasi_bank', function (Blueprint $table) {
            $table->dropForeign('cek_mutasi_bank_rekening_bank_id_foreign');
            $table->dropForeign('cek_mutasi_bank_tiket_deposit_id_foreign');
        });
    }
};
