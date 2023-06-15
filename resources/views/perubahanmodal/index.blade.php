@extends('app')

@section('isi')
    <div class="container">
        <h1>Laporan Perubahan Modal </h1>
        <div class="card-body p-4">
            <table class="table table-hover table-striped table-md">
                <thead>
                    <tr>
                        <th>Modal Awal</th>
                        <th>Laba Rugi</th>
                        <th>Prive</th>
                        <th>Perubahan Modal</th>
                        <th>Modal Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ number_format($modalAwal['total'], 0, ',', '.') }}</td>
                        <td>{{ number_format($labaRugi, 0, ',', '.') }}</td>
                        <td>{{ number_format($prive, 0, ',', '.') }}</td>
                        <td>{{ number_format($penambahanModal, 0, ',', '.') }}</td>
                        <td>{{ number_format($modalAkhir, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
