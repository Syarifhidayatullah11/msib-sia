@extends('app')

@section('isi')
    <div class="container">
        <h1>Laporan Laba Rugi</h1>

        <div class="row">
            <div class="col-md-4">
                <label for="tanggal_awal">Tanggal Awal:</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                    value="{{ request('tanggal_awal') }}">
            </div>
            <div class="col-md-4">
                <label for="tanggal_akhir">Tanggal Akhir:</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                    value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
                <a href="{{ route('jurnalmemorial.cetak', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                    class="btn btn-primary" target="_blank">Cetak</a>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-left">PENDAPATAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPendapatan = 0;
                    $totalBeban = 0;
                @endphp

                @foreach ($groupedData as $kodeAkun => $rows)
                    @php
                        $nilaiPerubahan = 0;
                    @endphp

                    @foreach ($rows as $row)
                        @php
                            $debit = $row->debit;
                            $kredit = $row->kredit;
                            
                            // Menentukan jenis akun berdasarkan nama akun
                            switch ($row->nama_akun1) {
                                case 'Pendapatan':
                                    // Akun Pendapatan
                                    $nilaiPerubahan = $kredit - $debit;
                                    $totalPendapatan += $nilaiPerubahan;
                                    break;
                                case 'Pengeluaran':
                                    // Akun Pengeluaran
                                    $nilaiPerubahan = $debit - $kredit;
                                    $totalBeban += $nilaiPerubahan;
                                    break;
                                default:
                                    $nilaiPerubahan = 0;
                                    break;
                            }
                        @endphp
                    @endforeach

                    @if ($nilaiPerubahan != 0)
                        {{-- Hanya menampilkan akun dengan nilai perubahan tidak sama dengan 0 --}}
                        <tr>
                            <td>{{ $kodeAkun }}</td>
                            <td>{{ $rows[0]->nama_akun3 }}</td>
                            <td class="text-right">{{ number_format($rows->sum('debit'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($rows->sum('kredit'), 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Total Pendapatan</strong></td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Total Beban</strong></td>
                    <td></td>
                    <td class="text-right">{{ number_format($totalBeban, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Laba Rugi</strong></td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{ number_format($totalPendapatan - $totalBeban, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
