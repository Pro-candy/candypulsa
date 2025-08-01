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
        Schema::create('product_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id')->nullable();
            $table->unsignedBigInteger('product_id')->index('product_purchases_product_id_foreign');
            $table->integer('jumlah');
            $table->decimal('harga_beli', 15);
            $table->date('tanggal');
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable()->index('product_purchases_supplier_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_purchases');
    }
};
