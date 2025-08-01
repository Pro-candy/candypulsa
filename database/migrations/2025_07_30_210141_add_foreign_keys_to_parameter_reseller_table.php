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
        Schema::table('parameter_reseller', function (Blueprint $table) {
            $table->foreign(['reseller_id'])->references(['id'])->on('reseller')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parameter_reseller', function (Blueprint $table) {
            $table->dropForeign('parameter_reseller_reseller_id_foreign');
        });
    }
};
