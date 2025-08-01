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
        Schema::create('pengirim', function (Blueprint $table) {
            $table->string('pengirim');
            $table->char('tipe_pengirim', 1);
            $table->string('kode_reseller', 20)->nullable()->index('kode_reseller');
            $table->tinyInteger('kirim_info')->nullable();
            $table->dateTime('tgl_data', 3)->nullable();
            $table->tinyInteger('akses')->nullable();

            $table->primary(['pengirim', 'tipe_pengirim']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirim');
    }
};
