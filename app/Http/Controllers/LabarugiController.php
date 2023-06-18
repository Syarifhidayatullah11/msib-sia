<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LabarugiController extends Controller
{

    public function index(Request $request)
{
    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Mengambil data dari tabel transaksi, detail_transaksi, akuns3, akuns2, dan akuns1
    $query = DB::table('transaksi')
        ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
        ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
        ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
        ->select('transaksi.tanggal', 'transaksi.kode_voucher', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'detail_transaksi.debit', 'detail_transaksi.kredit', 'akuns1.nama_akun1');

    // Menambahkan filter berdasarkan tanggal awal dan tanggal akhir jika ada
    if ($tanggalAwal && $tanggalAkhir) {
        $query->whereBetween('transaksi.tanggal', [$tanggalAwal, $tanggalAkhir]);
    }

    $data = $query->get();

    // Mengelompokkan data berdasarkan kode akun
    $groupedData = $data->groupBy('kode_akun3');

    return view('labarugi.index', compact('groupedData', 'tanggalAwal', 'tanggalAkhir'));
}



public function cetak(Request $request)
{
    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = $request->input('tanggal_akhir');

    $query = DB::table('transaksi')
        ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
        ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
        ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
        ->select('transaksi.tanggal', 'transaksi.kode_voucher', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'detail_transaksi.debit', 'detail_transaksi.kredit', 'akuns1.nama_akun1');

    if ($tanggalAwal && $tanggalAkhir) {
        $query->whereBetween('transaksi.tanggal', [$tanggalAwal, $tanggalAkhir]);
    }

    $results = $query->get();

    $data = $query->get();
    $groupedData = $data->groupBy('kode_akun3');

    // Logika cetak, menggunakan package Laravel PDF (https://github.com/barryvdh/laravel-dompdf)

    // Instantiate an instance of the PDF class
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('labarugi.cetaklabarugi', ['results' => $results, 'groupedData' => $groupedData]);

    return $pdf->stream('labarugi.pdf');
}


}
