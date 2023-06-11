@extends('app')

@section('isi')
    <div class="container">
        <h1>Edit Daftar Akun</h1>

        <form id="edit-form" action="{{ route('akuns3.update', $akun3->kode_akun3) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode_akun1">Nama Kategori</label>
                <select class="form-control" id="kode_akun1" name="kode_akun1">
                    @foreach ($akuns1 as $akun1)
                        <option value="{{ $akun1->kode_akun1 }}" @if ($akun1->kode_akun1 === $akun3->kode_akun1) selected @endif>
                            {{ $akun1->nama_akun1 }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_akun2">Golongan Akun</label>
                <select class="form-control" id="kode_akun2" name="kode_akun2">
                    @foreach ($akuns2 as $akun2)
                        <option value="{{ $akun2->kode_akun2 }}" @if ($akun2->kode_akun2 === $akun3->kode_akun2) selected @endif>
                            {{ $akun2->nama_akun2 }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_akun3">Kode Akun</label>
                <input type="text" class="form-control" id="kode_akun3" name="kode_akun3"
                    value="{{ $akun3->kode_akun3 }}">
            </div>
            <div class="form-group">
                <label for="nama_akun3">Nama Akun</label>
                <input type="text" class="form-control" id="nama_akun3" name="nama_akun3"
                    value="{{ $akun3->nama_akun3 }}">
            </div>
            <div class="form-group">
                <label for="saldo_awal">Saldo Awal</label>
                <input type="number" class="form-control" id="saldo_awal" name="saldo_awal"
                    value="{{ $akun3->saldo_awal }}">
            </div>
            <div class="form-group">
                <label for="saldo_akhir">Saldo Akhir</label>
                <input type="number" class="form-control" id="saldo_akhir" name="saldo_akhir"
                    value="{{ $akun3->saldo_akhir }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('akuns3.index') }}" class="btn btn-secondary">Batal</a>
        </form>
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
