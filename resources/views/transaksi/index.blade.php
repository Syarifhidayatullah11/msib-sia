@extends('app')

@section('isi')
    <div class="container">
        <h2>List Transaksi</h2>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: #C3C6FF;">
                    <th>No.</th>
                    <th>Kode Voucher</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Keterangan Jurnal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kode_voucher }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->ket_jurnal }}</td>
                        <td>
                            <a href="{{ route('transaksi.show', $item->id_transaksi) }}" class="btn btn-primary">Detail</a>
                            <a href="{{ route('transaksi.edit', $item->id_transaksi) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('transaksi.destroy', $item->id_transaksi) }}" method="POST"
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
        {{ $transaksi->links() }}
    </div>
@endsection
