<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    protected $table = 'sale_returns';
    protected $fillable = [
        'sale_id', 'reseller_id', 'tanggal', 'alasan', 'jumlah'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}