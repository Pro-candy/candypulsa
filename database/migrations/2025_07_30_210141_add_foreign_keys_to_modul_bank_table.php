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
        Schema::table('modul_bank', function (Blueprint $table) {
            $table->foreign(['rekening_bank_id'])->references(['id'])->on('rekening_bank')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modul_bank', function (Blueprint $table) {
            $table->dropForeign('modul_bank_rekening_bank_id_foreign');
        });
    }
};
