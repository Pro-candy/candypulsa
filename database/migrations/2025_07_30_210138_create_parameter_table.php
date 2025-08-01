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
        Schema::create('parameter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group', 50);
            $table->string('nama', 50);
            $table->text('value');
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_data', 3)->nullable()->useCurrent();

            $table->unique(['group', 'nama'], 'unique_group_nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter');
    }
};
