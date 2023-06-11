<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Akuns1;
use App\Models\Akuns2;
use App\Models\DetailTransaksi;
use App\Models\DetailPenyesuaian;

class Akuns3 extends Model
{
    protected $table = 'akuns3';
    protected $primaryKey = 'kode_akun3';
    public $timestamps = false;

    protected $fillable = [
        'kode_akun3',
        'nama_akun3',
        'saldo_awal',
        'saldo_akhir',
        'kode_akun2',
        'kode_akun1',
    ];

    public function akun1()
    {
        return $this->belongsTo(Akuns1::class, 'kode_akun1', 'kode_akun1');
    }

    public function akun2()
    {
        return $this->belongsTo(Akuns2::class, 'kode_akun2', 'kode_akun2');
    }

    // Relasi dengan tabel 'DetailTransaksi'
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'kode_akun3', 'kode_akun3');
    }

    // Relasi dengan tabel 'DetailPenyesuaian'
    public function detailPenyesuaian()
    {
        return $this->hasMany(DetailPenyesuaian::class, 'kode_akun3');
    }
}
