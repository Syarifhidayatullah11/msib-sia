<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DetailTransaksi;
use App\Models\DetailPenyesuaian;
use App\Models\Penyesuaian;


class Status extends Model
{
    use SoftDeletes;

    protected $table = 'status';
    protected $primaryKey = 'id_status';

    protected $fillable = [
        'id_status',
        'nama_status',
    ];

    protected $dates = ['deleted_at'];

    // Relasi dengan tabel 'DetailPenyesuaian'
    public function detailPenyesuaian()
    {
        return $this->hasMany(DetailPenyesuaian::class, 'id_status');
    }

    // Relasi dengan tabel 'Penyesuaian'
    public function penyesuaian()
    {
        return $this->hasMany(Penyesuaian::class, 'id_status');
    }

    // Relasi dengan tabel 'DetailTransaksi'
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'status_id');
    }
}