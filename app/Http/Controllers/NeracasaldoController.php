<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeracasaldoController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil total saldo masing-masing akun dari buku besar
        $data = DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->select('akuns3.nama_akun3', DB::raw('(SUM(detail_transaksi.debit) - SUM(detail_transaksi.kredit) + akuns3.saldo_awal) as saldo'))
            ->groupBy('akuns3.nama_akun3', 'akuns3.saldo_awal')
            ->get();

        return view('neracasaldo.index', compact('data'));
    }

}
