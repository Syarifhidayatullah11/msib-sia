<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Akuns3;
use App\Models\Status;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'kode_akun3',
        'debit',
        'kredit',
        'status_id',
    ];

    // Relasi dengan tabel 'Transaksi'
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    // Relasi dengan tabel 'Akuns3'
    public function akuns3()
    {
        return $this->belongsTo(Akuns3::class, 'kode_akun3');
    }

    // Relasi dengan tabel 'Status'
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id_status');
    }
}
