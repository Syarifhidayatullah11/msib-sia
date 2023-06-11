@extends('app')

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Data Klien</h2>
                    <a href="{{ route('kliens.create') }}" class="btn btn-primary">Tambah Klien</a>
                </div>

                @if ($message = session('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Kode Klien</th>
                        <th>Nama Klien</th>
                        <th>Instansi</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($klien as $klien)
                        <tr>
                            <td>{{ $klien->id }}</td>
                            <td>{{ $klien->kode_klien }}</td>
                            <td>{{ $klien->nama_klien }}</td>
                            <td>{{ $klien->instansi }}</td>
                            <td>{{ $klien->no_tlpn }}</td>
                            <td>{{ $klien->alamat }}</td>
                            <td>{{ $klien->date }}</td>
                            <td>
                                <form action="{{ route('kliens.destroy', $klien->id) }}" method="POST">
                                    <a href="{{ route('kliens.edit', $klien->id) }}" class="btn btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
