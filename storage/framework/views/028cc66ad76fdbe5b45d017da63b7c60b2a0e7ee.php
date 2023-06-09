

<?php $__env->startSection('isi'); ?>
    <!-- resources/views/akuns1/index.blade.php -->
    <h1><b>Daftar Kategori</b></h1>

    <a href="<?php echo e(route('akuns1.create')); ?>" class="btn btn-primary">Tambah Kategori</a>

    <table class="table table-bordered border-5" style="margin-top: 30px;">
        <thead>
            <tr style="background-color: #C3F2FF;" class=" text-center">
                <th width="150px" >Kode Kategori</th>
                <th width="1000px">Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $akuns1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($akun1->kode_akun1); ?></td>
                    <td><?php echo e($akun1->nama_akun1); ?></td>
                    <td>
                        <a href="<?php echo e(route('akuns1.edit', $akun1->kode_akun1)); ?>" class="btn btn-warning">Edit</a>
                        <form action="<?php echo e(route('akuns1.destroy', $akun1->kode_akun1)); ?>" method="POST"
                            style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="show-alert-delete-box btn btn-danger" data-toggle="tooltip">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/akuns1/index.blade.php ENDPATH**/ ?>