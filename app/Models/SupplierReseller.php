<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierReseller extends Model
{
    use HasFactory;

    protected $table = 'supplier_reseller';

    protected $fillable = [
        'reseller_id', 'nama', 'telepon', 'alamat'
    ];

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function purchases()
    {
        return $this->hasMany(ProductPurchase::class, 'supplier_id');
    }
}
