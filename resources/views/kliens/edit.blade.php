@extends('app')

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Edit Klien</h2>
                    <a href="{{ route('kliens.index') }}" class="btn btn-primary">Kembali</a>
                </div>

                <form action="{{ route('kliens.update', $klien->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kode_klien">Kode Klien:</label>
                        <input type="text" name="kode_klien" id="kode_klien" class="form-control"
                            value="{{ $klien->kode_klien }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_klien">Nama Klien:</label>
                        <input type="text" name="nama_klien" id="nama_klien" class="form-control"
                            value="{{ $klien->nama_klien }}" required>
                    </div>

                    <div class="form-group">
                        <label for="instansi">Instansi:</label>
                        <input type="text" name="instansi" id="instansi" class="form-control"
                            value="{{ $klien->instansi }}" required>
                    </div>

                    <div class="form-group">
                        <label for="no_tlpn">No. Telepon:</label>
                        <input type="text" name="no_tlpn" id="no_tlpn" class="form-control"
                            value="{{ $klien->no_tlpn }}" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea name="alamat" id="alamat" class="form-control" required>{{ $klien->alamat }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">Tanggal:</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $klien->date }}"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
