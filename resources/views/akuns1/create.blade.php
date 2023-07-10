@extends('app')
@section('title', 'Akun - Tambah Kategori')

@section('isi')
    <!-- resources/views/akuns1/create.blade.php -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h3><b>Tambah Kategori</b></h3>
        </div>

        <div class="card-body">
            <form action="{{ route('akuns1.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_akun1">Kode Kategori:</label>
                    <input type="text" name="kode_akun1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama_akun1">Nama Kategori:</label>
                    <input type="text" name="nama_akun1" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('akuns1.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
