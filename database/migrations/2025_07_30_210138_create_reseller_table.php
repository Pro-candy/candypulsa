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
        Schema::create('reseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('aktif', ['yes', 'no'])->nullable()->default('yes');
            $table->string('verify_token', 100)->nullable();
            $table->timestamp('verify_token_created_at')->nullable();
            $table->string('kode', 20)->unique('kode');
            $table->string('nama', 50)->nullable();
            $table->string('nama_toko', 100)->nullable();
            $table->decimal('saldo', 19, 4)->nullable()->default(0);
            $table->string('alamat')->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('pin', 100)->nullable();
            $table->string('password')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_daftar')->nullable()->useCurrent();
            $table->decimal('saldo_minimal', 19, 4)->nullable()->default(0);
            $table->dateTime('tgl_aktivitas')->nullable();
            $table->integer('poin')->nullable()->default(0);
            $table->enum('suspend', ['yes', 'no'])->nullable()->default('no');
            $table->enum('deleted', ['yes', 'no'])->nullable()->default('no');
            $table->string('nomor_ktp', 50)->nullable();
            $table->string('nomor_hp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->decimal('komisi', 19, 4)->nullable()->default(0);
            $table->string('link_foto_ktp')->nullable();
            $table->string('link_foto_profile')->nullable();
            $table->string('google_id', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseller');
    }
};
