<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPenyesuaian;

class Penyesuaian extends Model
{
    protected $table = 'penyesuaian';
    protected $primaryKey = 'id_penyesuaian';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'deskripsi',
        'nilai',
        'waktu',
        'jumlah',
    ];

    // Relasi dengan tabel 'DetailPenyesuaian'
    public function detailPenyesuaian()
    {
        return $this->hasMany(DetailPenyesuaian::class, 'id_penyesuaian');
    }
}
