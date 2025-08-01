<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reseller', function (Blueprint $table) {
            $table->enum('tipe_user', ['basic','trial','pro'])->default('basic')->after('aktif');
            $table->dateTime('trial_expired_at')->nullable()->after('tipe_user');
            $table->dateTime('pro_expired_at')->nullable()->after('trial_expired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reseller', function (Blueprint $table) {
            //
        });
    }
};
