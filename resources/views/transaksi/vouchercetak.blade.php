<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Atur gaya tampilan untuk cetakan */
        /* Contoh: atur margin dan font size */
        body {
            margin: 20px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;"><b>Detail Transaksi</b></h2>

    <table>
    <tr>
        <th style="text-align: left; width: 30%;">Kode Voucher:</th>
        <td>{{ $transaksi->kode_voucher }}</td>
    </tr>
    <tr>
        <th style="text-align: left;">Tanggal:</th>
        <td>{{ $transaksi->tanggal }}</td>
    </tr>
    <tr>
        <th style="text-align: left;">Deskripsi:</th>
        <td>{{ $transaksi->deskripsi }}</td>
    </tr>
    <tr>
        <th style="text-align: left;">Keterangan Jurnal:</th>
        <td>{{ $transaksi->ket_jurnal }}</td>
    </tr>
</table>

    <table style="margin-top: 30px;">
        <thead>
            <tr>
                <th>Kode Akun</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailTransaksi as $detail)
            <tr>
                <td>{{ $detail->kode_akun3 }} | {{ $detail->akuns3->nama_akun3 }}</td>
                <td>{{ $detail->debit }}</td>
                <td>{{ $detail->kredit }}</td>
                <td>{{ $detail->status->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
