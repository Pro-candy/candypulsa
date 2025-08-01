<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailVerificationToResellerTable extends Migration
{
    public function up()
    {
        Schema::table('reseller', function (Blueprint $table) {
            $table->string('verify_token', 100)->nullable()->after('aktif');
            $table->timestamp('verify_token_created_at')->nullable()->after('verify_token');
        });
    }

    public function down()
    {
        Schema::table('reseller', function (Blueprint $table) {
            $table->dropColumn(['verify_token', 'verify_token_created_at']);
        });
    }
}