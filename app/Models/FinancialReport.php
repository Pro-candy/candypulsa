<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    protected $table = 'financial_reports';
    protected $fillable = [
        'periode_awal','periode_akhir','pendapatan','pengeluaran','laba'
    ];
}