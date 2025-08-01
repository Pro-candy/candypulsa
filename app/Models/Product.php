<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'reseller_id', 'category_id', 'nama', 'kode', 'barcode', 'deskripsi', 'harga_jual', 'harga_beli', 'stok', 'aktif'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function purchases()
    {
        return $this->hasMany(ProductPurchase::class);
    }

    public function stockReports()
    {
        return $this->hasMany(StockReport::class);
    }
    // Statistik harga beli
    public function getHargaBeliMinAttribute()
    {
        return $this->purchases()->min('harga_beli');
    }

    public function getHargaBeliMaxAttribute()
    {
        return $this->purchases()->max('harga_beli');
    }

    public function getHargaBeliAvgAttribute()
    {
        return round($this->purchases()->avg('harga_beli'));
    }

    // Statistik harga jual dari transaksi (opsional - disiapkan untuk masa depan)
    public function getHargaJualMinAttribute()
    {
        return $this->hasMany(\App\Models\DetailTransaksiTokoReseller::class, 'produk_id')->min('harga');
    }

    public function getHargaJualMaxAttribute()
    {
        return $this->hasMany(\App\Models\DetailTransaksiTokoReseller::class, 'produk_id')->max('harga');
    }

    public function getHargaJualAvgAttribute()
    {
        return round($this->hasMany(\App\Models\DetailTransaksiTokoReseller::class, 'produk_id')->avg('harga'));
    }

    public function transaksiItems()
    {
        return $this->hasMany(\App\Models\DetailTransaksiTokoReseller::class, 'product_id');
    }

}