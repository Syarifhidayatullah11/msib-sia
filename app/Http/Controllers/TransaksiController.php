<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Akuns3;
use App\Models\Status;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->paginate(10);
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
{
    $akuns3 = Akuns3::all();
    $statuses = Status::all(); // Mengubah variabel menjadi "status"
    return view('transaksi.create', compact('akuns3', 'statuses')); // Menyertakan data status ke dalam compact()
}

public function store(Request $request)
{
    $request->validate([
        'kode_voucher' => 'required',
        'tanggal' => 'required',
        'deskripsi' => 'required',
        'ket_jurnal' => 'required',
        'kode_akun3.*' => 'required',
        'debit.*' => 'required|numeric|min:0',
        'kredit.*' => 'required|numeric|min:0',
        'status_id.*' => 'required',
    ]);

    $transaksi = Transaksi::create([
        'kode_voucher' => $request->kode_voucher,
        'tanggal' => $request->tanggal,
        'deskripsi' => $request->deskripsi,
        'ket_jurnal' => $request->ket_jurnal,
    ]);

    $akuns3 = $request->input('kode_akun3');
    $debit = $request->input('debit');
    $kredit = $request->input('kredit');
    $statuses = $request->input('status_id');

    foreach ($akuns3 as $key => $value) {
        DetailTransaksi::create([
            'id_transaksi' => $transaksi->id_transaksi,
            'kode_akun3' => $value,
            'debit' => $debit[$key],
            'kredit' => $kredit[$key],
            'status_id' => $statuses[$key],
        ]);
    }

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
}


    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $detailTransaksi = DetailTransaksi::where('id_transaksi', $id)->get();
        return view('transaksi.show', compact('transaksi', 'detailTransaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $detailTransaksi = DetailTransaksi::where('id_transaksi', $id)->get();
        $akuns3 = Akuns3::all();
        $statuses = Status::all(); // Menambahkan variabel $statuses
        return view('transaksi.edit', compact('transaksi', 'detailTransaksi', 'akuns3', 'statuses')); // Menyertakan data $statuses ke dalam compact()
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'kode_voucher' => 'required',
        'tanggal' => 'required',
        'deskripsi' => 'required',
        'ket_jurnal' => 'required',
        'kode_akun3.*' => 'required',
        'debit.*' => 'required|numeric|min:0',
        'kredit.*' => 'required|numeric|min:0',
        'status_id.*' =>'required',
    ]);

    $transaksi = Transaksi::findOrFail($id);
    $transaksi->update([
        'kode_voucher' => $request->kode_voucher,
        'tanggal' => $request->tanggal,
        'deskripsi' => $request->deskripsi,
        'ket_jurnal' => $request->ket_jurnal,
    ]);

    $akuns3 = $request->input('kode_akun3');
    $debit = $request->input('debit');
    $kredit = $request->input('kredit');
    $statuses = $request->input('status_id');

    DetailTransaksi::where('id_transaksi', $id)->delete();

    foreach ($akuns3 as $key => $value) {
        DetailTransaksi::create([
            'id_transaksi' => $id,
            'kode_akun3' => $value,
            'debit' => $debit[$key],
            'kredit' => $kredit[$key],
            'status_id' => $statuses[$key],
        ]);
    }

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
}

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $detailTransaksi = DetailTransaksi::where('id_transaksi', $id)->get();


        // Hapus detail transaksi
        DetailTransaksi::where('id_transaksi', $id)->delete();

        // Hapus transaksi
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }


    public function vouchercetak($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $detailTransaksi = DetailTransaksi::where('id_transaksi', $id)->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.vouchercetak', compact('transaksi', 'detailTransaksi'));

        return $pdf->stream('detail_transaksi.pdf');
    }
}
