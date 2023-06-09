@extends('app')

@section('isi')
    <div class="container" style="margin-left: 150px">
        <div class="row" style="width: 1500px;">
            <div class="col-md-8">
                <div class="card col-lg-12 shadow md-4">
                    <div class="card-header"><h4><b>Tambah Golongan Akun</b> </h4></div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('akuns2.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="kode_akun2" class="col-md-4 col-form-label text-md-right">Kode Golongan Akun</label>

                                <div class="col-md-6">
                                    <input id="kode_akun2" type="text"
                                        class="form-control @error('kode_akun2') is-invalid @enderror" name="kode_akun2"
                                        value="{{ old('kode_akun2') }}" required autocomplete="kode_akun2" autofocus>

                                    @error('kode_akun2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_akun2" class="col-md-4 col-form-label text-md-right">Nama Golongan Akun</label>

                                <div class="col-md-6">
                                    <input id="nama_akun2" type="text"
                                        class="form-control @error('nama_akun2') is-invalid @enderror" name="nama_akun2"
                                        value="{{ old('nama_akun2') }}" required autocomplete="nama_akun2">

                                    @error('nama_akun2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_akun1" class="col-md-4 col-form-label text-md-right">Nama Kategori</label>

                                <div class="col-md-6">
                                    <select id="kode_akun1" class="form-control @error('kode_akun1') is-invalid @enderror"
                                        name="kode_akun1" required>
                                        <option value="">Pilih Akun1</option>
                                        @foreach ($akuns1 as $akun1)
                                            <option value="{{ $akun1->kode_akun1 }}">{{ $akun1->nama_akun1 }}</option>
                                        @endforeach
                                    </select>

                                    @error('kode_akun1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <a href="{{ route('akuns2.index') }}" class="btn btn-secondary">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection