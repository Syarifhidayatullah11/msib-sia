<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'kode_voucher',
        'tanggal',
        'deskripsi',
        'ket_jurnal',
    ];

    // Relasi dengan tabel 'DetailTransaksi'
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}
