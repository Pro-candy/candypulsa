<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPurchase extends Model
{
    use HasFactory;

    protected $table = 'product_purchases';

    protected $fillable = [
        'reseller_id', 'product_id', 'jumlah', 'harga_beli', 'tanggal', 'supplier_id','invoice'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierReseller::class, 'supplier_id');
    }
}