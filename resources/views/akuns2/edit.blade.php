<!-- edit.blade.php -->
@extends('app')

@section('isi')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Golongan Akun</div>

                    <div class="card-body">
                        <form id="edit-form" method="POST" action="{{ route('akuns2.update', $akun2->kode_akun2) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="kode_akun2" class="col-md-4 col-form-label text-md-right">Kode Golongan
                                    Akun</label>

                                <div class="col-md-6">
                                    <input id="kode_akun2" type="text"
                                        class="form-control @error('kode_akun2') is-invalid @enderror" name="kode_akun2"
                                        value="{{ old('kode_akun2', $akun2->kode_akun2) }}" required
                                        autocomplete="kode_akun2" autofocus>

                                    @error('kode_akun2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_akun2" class="col-md-4 col-form-label text-md-right">Nama Akun2</label>

                                <div class="col-md-6">
                                    <input id="nama_akun2" type="text"
                                        class="form-control @error('nama_akun2') is-invalid @enderror" name="nama_akun2"
                                        value="{{ old('nama_akun2', $akun2->nama_akun2) }}" required
                                        autocomplete="nama_akun2">

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
                                            <option value="{{ $akun1->kode_akun1 }}"
                                                {{ $akun1->kode_akun1 == $akun2->akun1->kode_akun1 ? 'selected' : '' }}>
                                                {{ $akun1->nama_akun1 }}
                                            </option>
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

    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>

    <script>
        // When the form is submitted
        document.getElementById('edit-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Simpan Perubahan?',
                text: 'Apakah Anda yakin ingin menyimpan perubahan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, submit the form
                    document.getElementById('edit-form').submit();
                }
            });
        });
    </script>
@endsection
