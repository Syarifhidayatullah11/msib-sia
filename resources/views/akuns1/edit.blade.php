@extends('app')

@section('isi')
    <!-- resources/views/akuns1/edit.blade.php -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h3><b>Edit Kategori</b></h3>
        </div>

        <div class="card-body">
            <form id="edit-form" action="{{ route('akuns1.update', $akun1->kode_akun1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kode_akun1">Kode Kategori:</label>
                    <input type="number" name="kode_akun1" class="form-control" value="{{ $akun1->kode_akun1 }}" required>
                </div>
                <div class="form-group">
                    <label for="nama_akun1">Nama Kategori:</label>
                    <input type="text" name="nama_akun1" class="form-control" value="{{ $akun1->nama_akun1 }}" required>
                </div>
                <button id="submit-btn" type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('akuns1.index') }}" class="btn btn-secondary">Batal</a>
            </form>
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
