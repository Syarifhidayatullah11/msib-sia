

<?php $__env->startSection('isi'); ?>
    <div class="container">
        <h2>Tambah Transaksi</h2>
        <form action="<?php echo e(route('transaksi.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="kode_voucher">Kode Voucher:</label>
                <input type="text" name="kode_voucher" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="ket_jurnal">Keterangan Jurnal:</label>
                <textarea name="ket_jurnal" class="form-control" required></textarea>
            </div>
            <table class="table table-bordered" id="detail-table">
                <thead>
                    <tr>
                        <th>Kode Akun</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="kode_akun3[]" class="form-control" required>
                                <option value="">Pilih Akun</option>
                                <?php $__currentLoopData = $akuns3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($akun3->kode_akun3); ?>"><?php echo e($akun3->kode_akun3); ?> |
                                        <?php echo e($akun3->nama_akun3); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="debit[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="kredit[]" class="form-control" required>
                        </td>
                        <td>
                            <select name="status_id[]" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($statusku->id_status); ?>"><?php echo e($statusku->status); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary add-row">Tambah Baris</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add-row").click(function() {
                var markup = `
                    <tr>
                        <td>
                            <select name="kode_akun3[]" class="form-control" required>
                                <option value="">Pilih Akun</option>
                                <?php $__currentLoopData = $akuns3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($akun3->kode_akun3); ?>"><?php echo e($akun3->kode_akun3); ?>  |  <?php echo e($akun3->nama_akun3); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="debit[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="kredit[]" class="form-control" required>
                        </td>
                        <td>
                            <select name="status_id[]" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($statusku->id_status); ?>"><?php echo e($statusku->status); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                `;
                $("#detail-table tbody").append(markup);
            });

            $("#detail-table").on("click", ".remove-row", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/transaksi/create.blade.php ENDPATH**/ ?>