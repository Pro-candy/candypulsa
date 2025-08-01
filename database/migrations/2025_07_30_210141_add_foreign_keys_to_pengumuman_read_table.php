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
        Schema::table('pengumuman_read', function (Blueprint $table) {
            $table->foreign(['pengumuman_id'])->references(['id'])->on('pengumuman')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumuman_read', function (Blueprint $table) {
            $table->dropForeign('pengumuman_read_pengumuman_id_foreign');
        });
    }
};
