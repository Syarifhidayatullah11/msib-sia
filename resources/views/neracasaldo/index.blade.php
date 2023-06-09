@extends('app')

@section('isi')
    <div class="container">
        <h1>Neraca Saldo</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th class="text-right">Debit</th>
                    <th class="text-right">Kredit</th>
                    <th class="text-right">Saldo</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDebit = 0;
                    $totalKredit = 0;
                @endphp

                @foreach ($groupedData as $kodeAkun => $rows)
                    @php
                        $saldo = 0;
                    @endphp

                    @foreach ($rows as $row)
                        @php
                            $debit = $row->debit;
                            $kredit = $row->kredit;
                            
                            // Menentukan jenis akun berdasarkan nama akun
                            switch ($row->nama_akun1) {
                                case 'Aktiva':
                                    // Akun Aktiva
                                    $nilaiPerubahan = $debit - $kredit;
                                    break;
                                case 'Pasiva':
                                    // Akun Pasiva
                                    $nilaiPerubahan = $kredit - $debit;
                                    break;
                                case 'Pendapatan':
                                    // Akun Pendapatan
                                    $nilaiPerubahan = $kredit - $debit;
                                    break;
                                case 'Pengeluaran':
                                    // Akun Pengeluaran
                                    $nilaiPerubahan = $debit - $kredit;
                                    break;
                                default:
                                    $nilaiPerubahan = 0;
                                    break;
                            }
                            
                            // Menghitung saldo berdasarkan nilai perubahan
                            $saldo += $nilaiPerubahan;
                            
                            // Mengupdate total debit dan kredit
                            $totalDebit += $debit;
                            $totalKredit += $kredit;
                        @endphp
                    @endforeach

                    <tr>
                        <td>{{ $kodeAkun }}</td>
                        <td>{{ $rows[0]->nama_akun3 }}</td>
                        <td class="text-right">{{ number_format($rows->sum('debit'), 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($rows->sum('kredit'), 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($saldo, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Total</strong></td>
                    <td></td>
                    <td class="text-right">{{ number_format($totalDebit, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($totalKredit, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($totalDebit - $totalKredit, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
