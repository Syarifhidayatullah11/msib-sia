<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeracasaldoController extends Controller
{
    public function index(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $query = DB::table('detail_transaksi')
        ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->join('akuns3', 'akuns3.kode_akun3', '=', 'detail_transaksi.kode_akun3')
        ->select(
            'akuns3.kode_akun3',
            'akuns3.nama_akun3',
            'akuns3.saldo_awal',
            DB::raw('COALESCE(SUM(detail_transaksi.debit), 0) as jumdebit'),
            DB::raw('COALESCE(SUM(detail_transaksi.kredit), 0) as jumkredit')
        )
        ->groupBy('akuns3.kode_akun3', 'akuns3.nama_akun3', 'akuns3.saldo_awal')
            ->orderBy('akuns3.kode_akun3', 'asc');

        if ($tglawal && $tglakhir) {
            $query->where('transaksi.tanggal', '>=', $tglawal)
                ->where('transaksi.tanggal', '<=', $tglakhir);
        }

        $data = $query->get();

        return view('neracasaldo.index', compact('data'));
    }
}
