<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutboxReseller extends Model
{
    protected $table = 'outbox_reseller';
    protected $fillable = [
        'reseller_kode',
        'channel',
        'nomor_tujuan',
        'pesan',
        'keterangan',
        'status',
        'trx_code',
        'read',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    // Relasi ke model Reseller berdasarkan kode
    public function reseller()
    {
        return $this->belongsTo(Reseller::class, 'reseller_kode', 'kode');
        // Format: belongsTo(TargetModel::class, foreignKey_di_model_ini, ownerKey_di_target_model)
    }
}