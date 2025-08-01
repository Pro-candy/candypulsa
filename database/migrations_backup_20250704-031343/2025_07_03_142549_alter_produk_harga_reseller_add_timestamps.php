<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('produk_harga_reseller', function (Blueprint $table) {
            $table->timestamps(); // Tambah kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::table('produk_harga_reseller', function (Blueprint $table) {
            $table->dropTimestamps(); // Hapus kalau di-rollback
        });
    }
};
