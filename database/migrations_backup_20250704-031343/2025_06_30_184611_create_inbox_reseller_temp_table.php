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
        Schema::create('inbox_reseller_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source', 30)->nullable();
            $table->string('raw_message', 500)->nullable();
            $table->unsignedBigInteger('reseller_id')->nullable();
            $table->string('nomor_tujuan', 30)->nullable();
            $table->string('kode_produk', 30)->nullable();
            $table->integer('pengulangan')->nullable();
            $table->string('pin', 30)->nullable();
            $table->string('channel', 30)->nullable();
            $table->enum('is_spam', ['yes', 'no'])->nullable()->default('no');
            $table->string('detected_as', 30)->nullable();
            $table->string('note', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbox_reseller_temp');
    }
};
