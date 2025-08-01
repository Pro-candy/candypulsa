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
        Schema::create('tiket_deposit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_tiket', 30)->unique();
            $table->unsignedBigInteger('reseller_id')->index('tiket_deposit_reseller_id_foreign');
            $table->dateTime('tgl_ambil_tiket');
            $table->decimal('jumlah', 19, 4);
            $table->string('kode_bank', 20)->nullable()->index('tiket_deposit_kode_bank_foreign');
            $table->enum('status', ['open', 'settled', 'expired', 'refund', 'canceled', 'manual'])->default('open');
            $table->string('kode_inbox_reseller', 100)->nullable();
            $table->unsignedBigInteger('mutasi_bank_id')->nullable()->index('tiket_deposit_mutasi_bank_id_foreign');
            $table->string('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_deposit');
    }
};
