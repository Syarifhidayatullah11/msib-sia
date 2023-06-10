<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Akuns2;
use App\Models\Akuns1;

class Akuns2Controller extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = DB::table('akuns2')
            ->join('akuns1', 'akuns2.kode_akun1', '=', 'akuns1.kode_akun1')
            ->select('akuns2.kode_akun2', 'akuns2.nama_akun2', 'akuns1.nama_akun1');

        if ($search) {
            $query->where('akuns2.nama_akun2', 'LIKE', "%$search%")
                ->orWhere('akuns1.nama_akun1', 'LIKE', "%$search%");
        }

        $results = $query->paginate(10); // Menampilkan 10 hasil per halaman

        return view('akuns2.index', compact('results', 'search'));
    }
    
    


    public function create()
    {
        $akuns1 = Akuns1::all();
        return view('akuns2.create', compact('akuns1'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_akun2' => 'required',
            'nama_akun2' => 'required',
            'kode_akun1' => 'required',
        ]);

        Akuns2::create($request->all());

        return redirect()->route('akuns2.index')->with('success', 'Daftar Golongan Akun berhasil ditambahkan.');
    }

    public function show($id)
    {
        $akun2 = Akuns2::findOrFail($id);
        return view('akuns2.show', compact('akun2'));
    }

    public function edit($id)
    {
        $akun2 = Akuns2::findOrFail($id);
        $akuns1 = Akuns1::all();

        return view('akuns2.edit', compact('akun2', 'akuns1'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_akun2' => 'required',
            'nama_akun2' => 'required',
            'kode_akun1' => 'required',
        ]);

        $akun2 = Akuns2::findOrFail($id);
        $akun2->update($request->all());

        return redirect()->route('akuns2.index')->with('success', 'Daftar Golongan Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $akun2 = Akuns2::findOrFail($id);
        $akun2->akuns3()->delete(); // Hapus relasi dengan Akuns3 terlebih dahulu
        $akun2->delete();

        return redirect()->route('akuns2.index')->with('success', 'Daftar Golongan Akun berhasil dihapus.');
    }

}
