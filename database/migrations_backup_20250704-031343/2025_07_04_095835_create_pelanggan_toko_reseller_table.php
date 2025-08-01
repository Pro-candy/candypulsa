<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggan_toko_reseller', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reseller_id');
            $table->string('nama', 100);
            $table->string('phone', 20)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('info_tambahan')->nullable();
            $table->timestamps();

            $table->foreign('reseller_id')->references('id')->on('reseller');
        });
    }
};
