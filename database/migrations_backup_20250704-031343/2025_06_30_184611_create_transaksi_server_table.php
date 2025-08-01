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
        Schema::create('transaksi_server', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id')->nullable()->index('transaksi_server_reseller_id_foreign');
            $table->unsignedBigInteger('supplier_id')->nullable()->index('transaksi_server_supplier_id_foreign');
            $table->string('nomor_tujuan', 30)->nullable();
            $table->string('kode_produk', 30)->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->enum('status', ['0', '1', '2', '30', '31', '32', '33', '50', '99'])->default('0');
            $table->string('trx_code', 50)->nullable();
            $table->string('reff_id', 50)->nullable();
            $table->integer('pengulangan')->nullable();
            $table->unsignedBigInteger('id_inbox_supplier')->nullable()->index('transaksi_server_id_inbox_supplier_foreign');
            $table->string('sn', 100)->nullable();
            $table->timestamp('tgl_status')->nullable();
            $table->decimal('saldo_awal_reseller', 19, 4)->nullable();
            $table->decimal('saldo_akhir_reseller', 19, 4)->nullable();
            $table->string('modulproses', 100)->nullable();
            $table->enum('is_voucher', ['yes', 'no'])->default('no');
            $table->decimal('komisi', 19, 4)->nullable();
            $table->string('keterangan')->nullable();
            $table->decimal('tagihan', 19, 4)->nullable();
            $table->integer('qty')->nullable();
            $table->integer('point')->nullable();
            $table->decimal('saldo_supplier', 19, 4)->nullable();
            $table->string('error_code', 100)->nullable();
            $table->string('error_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_server');
    }
};
