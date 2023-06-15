<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Posisi Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Posisi Keuangan</h1>
        <div class="card-body p-4">
            <div class="table-responsive">
            <table class="table table-hover table-striped table-md">
                <thead>
                    <tr>
                        <th>AKTIVA</th>
                        <th></th>
                        <th></th>
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
                    $row->nama_akun3 == 'Kas'
                    )
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
                        <td class="text-right">{{ $saldo >= 0 ? number_format($saldo, 2) : '('.number_format(abs($saldo), 2).')' }}</td>
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
                        <th></th>
                        <th></th>
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
                    $row->nama_akun2 == 'Modal Akhir'
                    )
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
                        <td class="text-right">{{ $saldo >= 0 ? number_format($saldo, 2) : '('.number_format(abs($saldo), 2).')' }}</td>
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
</body>
</html>