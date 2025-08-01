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
        Schema::table('rekening_bank', function (Blueprint $table) {
            $table->foreign(['admin_id'])->references(['id'])->on('admin')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekening_bank', function (Blueprint $table) {
            $table->dropForeign('rekening_bank_admin_id_foreign');
        });
    }
};
