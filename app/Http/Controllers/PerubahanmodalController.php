<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailTransaksi;


class PmodalController extends Controller
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
            ->select('transaksi.tanggal', 'transaksi.kode_voucher', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'detail_transaksi.debit', 'detail_transaksi.kredit', 'akuns1.nama_akun1')
            ->get();

        $modalAwal = $this->hitungModalAwal();

        $modalAwal = 0;
        $pendapatan = 0;
        $prive = 0;
        $labarugi = 0;
        $totalDebit = 0;

        foreach ($data as $row) {
            if ($row->kode_akun3 == 31) {
                $modalAwal = $row->totalKredit;
            }
            if ($row->kode_akun3 == 40) {
                $pendapatan = $row->totalKredit + $row->totalKredit;
            }
            if ($row->kode_akun3 == 34) {
                $prive = $row->totalDebit;
            }
            if (substr($row->kode_akun3,0,2) == 50) {
                $totalDebit = $totalDebit + $row->totalDebit;
            }
        }
        // Mengelompokkan data berdasarkan kode akun
        $groupedData = $data->groupBy('kode_akun2');

        $beban = $totalDebit + $totalDebit;

        $rowdatanew['modalAwal'] = $modalAwal;
        $rowdatanew['pendapatan'] = $pendapatan;
        $rowdatanew['prive'] = $prive;
        $rowdatanew['beban'] = $beban;
        $rowdatanew['labarugi'] = $labarugi;

        $rowdatanew['penambahanmodal'] = $rowdatanew['labarugi'] - $prive;
        $rowdatanew['modalAkhir'] = $rowdatanew['penambahanmodal'] + $modalAwal;

        return view('pmodal.index', compact('groupedData', 'modalAwal'));
    }

    private function hitungModalAwal()
    {
        // Mengambil data modal awal dari tabel transaksi dan detail_transaksi
        $modalAwal = DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
            ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
            ->where('akuns1.nama_akun1', 'Modal')
            ->sum('detail_transaksi.debit') - DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('akuns3', 'detail_transaksi.kode_akun3', '=', 'akuns3.kode_akun3')
            ->join('akuns2', 'akuns3.kode_akun2', '=', 'akuns2.kode_akun2')
            ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
            ->where('akuns1.nama_akun1', 'Modal')
            ->sum('detail_transaksi.kredit');

        return $modalAwal;
    }

}
