<?php $__env->startSection('isi'); ?>
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6">
                <h2 style="margin-top: 10px;">Detail Transaksi</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo e(route('transaksi.vouchercetak', ['id' => $transaksi->id_transaksi])); ?>" class="btn btn-primary"
                    target="_blank" style="margin-top: 10px;">Cetak Transaksi</a>
            </div>
        </div>
        <div class="row" style="margin-bottom: 5px;">
            <!-- Rest of the content for the detail transaction -->
        </div>
    </div>
    <table class="table">
        <tr>
            <th>Kode Voucher:</th>
            <td><?php echo e($transaksi->kode_voucher); ?></td>
        </tr>
        <tr>
            <th>Tanggal:</th>
            <td><?php echo e($transaksi->tanggal); ?></td>
        </tr>
        <tr>
            <th>Deskripsi:</th>
            <td><?php echo e($transaksi->deskripsi); ?></td>
        </tr>
        <tr>
            <th>Keterangan Jurnal:</th>
            <td><?php echo e($transaksi->ket_jurnal); ?></td>
        </tr>
    </table>
    <table class="table">
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
    <a href="<?php echo e(route('transaksi.index')); ?>" class="btn btn-primary">Kembali</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/transaksi/show.blade.php ENDPATH**/ ?>