<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inbox_reseller', function (Blueprint $table) {
            // Hapus reseller_id, tambahkan reseller_kode
            if (Schema::hasColumn('inbox_reseller', 'reseller_id')) {
                $table->dropColumn('reseller_id');
            }
            $table->string('reseller_kode', 20)->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('inbox_reseller', function (Blueprint $table) {
            $table->dropColumn('reseller_kode');
            $table->unsignedBigInteger('reseller_id')->nullable()->after('id');
        });
    }
};