@extends('app')

@section('isi')
    <div class="container">
        <h1><b>Laporan Posisi Keuangan</b></h1>
        <form action="{{ route('cetakposisi') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tanggalAwal">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tanggalAwal" name="tanggalAwal" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tanggalAkhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggalAkhir" name="tanggalAkhir" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Cetak</button>
                    <button type="button" class="btn btn-secondary" id="filterButton">Filter</button>
                </div>
            </div>
            <!-- Menambahkan input tersembunyi untuk menyimpan nilai filter -->
            <input type="hidden" name="filterSubmitted" value="true">
        </form>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-md">
                    <thead>
                        <tr>
                            <th>AKTIVA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $saldo_akun_aktiva = [];
                        @endphp

                        @foreach ($groupedData as $kodeAkun => $rows)
                            @php
                                $nama_akun3 = '';
                                $saldo = 0;
                            @endphp

                            @foreach ($rows as $row)
                                @if (
                                    $row->nama_akun2 == 'Aset' ||
                                        $row->nama_akun2 == 'Piutang dan Pajak' ||
                                        $row->nama_akun2 == 'Persediaan' ||
                                        $row->nama_akun2 == 'Pengeluaran Dibayar Dimuka' ||
                                        $row->nama_akun2 == 'Aset Tetap' ||
                                        $row->nama_akun2 == 'Penyusutan' ||
                                        $row->nama_akun2 == 'Aset Lain-lain' ||
                                        $row->nama_akun3 == 'Kas')
                                    @php
                                        $saldo += $row->debit - $row->kredit;
                                        $nama_akun3 = $row->nama_akun3;
                                    @endphp
                                @endif
                            @endforeach

                            @if ($saldo != 0)
                                @php
                                    $saldo_akun_aktiva[$nama_akun3] = $saldo_akun_aktiva[$nama_akun3] ?? 0;
                                    $saldo_akun_aktiva[$nama_akun3] += max($saldo, 0);
                                @endphp
                            @endif
                        @endforeach

                        @foreach ($saldo_akun_aktiva as $nama_akun3 => $saldo)
                            <tr>
                                <td class="text-left" style="padding-left: 3em;">{{ $nama_akun3 }}</td>
                                <td></td>
                                <td class="text-right">
                                    {{ $saldo >= 0 ? number_format($saldo, 2) : '(' . number_format(abs($saldo), 2) . ')' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th class="text-left">Total Aktiva</th>
                            <th></th>
                            <th class="text-right">
                                {{ number_format(array_sum($saldo_akun_aktiva), 2) }}
                            </th>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th>Kewajiban dan Modal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $saldo_akun_kewajiban_modal = [];
                        @endphp

                        @foreach ($groupedData as $kodeAkun => $rows)
                            @php
                                $nama_akun3 = '';
                                $saldo = 0;
                            @endphp

                            @foreach ($rows as $row)
                                @if (
                                    $row->nama_akun2 == 'Liabilitas' ||
                                        $row->nama_akun2 == 'Pajak' ||
                                        $row->nama_akun2 == 'Pendapatan Diterima Dimuka' ||
                                        $row->nama_akun2 == 'Liabilitas Jangka Panjang' ||
                                        $row->nama_akun2 == 'Modal Akhir')
                                    @php
                                        $saldo += $row->debit - $row->kredit;
                                        $nama_akun3 = $row->nama_akun3;
                                    @endphp
                                @endif
                            @endforeach

                            @php
                                $saldo = abs($saldo); // ubah saldo menjadi nilai absolut (positif)
                            @endphp

                            @if ($saldo != 0)
                                @php
                                    $saldo_akun_kewajiban_modal[$nama_akun3] = isset($saldo_akun_kewajiban_modal[$nama_akun3]) ? $saldo_akun_kewajiban_modal[$nama_akun3] + $saldo : $saldo;
                                @endphp
                            @endif
                        @endforeach

                        @foreach ($saldo_akun_kewajiban_modal as $nama_akun3 => $saldo)
                            <tr>
                                <td class="text-left" style="padding-left: 3em;">{{ $nama_akun3 }}</td>
                                <td></td>
                                <td class="text-right">
                                    {{ $saldo >= 0 ? number_format($saldo, 2) : '(' . number_format(abs($saldo), 2) . ')' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th class="text-left">Total Kewajiban dan Modal</th>
                            <th></th>
                            <th class="text-right">
                                {{ number_format(array_sum($saldo_akun_kewajiban_modal), 2) }}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('filterButton').addEventListener('click', function() {
                var tanggalAwal = document.getElementById('tanggalAwal').value;
                var tanggalAkhir = document.getElementById('tanggalAkhir').value;

                var form = document.querySelector('form');
                form.action = "{{ route('cetakposisi') }}";
                form.submit();
            });
        });
    </script>
@endsection
