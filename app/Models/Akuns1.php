<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akuns1 extends Model
{
    protected $table = 'akuns1';
    protected $primaryKey = 'kode_akun1';
    public $timestamps = false;

    protected $fillable = [
        'kode_akun1',
        'nama_akun1',
    ];

    // Relasi dengan tabel 'Akuns2'
    public function akuns2()
    {
        return $this->hasMany(Akuns2::class, 'kode_akun1', 'kode_akun1');
    }
}
