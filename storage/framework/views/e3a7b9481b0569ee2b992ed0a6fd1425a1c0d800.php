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
        <td><?php echo e($transaksi->kode_voucher); ?></td>
    </tr>
    <tr>
        <th style="text-align: left;">Tanggal:</th>
        <td><?php echo e($transaksi->tanggal); ?></td>
    </tr>
    <tr>
        <th style="text-align: left;">Deskripsi:</th>
        <td><?php echo e($transaksi->deskripsi); ?></td>
    </tr>
    <tr>
        <th style="text-align: left;">Keterangan Jurnal:</th>
        <td><?php echo e($transaksi->ket_jurnal); ?></td>
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
            <?php $__currentLoopData = $detailTransaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($detail->kode_akun3); ?> | <?php echo e($detail->akuns3->nama_akun3); ?></td>
                <td><?php echo e($detail->debit); ?></td>
                <td><?php echo e($detail->kredit); ?></td>
                <td><?php echo e($detail->status->status); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\laragon\www\msib-sia\resources\views/transaksi/vouchercetak.blade.php ENDPATH**/ ?>