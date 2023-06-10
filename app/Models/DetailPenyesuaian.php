<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penyesuaian;
use App\Models\Akuns3;
use App\Models\Status;

class DetailPenyesuaian extends Model
{
    protected $table = 'detail_penyesuaian';
    protected $primaryKey = 'id_detail_penyesuaian';
    public $timestamps = false;

    protected $fillable = [
        'id_penyesuaian',
        'kode_akun3',
        'debit',
        'kredit',
        'id_status',
    ];

    // Relasi dengan tabel 'Penyesuaian'
    public function penyesuaian()
    {
        return $this->belongsTo(Penyesuaian::class, 'id_penyesuaian');
    }

    // Relasi dengan tabel 'Akuns3'
    public function akuns3()
    {
        return $this->belongsTo(Akuns3::class, 'kode_akun3');
    }

    // Relasi dengan tabel 'Status'
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
