<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerubahanmodalController extends Controller
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

        $modalAwal = $this->hitungModalAwal($data);
        $prive = $this->hitungTotalPrive($data);

        $pendapatan = 0;
        $labarugi = 0;
        $totalDebit = 0;

        foreach ($data as $row) {
            if ($row->kode_akun3 == 40) {
                $pendapatan += $row->kredit;
            }
            if (substr($row->kode_akun3, 0, 2) == 50) {
                $totalDebit += $row->debit;
            }
        }

        // Mengelompokkan data berdasarkan kode akun
        $groupedData = $data->groupBy('kode_akun3');

        $beban = $totalDebit + $totalDebit;

        $rowdatanew['modalAwal'] = $modalAwal;
        $rowdatanew['pendapatan'] = $pendapatan;
        $rowdatanew['prive'] = $prive;
        $rowdatanew['beban'] = $beban;
        $rowdatanew['labarugi'] = $labarugi;

        $rowdatanew['penambahanmodal'] = $rowdatanew['labarugi'] - $prive;
        $rowdatanew['modalAkhir'] = $rowdatanew['penambahanmodal'] + $modalAwal;

        return view('perubahanmodal.index', compact('groupedData', 'modalAwal'));
    }

    private function hitungModalAwal($data)
    {
        $modalAwal = 0;

        foreach ($data as $row) {
            if ($row->kode_akun3 == '3100' || $row->kode_akun3 == '3110' || $row->kode_akun3 == '3120' || $row->kode_akun3 == '3130' || $row->kode_akun3 == '3140') {
                $modalAwal += $row->debit - $row->kredit;
            }
        }

        return $modalAwal;
    }

    private function hitungTotalPrive($data)
    {
        $prive = 0;

        foreach ($data as $row) {
            if ($row->nama_akun3 == 'Prive') {
                $prive += $row->debit - $row->kredit;
            }
        }

        return $prive;
    }
}
