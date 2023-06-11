<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Akuns3;
use App\Models\Akuns1;
use App\Models\Akuns2;

class Akuns3Controller extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('akuns3')
            ->select('akuns1.nama_akun1', 'akuns2.nama_akun2', 'akuns3.kode_akun3', 'akuns3.nama_akun3', 'akuns3.saldo_awal', 'akuns3.saldo_akhir')
            ->join('akuns2', 'akuns2.kode_akun2', '=', 'akuns3.kode_akun2')
            ->join('akuns1', 'akuns1.kode_akun1', '=', 'akuns3.kode_akun1');

        if ($search) {
            $query->where('akuns3.nama_akun3', 'LIKE', "%$search%")
                ->orWhere('akuns3.kode_akun3', 'LIKE', "%$search%");
        }

        $results = $query->paginate(10);

        return view('akuns3.index', compact('results', 'search'));
    }

    public function create()
    {
        $akuns1 = Akuns1::all();
        $akuns2 = Akuns2::all();

        return view('akuns3.create', compact('akuns1', 'akuns2'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_akun1' => 'required',
            'kode_akun2' => 'required',
            'kode_akun3' => 'required',
            'nama_akun3' => 'required',
            'saldo_awal' => 'required|numeric',
            'saldo_akhir' => 'required|numeric',
        ]);

        Akuns3::create($request->all());

        return redirect()->route('akuns3.index')->with('success', 'Daftar Akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $akun3 = Akuns3::findOrFail($id);
        $akuns1 = Akuns1::all();
        $akuns2 = Akuns2::all();

        return view('akuns3.edit', compact('akun3', 'akuns1', 'akuns2'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_akun3' => 'required',
            'nama_akun3' => 'required',
            'kode_akun1' => 'required',
            'saldo_awal' => 'required|numeric',
            'saldo_akhir' => 'required|numeric',
        ]);

        $akun3 = Akuns3::findOrFail($id);
        $akun3->fill($request->all());
        $akun3->save();

        return redirect()->route('akuns3.index')->with('success', 'Daftar Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $akun3 = Akuns3::findOrFail($id);
        $akun3->detailPenyesuaian()->delete();
        $akun3->detailTransaksi()->delete();
        $akun3->delete();

        return redirect()->route('akuns3.index')->with('success', 'Daftar Akun berhasil dihapus.');
    }
}
