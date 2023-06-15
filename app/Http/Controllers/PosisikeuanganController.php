<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class PosisikeuanganController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Mengambil data dari tabel transaksi, detail_transaksi, akuns3, akuns2, dan akuns1
        $data = DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
            ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
            ->select('transaksi.tanggal', 'transaksi.kode_voucher', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'detail_transaksi.debit', 'detail_transaksi.kredit', 'akuns1.nama_akun1', 'akuns2.nama_akun2')
            ->when($tanggalAwal, function ($query) use ($tanggalAwal) {
                return $query->where('transaksi.tanggal', '>=', $tanggalAwal);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                return $query->where('transaksi.tanggal', '<=', $tanggalAkhir);
            })
            ->get();

        // Mengelompokkan data berdasarkan kode akun
        $groupedData = $data->groupBy('kode_akun3');

        // Menghitung total saldo berdasarkan jenis transaksi
        $saldo_akun = [];
        foreach ($groupedData as $kodeAkun => $rows) {
            $nama_akun3 = '';
            $saldo = 0;

            foreach ($rows as $row) {
                if ($row->nama_akun2 == 'Aset') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Piutang dan Pajak') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Persediaan') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Pengeluaran Dibayar Dimuka') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Aset Tetap') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Penyusutan') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Aset Lain-lain') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Liabilitas') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Pajak') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Pendapatan Diterima Dimuka') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Liabilitas Jangka Panjang') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Modal Akhir') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Ikhtisar Laba Rugi') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun3 == 'Kas') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } else {
                    $saldo += $row->kredit - $row->debit;
                    $nama_akun3 = $row->nama_akun3;
                }
            }

            if ($saldo != 0) {
                $saldo_akun[$nama_akun3] = $saldo_akun[$nama_akun3] ?? 0;
                $saldo_akun[$nama_akun3] += $saldo;
            }
        }

        // Menghitung total saldo berdasarkan jenis transaksi
        $totalSaldo = collect($saldo_akun)->sum();

        return view('posisikeuangan.index', compact('groupedData', 'totalSaldo', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function cetak(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Mengambil data dari tabel transaksi, detail_transaksi, akuns3, akuns2, dan akuns1
        $data = DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
            ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
            ->select('transaksi.tanggal', 'transaksi.kode_voucher', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'detail_transaksi.debit', 'detail_transaksi.kredit', 'akuns1.nama_akun1', 'akuns2.nama_akun2') // Menambahkan 'akuns2.nama_akun2' dalam pemilihan kolom
            ->get();

        // Mengelompokkan data berdasarkan kode akun
        $groupedData = $data->groupBy('kode_akun3');

        // Menghitung total saldo berdasarkan jenis transaksi
        $saldo_akun = [];
        foreach ($groupedData as $kodeAkun => $rows) {
            $nama_akun3 = '';
            $saldo = 0;

            foreach ($rows as $row) {
                if ($row->nama_akun2 == 'Aset') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Piutang dan Pajak') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Persediaan') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Pengeluaran Dibayar Dimuka') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Aset Tetap') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Penyusutan') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Aset Lain-lain') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Liabilitas') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Pajak') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Pendapatan Diterima Dimuka') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Liabilitas Jangka Panjang') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Modal Akhir') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun2 == 'Ikhtisar Laba Rugi') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } elseif ($row->nama_akun3 == 'Kas') {
                    $saldo += $row->debit - $row->kredit;
                    $nama_akun3 = $row->nama_akun3;
                } else {
                    $saldo += $row->kredit - $row->debit;
                    $nama_akun3 = $row->nama_akun3;
                }
            }

            if ($saldo != 0) {
                $saldo_akun[$nama_akun3] = $saldo_akun[$nama_akun3] ?? 0;
                $saldo_akun[$nama_akun3] += $saldo;
            }
        }

        // Menghitung total saldo berdasarkan jenis transaksi
        $totalSaldo = collect($saldo_akun)->sum();

        // Membuat instance Dompdf
        $dompdf = new Dompdf();

        // Membuat tampilan PDF dengan view 'posisi.cetak'
        $pdf = View::make('posisikeuangan.cetakposisi', compact('groupedData', 'totalSaldo', 'tanggalAwal', 'tanggalAkhir'))->render();

        // Memasukkan tampilan PDF ke dalam Dompdf
        $dompdf->loadHtml($pdf);

        // Menentukan ukuran dan orientasi halaman PDF
        $dompdf->setPaper('A4', 'portrait');

        // Render tampilan PDF menjadi file
        $dompdf->render();

        // Menghasilkan file PDF dan mengirimkan ke browser untuk diunduh
      //  return $dompdf->stream('laporan_posisi_keuangan.pdf');

       // Mengambil konten PDF dalam bentuk string
    $output = $dompdf->output();
       // Mengirimkan konten PDF sebagai respons HTTP dengan tipe konten PDF
    return response($output, 200)->header('Content-Type', 'application/pdf');
    }


}
