<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'nama', 'kode', 'deskripsi', 'reseller_id'
    ];

    // Produk milik reseller (products)
    public function produkReseller()
    {
        return $this->hasMany(\App\Models\Product::class, 'category_id');
    }

    // Produk master global (produk) - untuk pulsa
    public function produkGlobal()
    {
        return $this->hasMany(\App\Models\Produk::class, 'kategori_id');
    }
}