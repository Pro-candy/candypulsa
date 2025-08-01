<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'reseller_id','nama','metode','nomor_rekening','atas_nama','status'
    ];
    public function reseller() { return $this->belongsTo(Reseller::class);}
}