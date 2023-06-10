<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

class JurnalMemorialController extends Controller
{
    public function index(Request $request)
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

        return view('jurnalmemorial.index', ['results' => $results]);
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

        // Logika cetak, misalnya menggunakan package Laravel PDF

        // Contoh menggunakan package Laravel PDF (https://github.com/barryvdh/laravel-dompdf)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('jurnalmemorial.cetakpdf', ['results' => $results]);

        return $pdf->stream('jurnal.pdf');
    }
}