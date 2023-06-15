<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

class LabarugiController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data dari tabel transaksi, detail_transaksi, akuns3, akuns2, dan akuns1
        $data = DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
            ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
            ->select('transaksi.tanggal', 'transaksi.kode_voucher', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'detail_transaksi.debit', 'detail_transaksi.kredit', 'akuns1.nama_akun1')
            ->get();

        // Mengelompokkan data berdasarkan kode akun
        $groupedData = $data->groupBy('kode_akun3');

        return view('labarugi.index', compact('groupedData'));
    }

    public function cetak(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = DB::table('transaksi')
            ->select(
                'transaksi.id_transaksi AS No',
                'transaksi.tanggal AS Tanggal',
                'transaksi.kode_voucher AS Kode_Voucher',
                'transaksi.deskripsi AS Deskripsi',
                'detail_transaksi.kode_akun3 AS Kode_Akun',
                'akuns3.nama_akun3 AS Nama_Akun',
                'detail_transaksi.debit AS Debet',
                'detail_transaksi.kredit AS Kredit'
            )
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->whereBetween('transaksi.tanggal', [$tanggalAwal, $tanggalAkhir]);

        $results = $query->get();

        // Mengambil data dari tabel transaksi, detail_transaksi, akuns3, akuns2, dan akuns1
        $data = DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
            ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
            ->select('transaksi.tanggal', 'transaksi.kode_voucher', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'detail_transaksi.debit', 'detail_transaksi.kredit', 'akuns1.nama_akun1')
            ->get();

        // Mengelompokkan data berdasarkan kode akun
        $groupedData = $data->groupBy('kode_akun3');

        // Logika cetak, misalnya menggunakan package Laravel PDF

        // Contoh menggunakan package Laravel PDF (https://github.com/barryvdh/laravel-dompdf)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('labarugi.cetaklabarugi', ['results' => $results, 'groupedData' => $groupedData]);

        return $pdf->stream('labarugi.pdf');
    }

}
