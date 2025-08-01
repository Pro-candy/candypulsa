<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul', 100);
            $table->text('isi');
            $table->enum('tipe', ['server', 'update', 'info'])->default('info'); // tipe pengumuman
            $table->timestamp('mulai')->nullable(); // waktu mulai tampil
            $table->timestamp('berakhir')->nullable(); // waktu berakhir tampil
            $table->integer('prioritas')->default(1); // prioritas pengumuman
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('pengumuman_read', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengumuman_id');
            $table->unsignedBigInteger('reseller_id'); // atau reseller_kode kalau mau konsisten dengan sistem kamu
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('pengumuman_id')->references('id')->on('pengumuman')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman_read');
        Schema::dropIfExists('pengumuman');
    }
};