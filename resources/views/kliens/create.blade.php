@extends('app')

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Tambah Klien</h2>
                    <a href="{{ route('kliens.index') }}" class="btn btn-primary">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('kliens.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="kode_klien">Kode Klien:</label>
                            <input type="number" name="kode_klien" id="kode_klien" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_klien">Nama Klien:</label>
                            <input type="text" name="nama_klien" id="nama_klien" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="instansi">Instansi:</label>
                            <input type="text" name="instansi" id="instansi" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="no_tlpn">No. Telepon:</label>
                            <input type="number" name="no_tlpn" id="no_tlpn" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="date">Tanggal:</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
