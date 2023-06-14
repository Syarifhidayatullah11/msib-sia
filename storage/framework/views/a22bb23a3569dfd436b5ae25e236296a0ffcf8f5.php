<?php $__env->startSection('isi'); ?>
    <div class="container">
        <h2>List Transaksi</h2>
        <a href="<?php echo e(route('transaksi.create')); ?>" class="btn btn-primary">Tambah Transaksi</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: #C3C6FF;">
                    <th>No.</th>
                    <th>Kode Voucher</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Keterangan Jurnal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($item->kode_voucher); ?></td>
                        <td><?php echo e($item->tanggal); ?></td>
                        <td><?php echo e($item->deskripsi); ?></td>
                        <td><?php echo e($item->ket_jurnal); ?></td>
                        <td>
                            <a href="<?php echo e(route('transaksi.show', $item->id_transaksi)); ?>" class="btn btn-primary">Detail</a>
                            <a href="<?php echo e(route('transaksi.edit', $item->id_transaksi)); ?>" class="btn btn-success">Edit</a>
                            <form action="<?php echo e(route('transaksi.destroy', $item->id_transaksi)); ?>" method="POST"
                                style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="show-alert-delete-box btn btn-danger"
                                    data-toggle="tooltip">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo e($transaksi->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/transaksi/index.blade.php ENDPATH**/ ?>