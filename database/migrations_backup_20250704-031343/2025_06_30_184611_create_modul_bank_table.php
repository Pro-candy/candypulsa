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
        Schema::create('modul_bank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rekening_bank_id')->index('modul_bank_rekening_bank_id_foreign');
            $table->enum('tipe', ['bca_bisnis', 'bri_api', 'mandiri_api', 'manual']);
            $table->string('nama_modul', 100);
            $table->string('corp_id', 100)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->integer('interval_cek')->default(10);
            $table->integer('jumlah_hari')->default(1);
            $table->time('jam_awal')->default('00:00:00');
            $table->time('jam_akhir')->default('23:59:59');
            $table->enum('is_active', ['yes', 'no'])->default('yes');
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul_bank');
    }
};
