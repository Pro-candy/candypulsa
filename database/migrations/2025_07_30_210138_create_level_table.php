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
        Schema::create('level', function (Blueprint $table) {
            $table->string('kode', 10)->primary();
            $table->string('nama', 20);
            $table->decimal('selisih_harga', 19, 4)->nullable();
            $table->string('kode_upline', 10)->nullable();
            $table->decimal('bonus', 19, 4)->nullable();
            $table->tinyInteger('jumlah_ym')->nullable();
            $table->tinyInteger('jumlah_sms')->nullable();
            $table->string('keterangan')->nullable();
            $table->text('blok_produk')->nullable();
            $table->decimal('deposit_minimal', 19, 4)->nullable();
            $table->tinyInteger('sms_end_user')->nullable();
            $table->decimal('default_markup', 19, 4)->nullable();
            $table->string('par_balas')->nullable();
            $table->tinyInteger('poin_trx')->nullable();
            $table->tinyInteger('no_komisi')->nullable();
            $table->tinyInteger('transfer_lintas')->nullable();
            $table->decimal('deposit_maksimal', 19, 4)->nullable();
            $table->decimal('max_pakai', 19, 4)->nullable();
            $table->tinyInteger('guna_poin_produk')->nullable();
            $table->dateTime('tgl_data', 3)->nullable();
            $table->tinyInteger('no_ubah_markup')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level');
    }
};
