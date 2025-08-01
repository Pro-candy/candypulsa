<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockReport extends Model
{
    use HasFactory;

    protected $table = 'stock_reports';

    protected $fillable = [
        'reseller_id', 'product_id', 'tanggal', 'stok_awal', 'stok_masuk', 'stok_keluar', 'stok_akhir'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}