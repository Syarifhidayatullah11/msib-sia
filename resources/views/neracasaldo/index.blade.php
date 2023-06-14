@extends('app')

@section('isi')
    <div class="container">
        <h1>Neraca Saldo</h1>

        <form action="{{ route('neracasaldo.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="tglawal">Tanggal Awal:</label>
                    <input type="date" name="tglawal" id="tglawal" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="tglakhir">Tanggal Akhir:</label>
                    <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered" style="margin-top: 5px ">
            <thead>
                <tr style="background-color: #C3C6FF;">
                    <th>Nama Akun</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDebit = 0;
                    $totalKredit = 0;
                    $totalSaldo = 0;
                @endphp

                @foreach ($data as $row)
                    @php
                        $saldoAwal = $row->saldo_awal;
                        $jumdebit = $row->jumdebit;
                        $jumkredit = $row->jumkredit;
                        $saldo = $saldoAwal + $jumdebit - $jumkredit;
                        
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
                        $totalSaldo += $saldo;
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
