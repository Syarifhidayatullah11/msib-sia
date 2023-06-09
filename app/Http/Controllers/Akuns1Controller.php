<?php


namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Akuns1;

class Akuns1Controller extends Controller
{
    public function index()
    {
        $akuns1 = Akuns1::all();
        return view('akuns1.index', compact('akuns1'));
    }

    public function create()
    {
        return view('akuns1.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'kode_akun1' => 'required',
            'nama_akun1' => 'required',
        ]);
    
        $namaAkun1 = $request->input('nama_akun1');
        $kodeAkun1 = $request->input('kode_akun1');
    
        $akun1 = Akuns1::create([
            'kode_akun1' => $kodeAkun1,
            'nama_akun1' => $namaAkun1,
        ]);
    
        return redirect()->route('akuns1.index')->with('success', 'Daftar Kategori Akun berhasil ditambahkan.');
    }
    
    

    public function show($id)
    {
        $akun1 = Akuns1::findOrFail($id);
        return view('akuns1.show', compact('akun1'));
    }

    public function edit($id)
    {
        $akun1 = Akuns1::findOrFail($id);
        return view('akuns1.edit', compact('akun1'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_akun1' => 'required',
            'nama_akun1' => 'required',
        ]);

        $akun1 = Akuns1::findOrFail($id);
        $akun1->update($request->all());

        return redirect()->route('akuns1.index')->with('success', 'Daftar Kategori Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $akun1 = Akuns1::findOrFail($id);
        $akun1->akuns2()->delete(); // Hapus relasi dengan Akuns2 terlebih dahulu
        $akun1->delete();

        return redirect()->route('akuns1.index')->with('success', 'Daftar Kategori Akun berhasil dihapus.');
    }

}
