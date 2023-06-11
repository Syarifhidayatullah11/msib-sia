<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use Illuminate\Http\Request;

class KlienController extends Controller
{
    public function index()
    {
        $klien = Klien::all();
        return view('kliens.index', compact('klien'));
    }

    public function create()
    {
        return view('kliens.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_klien' => 'required',
        'nama_klien' => 'required',
        'instansi' => 'required',
        'no_tlpn' => 'required',
        'alamat' => 'required',
        'date' => 'required',
    ]);

    $klien = Klien::create([
        'kode_klien' => $request->kode_klien,
        'nama_klien' => $request->nama_klien,
        'instansi' => $request->instansi,
        'no_tlpn' => $request->no_tlpn,
        'alamat' => $request->alamat,
        'date' => $request->date,
    ]);

    return redirect()->route('kliens.index')
        ->with('success', 'Data Klien berhasil ditambahkan.');
}


    public function edit(Klien $klien)
    {
        return view('kliens.edit', compact('klien'));
    }

    public function update(Request $request, Klien $klien)
{
    $request->validate([
        'kode_klien' => 'required',
        'nama_klien' => 'required',
        'instansi' => 'required',
        'no_tlpn' => 'required',
        'alamat' => 'required',
        'date' => 'required',
    ]);

    $klien->update([
        'kode_klien' => $request->kode_klien,
        'nama_klien' => $request->nama_klien,
        'instansi' => $request->instansi,
        'no_tlpn' => $request->no_tlpn,
        'alamat' => $request->alamat,
        'date' => $request->date,
    ]);

    return redirect()->route('kliens.index')
        ->with('success', 'Data Klien berhasil diperbarui.');
}


    public function destroy(Klien $klien)
    {
        $klien->delete();

        return redirect()->route('kliens.index')
            ->with('success', 'Data Klien berhasil dihapus.');
    }
}
