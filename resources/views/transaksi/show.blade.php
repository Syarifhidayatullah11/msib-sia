@extends('app')

@section('isi')
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6">
                <h2 style="margin-top: 10px;">Detail Transaksi</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('transaksi.vouchercetak', ['id' => $transaksi->id_transaksi]) }}" class="btn btn-primary"
                    target="_blank" style="margin-top: 10px;">Cetak Transaksi</a>
            </div>
        </div>
        <div class="row" style="margin-bottom: 5px;">
            <!-- Rest of the content for the detail transaction -->
        </div>
    </div>
    <table class="table">
        <tr>
            <th>Kode Voucher:</th>
            <td>{{ $transaksi->kode_voucher }}</td>
        </tr>
        <tr>
            <th>Tanggal:</th>
            <td>{{ $transaksi->tanggal }}</td>
        </tr>
        <tr>
            <th>Deskripsi:</th>
            <td>{{ $transaksi->deskripsi }}</td>
        </tr>
        <tr>
            <th>Keterangan Jurnal:</th>
            <td>{{ $transaksi->ket_jurnal }}</td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th>Kode Akun</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailTransaksi as $detail)
                <tr>
                    <td>{{ $detail->kode_akun3 }} | {{ $detail->akuns3->nama_akun3 }}</td>
                    <td>{{ $detail->debit }}</td>
                    <td>{{ $detail->kredit }}</td>
                    <td>{{ $detail->status->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
