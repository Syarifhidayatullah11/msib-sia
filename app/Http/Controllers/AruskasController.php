<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\Akuns3;

class AruskasController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->input('bulan_tahun');

        // Mengambil semua detail transaksi
        $detailTransaksis = DetailTransaksi::all();

        // Inisialisasi saldo kategori
        $operasional = 0;
        $investasi = 0;
        $pendanaan = 0;

        // Loop melalui setiap detail transaksi dan mengelompokkan ke dalam kategori yang sesuai
        foreach ($detailTransaksis as $detailTransaksi) {
            $kodeAkun3 = $detailTransaksi->kode_akun3;

             // Menyaring transaksi berdasarkan periode yang dipilih
        if ($periode && $detailTransaksi->tanggal < $periode) {
            continue;
        }

            // Mengambil akun3 berdasarkan kode akun3 pada detail transaksi
            $akun3 = Akuns3::find($kodeAkun3);

            if ($akun3) {
                // Mengelompokkan transaksi ke dalam kategori yang sesuai berdasarkan kode_akun2 dari akun3
                switch ($akun3->akun2->kode_akun2) {
                    case '50':
                        // Kategori Beban Usaha
                        $operasional -= $detailTransaksi->debit;
                        break;
                    case '60':
                        // Kategori Pengeluaran Lain-lain
                        $operasional -= $detailTransaksi->debit;
                        break;
                    case '15':
                        // Kategori Aset Tetap
                        $investasi -= $detailTransaksi->debit;
                        break;
                    case '17':
                        // Kategori Aset Lain-lain
                        $investasi -= $detailTransaksi->debit;
                        break;
                    case '27':
                        // Kategori Liabilitas Jangka Panjang
                        $pendanaan += $detailTransaksi->kredit;
                        break;
                    case '31':
                        // Kategori Modal Pemilik
                        $pendanaan += $detailTransaksi->kredit;
                        break;
                    default:
                        // Kategori lainnya
                        break;
                }
            }
        }

        // Menampilkan data arus kas
        return view('aruskas.index', compact('operasional', 'investasi', 'pendanaan','periode'));
    }
}
