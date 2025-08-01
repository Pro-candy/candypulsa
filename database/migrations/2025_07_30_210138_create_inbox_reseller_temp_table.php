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
        Schema::create('inbox_reseller_temp', function (Blueprint $table) {
            $table->bigIncrements('kode');
            $table->dateTime('tgl_entri', 3);
            $table->string('pengirim');
            $table->string('pesan', 8000);
            $table->tinyInteger('status')->default(0)->comment('0=belum, 1=spam, 2=reseller, 3=supplier');
            $table->dateTime('tgl_status', 3)->nullable();
            $table->bigInteger('kode_inbox')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbox_reseller_temp');
    }
};
