

<?php $__env->startSection('isi'); ?>
    <div class="container">
        <h2>Edit Transaksi</h2>
        <form id="edit-form" action="<?php echo e(route('transaksi.update', $transaksi->id_transaksi)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="kode_voucher">Kode Voucher:</label>
                <input type="text" name="kode_voucher" class="form-control" value="<?php echo e($transaksi->kode_voucher); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo e($transaksi->tanggal); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required><?php echo e($transaksi->deskripsi); ?></textarea>
            </div>
            <div class="form-group">
                <label for="ket_jurnal">Keterangan Jurnal:</label>
                <textarea name="ket_jurnal" class="form-control" required><?php echo e($transaksi->ket_jurnal); ?></textarea>
            </div>
            <table class="table table-bordered">
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
                    <?php $__currentLoopData = $detailTransaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <select name="kode_akun3[]" class="form-control" required>
                                    <option value="">Pilih Akun</option>
                                    <?php $__currentLoopData = $akuns3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($akun3->kode_akun3); ?>"
                                            <?php echo e($akun3->kode_akun3 == $detail->kode_akun3 ? 'selected' : ''); ?>>
                                            <?php echo e($akun3->kode_akun3); ?> | <?php echo e($akun3->nama_akun3); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>

                            <td>
                                <input type="number" name="debit[]" class="form-control" value="<?php echo e($detail->debit); ?>"
                                    required>
                            </td>
                            <td>
                                <input type="number" name="kredit[]" class="form-control" value="<?php echo e($detail->kredit); ?>"
                                    required>
                            </td>
                            <td>
                                <select name="status_id[]" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status->id_status); ?>"
                                            <?php echo e($status->id_status == $detail->status_id ? 'selected' : ''); ?>>
                                            <?php echo e($status->status); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <?php if($index === 0): ?>
                                    <button type="button" class="btn btn-primary add-row">Tambah Baris</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-danger remove-row">Hapus</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $("table").on("click", ".add-row", function() {
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
                                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status->id_status); ?>"><?php echo e($status->status); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                `;
                $("table tbody").append(markup);
            });

            $("table").on("click", ".remove-row", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>

    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>

    <script>
        // When the form is submitted
        document.getElementById('edit-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Simpan Perubahan?',
                text: 'Apakah Anda yakin ingin menyimpan perubahan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, submit the form
                    document.getElementById('edit-form').submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/transaksi/edit.blade.php ENDPATH**/ ?>