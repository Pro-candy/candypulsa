<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;

class Pengirim extends Model
{
    protected $table = 'pengirim';

    public $incrementing = false;
    public $timestamps = true;
    protected $keyType = 'string';

    // Tidak bisa gunakan protected $primaryKey untuk composite key, jadi override query-nya
    protected $fillable = [
        'pengirim',
        'tipe_pengirim',
        'kode_reseller',
        'kirim_info',
        'tgl_data',
        'akses',
    ];

    // Override agar update & delete bisa pakai composite key
    protected function setKeysForSaveQuery($query)
    {
        return $query->where('pengirim', $this->getAttribute('pengirim'))
                     ->where('tipe_pengirim', $this->getAttribute('tipe_pengirim'));
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class, 'kode_reseller', 'kode');
    }
}
