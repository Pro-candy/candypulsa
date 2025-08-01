<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';
    protected $fillable = [
        'product_id', 'nama', 'kode', 'harga_jual', 'harga_beli', 'stok'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}