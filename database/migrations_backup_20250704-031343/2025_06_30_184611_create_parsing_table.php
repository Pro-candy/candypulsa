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
        Schema::create('parsing', function (Blueprint $table) {
            $table->integer('kode_modul');
            $table->string('kode_produk', 10)->index('kode_produk');
            $table->text('perintah')->nullable();
            $table->tinyInteger('aktif')->nullable();
            $table->smallInteger('prioritas')->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kode_hlr', 30)->nullable();
            $table->dateTime('tgl_data', 3)->nullable();
            $table->tinyInteger('update_harga')->nullable();
            $table->decimal('markup', 19, 4)->nullable();

            $table->primary(['kode_modul', 'kode_produk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parsing');
    }
};
