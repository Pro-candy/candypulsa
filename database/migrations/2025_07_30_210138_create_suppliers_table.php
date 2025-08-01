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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 100)->nullable();
            $table->string('username', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('apikey')->nullable();
            $table->string('pin', 50)->nullable();
            $table->text('endpoint')->nullable();
            $table->integer('id_jawaban_provider')->nullable();
            $table->text('initial_parsing')->nullable();
            $table->enum('jenis_method', ['API', 'HTTP_GET', 'HTTP_POST'])->default('HTTP_GET');
            $table->double('saldo')->default(0);
            $table->tinyInteger('deleted')->default(0);
            $table->tinyInteger('aktif')->default(1);
            $table->text('parameter')->nullable();
            $table->integer('port')->default(80);
            $table->string('terima_dari')->nullable();
            $table->text('method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
