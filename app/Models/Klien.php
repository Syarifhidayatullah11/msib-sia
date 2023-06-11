<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;
    protected $table = 'klien';
    protected $fillable = [
        'kode_klien',
        'nama_klien',
        'instansi',
        'no_tlpn',
        'alamat',
        'date',
    ];
}
