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
            ->select(
                'transaksi.tanggal',
                'transaksi.kode_voucher',
                'akuns3.kode_akun3',
                'akuns3.nama_akun3',
                'akuns3.saldo_awal',
                'detail_transaksi.debit',
                'detail_transaksi.kredit',
                'akuns2.kode_akun2',
                'akuns2.nama_akun2'
            )
            ->where('akuns2.kode_akun2', '31')
            ->whereIn('akuns3.kode_akun3', ['3100', '3110', '3120', '3130', '3140'])
            ->get();

        $modalAwal = $this->hitungModalAwal($data);
        $labaRugi = $this->hitungLabaRugi($data);
        $prive = $this->hitungTotalPrive($data);
        $penambahanModal = $labaRugi - $prive;
        $modalAkhir = $modalAwal + $penambahanModal;


        return view('perubahanmodal.index', compact('modalAwal', 'labaRugi', 'prive', 'penambahanModal', 'modalAkhir'));
    }

    private function hitungModalAwal($data)
    {
        $modalAwal = [
            '3100' => 0,
            '3110' => 0,
            '3120' => 0,
            '3130' => 0,
            '3140' => 0
        ];

        foreach ($data as $row) {
            if ($row->kode_akun2 == '31' && in_array($row->kode_akun3, ['3100', '3110', '3120', '3130', '3140'])) {
                switch ($row->kode_akun3) {
                    case '3100':
                        $modalAwal['3100'] += $row->saldo_awal;
                        break;
                    case '3110':
                        $modalAwal['3110'] += $row->saldo_awal;
                        break;
                    case '3120':
                        $modalAwal['3120'] += $row->saldo_awal;
                        break;
                    case '3130':
                        $modalAwal['3130'] += $row->saldo_awal;
                        break;
                    case '3140':
                        $modalAwal['3140'] += $row->saldo_awal;
                        break;
                }
            }
        }



        return $modalAwal;
    }




    private function hitungLabaRugi($data)
    {
        $labaRugi = 0;

        foreach ($data as $row) {
            if ($row->nama_akun2 == 'Pendapatan' || $row->nama_akun2 == 'Beban') {
                $labaRugi += $row->debit - $row->kredit;
            }
        }

        return $labaRugi;
    }

    private function hitungTotalPrive($data)
    {

        $prive = 0;

        foreach ($data as $row) {
            if ($row->kode_akun2 == '31' && in_array($row->kode_akun3, ['3400', '3410', '3420', '3430', '3450'])) {
                $prive += $row->saldo_awal;
            }
        }



        return $prive;
    }
}
