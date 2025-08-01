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
        Schema::create('jawaban_supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kelompok', 50)->nullable();
            $table->string('kata_kunci_harus_ada', 100)->nullable();
            $table->string('kata_kunci_tidak_boleh_ada', 100)->nullable();
            $table->enum('status', ['0', '99', '10'])->default('0');
            $table->integer('prioritas')->default(1);
            $table->enum('parsing_off', ['yes', 'no'])->default('no');
            $table->enum('modul_off', ['yes', 'no'])->default('no');
            $table->string('awalan_tujuan', 50)->nullable();
            $table->string('akhiran_tujuan', 50)->nullable();
            $table->string('awalan_sn', 50)->nullable();
            $table->string('akhiran_sn', 50)->nullable();
            $table->string('awalan_trxid', 50)->nullable();
            $table->string('akhiran_trxid', 50)->nullable();
            $table->string('awalan_nominal', 50)->nullable();
            $table->string('akhiran_nominal', 50)->nullable();
            $table->string('regex')->nullable();
            $table->string('perintah', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_supplier');
    }
};
