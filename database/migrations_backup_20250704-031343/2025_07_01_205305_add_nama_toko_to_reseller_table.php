<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reseller', function (Blueprint $table) {
            $table->string('nama_toko', 100)->nullable()->after('nama');
        });
    }

    public function down(): void
    {
        Schema::table('reseller', function (Blueprint $table) {
            $table->dropColumn('nama_toko');
        });
    }
};