<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukubesarController extends Controller
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

        // Menghitung saldo berdasarkan jenis transaksi dan total saldo
        $totalSaldo = 0;
        foreach ($groupedData as $kodeAkun => $rows) {
            $saldo = 0;
            foreach ($rows as $row) {
                $debit = $row->debit;
                $kredit = $row->kredit;

                // Menentukan jenis akun berdasarkan nama akun
                switch ($row->nama_akun1) {
                    case 'Aktiva':
                        // Akun Aktiva
                        $nilaiPerubahan = $debit - $kredit;
                        break;
                    case 'Pasiva':
                        // Akun Pasiva
                        $nilaiPerubahan = $kredit - $debit;
                        break;
                    case 'Pendapatan':
                        // Akun Pendapatan
                        $nilaiPerubahan = $kredit - $debit;
                        break;
                    case 'Pengeluaran':
                        // Akun Pengeluaran
                        $nilaiPerubahan = $debit - $kredit;
                        break;
                    default:
                        $nilaiPerubahan = 0;
                        break;
                }

                // Menghitung saldo berdasarkan nilai perubahan
                $saldo += $nilaiPerubahan;

                // Menambahkan kolom saldo ke setiap baris
                $row->saldo = $saldo;

                // Mengupdate total saldo
                $totalSaldo += $saldo;
            }
        }

        return view('bukubesar.index', compact('groupedData', 'totalSaldo'));
    }
}
