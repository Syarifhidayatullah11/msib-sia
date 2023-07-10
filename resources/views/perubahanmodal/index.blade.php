@extends('app')

@section('isi')
    <div class="container">
        <h1>Laporan Perubahan Modal</h1>
        <div class="card-body p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Modal Awal</td>
                        <td>{{ number_format($modalAwal) }}</td>
                    </tr>
                    <tr>
                        <td>Laba Rugi</td>
                        <td>{{ number_format($labaRugi) }}</td>
                    </tr>
                    <tr>
                        <td>Prive</td>
                        <td>{{ number_format($prive) }}</td>
                    </tr>
                    <tr>
                        <td>Penambahan Modal</td>
                        <td>{{ number_format($penambahanModal) }}</td>
                    </tr>
                    <tr>
                        <td>Modal Akhir</td>
                        <td>{{ number_format($modalAkhir) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
