<!-- index.blade.php -->


<?php $__env->startSection('isi'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Daftar Golongan Akun</b></h3>
                    </div>

                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <a href="<?php echo e(route('akuns2.create')); ?>" class="btn btn-primary">Tambah Data</a>
                        </div>

                        <form action="<?php echo e(route('akuns2.index')); ?>" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari data..." name="search"
                                    value="<?php echo e(request()->get('search')); ?>">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>

                        <table class="table table-striped border" style="margin-top: 30px;">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Golongan Akun</th>
                                    <th scope="col">Nama Golongan Akun</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($result->kode_akun2); ?></td>
                                        <td><?php echo e($result->nama_akun2); ?></td>
                                        <td><?php echo e($result->nama_akun1); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('akuns2.edit', $result->kode_akun2)); ?>"
                                                class="btn btn-primary">Edit</a>
                                            <form action="<?php echo e(route('akuns2.destroy', $result->kode_akun2)); ?>" method="POST"
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
                        <?php echo e($results->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/akuns2/index.blade.php ENDPATH**/ ?>