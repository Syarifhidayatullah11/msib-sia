@extends('app')

@section('isi')
    <!-- resources/views/akuns1/index.blade.php -->
    <h1><b>Daftar Kategori</b></h1>

    <a href="{{ route('akuns1.create') }}" class="btn btn-primary">Tambah Kategori</a>

    <table class="table table-bordered border-5" style="margin-top: 30px;">
        <thead>
            <tr style="background-color: #C3F2FF;" class=" text-center">
                <th width="150px" >Kode Kategori</th>
                <th width="1000px">Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($akuns1 as $akun1)
                <tr>
                    <td>{{ $akun1->kode_akun1 }}</td>
                    <td>{{ $akun1->nama_akun1 }}</td>
                    <td>
                        <a href="{{ route('akuns1.edit', $akun1->kode_akun1) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('akuns1.destroy', $akun1->kode_akun1) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="show-alert-delete-box btn btn-danger" data-toggle="tooltip">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
