@extends('app')

@section('isi')
    <div class="container">
        <h1>Neraca Saldo</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Akun</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDebit = 0;
                    $totalKredit = 0;
                @endphp

                @foreach ($data as $row)
                    @php
                        $saldo = $row->saldo;
                        
                        // Menentukan apakah saldo termasuk dalam kolom debit atau kredit berdasarkan nilai saldo
                        if ($saldo >= 0) {
                            $debit = $saldo;
                            $kredit = 0;
                        } else {
                            $debit = 0;
                            $kredit = abs($saldo);
                        }
                        
                        $totalDebit += $debit;
                        $totalKredit += $kredit;
                    @endphp

                    <tr>
                        <td>{{ $row->nama_akun3 }}</td>
                        <td>{{ number_format($debit, 0, ',', '.') }}</td>
                        <td>{{ number_format($kredit, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td><strong>Total</strong></td>
                    <td>{{ number_format($totalDebit, 0, ',', '.') }}</td>
                    <td>{{ number_format($totalKredit, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
