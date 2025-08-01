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
        Schema::create('mutasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id')->nullable()->index('mutasi_reseller_id_foreign');
            $table->enum('jenis', ['deposit', 'withdraw', 'transfer', 'komisi', 'koreksi', 'bonus'])->nullable();
            $table->decimal('nominal', 19, 4)->default(0);
            $table->decimal('saldo_before', 19, 4)->default(0);
            $table->decimal('saldo_after', 19, 4)->default(0);
            $table->string('keterangan', 200)->nullable();
            $table->unsignedBigInteger('trx_id')->nullable()->index('mutasi_trx_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};
