<!-- index.blade.php -->
@extends('app')

@section('isi')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Daftar Golongan Akun</b></h3>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('akuns2.create') }}" class="btn btn-primary">Tambah Data</a>
                        </div>

                        <form action="{{ route('akuns2.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari data..." name="search"
                                    value="{{ request()->get('search') }}">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>

                        <table class="table table-striped border" style="margin-top: 30px;">
                            <thead>
                                <tr style="background-color:#C3C6FF;">
                                    <th scope="col">Kode Golongan Akun</th>
                                    <th scope="col">Nama Golongan Akun</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $result->kode_akun2 }}</td>
                                        <td>{{ $result->nama_akun2 }}</td>
                                        <td>{{ $result->nama_akun1 }}</td>
                                        <td>
                                            <a href="{{ route('akuns2.edit', $result->kode_akun2) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('akuns2.destroy', $result->kode_akun2) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="show-alert-delete-box btn btn-danger"
                                                    data-toggle="tooltip">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
