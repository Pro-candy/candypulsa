<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'reseller_id', 'tanggal', 'total', 'bayar', 'kembalian', 'status'
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}