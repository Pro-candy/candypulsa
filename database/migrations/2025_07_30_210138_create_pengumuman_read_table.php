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
        Schema::create('pengumuman_read', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengumuman_id')->index('pengumuman_read_pengumuman_id_foreign');
            $table->unsignedBigInteger('reseller_id');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman_read');
    }
};
