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
        Schema::create('inbox_supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('endpoint_reseller', 100)->nullable();
            $table->string('nomor_tujuan', 30)->nullable();
            $table->string('trx_code', 50)->nullable();
            $table->text('pesan')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->enum('deleted', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbox_supplier');
    }
};
