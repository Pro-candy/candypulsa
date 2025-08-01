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
        Schema::create('rekening_bank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id')->nullable()->index('rekening_bank_admin_id_foreign');
            $table->string('kode', 20)->unique();
            $table->string('nama_bank', 50);
            $table->string('no_rekening', 50);
            $table->string('atas_nama', 100)->nullable();
            $table->decimal('saldo_terakhir', 19, 4)->nullable();
            $table->dateTime('tgl_cek_saldo')->nullable();
            $table->enum('is_active', ['yes', 'no'])->default('yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening_bank');
    }
};
