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
        Schema::create('operator', function (Blueprint $table) {
            $table->enum('aktif', ['yes', 'no'])->nullable()->default('yes');
            $table->string('kode', 10)->primary();
            $table->string('nama', 30)->nullable();
            $table->enum('menu', ['Pulsa', 'Data', 'E-Wallet', 'Token PLN', 'SMS/TLP', 'Game', 'Bayar Tagihan', 'Transaksi Toko', 'Hide'])->nullable();
            $table->text('prefix_tujuan')->nullable();
            $table->string('kode_menu', 20)->nullable();
            $table->string('cutoff_awal', 5)->nullable();
            $table->string('cutoff_akhir', 5)->nullable();
            $table->string('cutoff_ket')->nullable();
            $table->string('link_gambar')->nullable();
            $table->enum('head_property', ['card-primary', 'card-secondary', 'card-success', 'card-warning', 'card-danger', 'card-info', 'card-light', 'card-dark'])->nullable()->default('card-primary');
            $table->integer('prioritas')->nullable();
            $table->enum('gangguan', ['yes', 'no'])->nullable()->default('no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator');
    }
};
