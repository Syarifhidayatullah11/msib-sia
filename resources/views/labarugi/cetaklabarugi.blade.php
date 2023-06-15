<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f5f5f5;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>

    <h3>
        <center>Laporan Laba Rugi</center>
    </h3>

    <table class="table table-sm">
        <thead>
            <tr>
                <th style="width: 8px; background-color: #f2f2f2;">Kode Akun</th>
                <th style="background-color: #f2f2f2;">Keterangan</th>
                <th style="background-color: #f2f2f2;"></th>
                <th style="background-color: #f2f2f2;"></th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPendapatan = 0;
                $totalPengeluaran = 0;
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
                            default:
                                $nilaiPerubahan = 0;
                                break;
                        }
                        
                        // Menghitung saldo berdasarkan nilai perubahan
                        $saldo += $nilaiPerubahan;
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
                <td class="text-right">{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Laba Rugi</strong></td>
                <td></td>
                <td></td>
                <td class="text-right">{{ number_format($totalPendapatan - $totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
