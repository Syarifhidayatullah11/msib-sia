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

table th, table td {
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

<h3><center>Laporan Pencatatan Transaksi</center></h3>

<table class="table table-sm">
    <thead>
        <tr>
            <th style="width: 8px; background-color: #f2f2f2;">No</th>
            <th style="background-color: #f2f2f2;">Tanggal</th>
            <th style="background-color: #f2f2f2;">Kode Voucher</th>
            <th style="background-color: #f2f2f2;">Deskripsi</th>
            <th style="background-color: #f2f2f2;">Kode Akun</th>
            <th style="background-color: #f2f2f2;">Nama Akun</th>
            <th style="background-color: #f2f2f2;">Debet</th>
            <th style="background-color: #f2f2f2;">Kredit</th>
        </tr>
    </thead>
    <tbody>
        @php
            $results = $results->sortBy('Tanggal');
            $nomor = 0;
            $prevTanggal = null;
            $prevVoucher = null;
            $totalDebet = 0;
            $totalKredit = 0;
        @endphp
        @foreach ($results as $index => $result)
            @php
                $nomor++;
                $totalDebet += $result->Debet;
                $totalKredit += $result->Kredit;
            @endphp
            <tr>
                <td>{{ $nomor }}</td>
                <td>{{ $result->Tanggal !== $prevTanggal ? $result->Tanggal : '-' }}</td>
                <td>{{ $result->Kode_Voucher !== $prevVoucher ? $result->Kode_Voucher : '-' }}</td>
                <td>{{ $result->Deskripsi }}</td>
                <td>{{ $result->Kode_Akun }}</td>
                <td>{{ $result->Nama_Akun }}</td>
                <td style="text-align: right;">{{ number_format($result->Debet, 0, ',', '.') }}
                </td>
                <td style="text-align: right;">{{ number_format($result->Kredit, 0, ',', '.') }}
                </td>
            </tr>
            @php
                $prevTanggal = $result->Tanggal;
                $prevVoucher = $result->Kode_Voucher;
            @endphp
        @endforeach
        <tr>
            <td colspan="6" style="text-align: right;"><strong>Total</strong></td>
            <td style="text-align: right;">
                <strong>{{ number_format($totalDebet, 0, ',', '.') }}</strong>
            </td>
            <td style="text-align: right;">
                <strong>{{ number_format($totalKredit, 0, ',', '.') }}</strong>
            </td>
            
        </tr>
    </tbody>
</table>
</body>
