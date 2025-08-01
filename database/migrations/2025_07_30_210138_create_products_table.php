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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id')->nullable();
            $table->unsignedBigInteger('category_id')->index('products_category_id_foreign');
            $table->string('nama');
            $table->string('kode')->unique();
            $table->string('barcode')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_jual', 15);
            $table->decimal('harga_beli', 15)->nullable();
            $table->integer('stok')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
