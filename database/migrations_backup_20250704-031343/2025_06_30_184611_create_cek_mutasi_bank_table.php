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
        Schema::create('cek_mutasi_bank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rekening_bank_id')->index('cek_mutasi_bank_rekening_bank_id_foreign');
            $table->dateTime('tgl_proses_cek');
            $table->dateTime('tgl_mutasi');
            $table->decimal('jumlah', 19, 4);
            $table->enum('tipe', ['kredit', 'debet']);
            $table->decimal('saldo_setelah', 19, 4)->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('tiket_deposit_id')->nullable()->index('cek_mutasi_bank_tiket_deposit_id_foreign');
            $table->enum('terklaim', ['yes', 'no'])->default('no');
            $table->string('catatan')->nullable();
            $table->text('data_raw')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_mutasi_bank');
    }
};
