<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Akuns1;
use App\Models\Akuns3;

class Akuns2 extends Model
{
    protected $table = 'akuns2';
    protected $primaryKey = 'kode_akun2';
    public $timestamps = false;

    protected $fillable = [
        'kode_akun2',
        'nama_akun2',
        'kode_akun1',
    ];

    // Relasi dengan tabel 'Akuns1'
    public function akun1()
    {
        return $this->belongsTo(Akuns1::class, 'kode_akun1', 'kode_akun1');
    }

    // Relasi dengan tabel 'Akuns3'
    public function akuns3()
    {
        return $this->hasMany(Akuns3::class, 'kode_akun2', 'kode_akun2');
    }
}
