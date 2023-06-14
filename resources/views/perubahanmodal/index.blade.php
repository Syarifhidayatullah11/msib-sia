@extends('app')

@section('isi')
    <div class="container">
        <h1>Laporan Perubahan Modal </h1>
        <div class="card-body p-4">
            <table class="table table-hover table-striped table-md">
                <thead>

                </thead>
                <tbody>
                    @php
                        $totalPendapatan = 0;
                        $totalPengeluaran = 0;
                        $totalPrive = 0;
                        $penambahanModal = 0;
                    @endphp

                    @foreach ($groupedData as $kodeAkun => $rows)
                        @php
                            $saldo = 0;
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
                                        $totalPengeluaran += $nilaiPerubahan;
                                        break;
                                    case 'Prive':
                                        // Akun Prive
                                        $nilaiPerubahan = $debit - $kredit;
                                        $totalPrive += $nilaiPerubahan;
                                        break;
                                    case 'Penambahan Modal':
                                        // Akun Penambahan Modal
                                        $nilaiPerubahan = $kredit - $debit;
                                        $penambahanModal += $nilaiPerubahan;
                                        break;
                                    default:
                                        $nilaiPerubahan = 0;
                                        break;
                                }
                                
                                // Menghitung saldo berdasarkan nilai perubahan
                                $saldo += $nilaiPerubahan;
                            @endphp
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-left">Modal Awal</td>
                        <td></td>
                        <td class="text-right">{{ number_format($modalAwal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="padding-left:3em">Laba Rugi</td>
                        <td></td>
                        <td class="text-right" style="padding-right:6em">
                            {{ number_format($totalPendapatan - $totalPengeluaran, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="padding-left:3em;">Prive</td>
                        <td></td>
                        <td class="text-right" style="padding-right:6em">{{ number_format($totalPrive, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Penambahan Modal</td>
                        <td></td>
                        <td class="text-right">
                            {{ number_format($totalPendapatan - $totalPengeluaran - $totalPrive, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Modal Akhir</td>
                        <td></td>
                        <td class="text-right">
                            {{ number_format($totalPendapatan - $totalPengeluaran - $totalPrive + $penambahanModal + $modalAwal, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
