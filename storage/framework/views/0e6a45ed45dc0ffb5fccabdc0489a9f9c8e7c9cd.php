

<?php $__env->startSection('isi'); ?>
    <div class="container">
        <h1>Buku Besar</h1>

        <?php $__currentLoopData = $groupedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kodeAkun => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title">Kode Akun: <?php echo e($kodeAkun); ?></h3>
                        </div>
                        <div class="col-sm-6 text-right">
                            <h3 class="card-title" style="text-align: 150px;">Nama Akun:
                                <h6 style="text-align: end;"> <?php echo e($rows[0]->nama_akun3); ?></h6>
                            </h3>
                            </h3>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode Voucher</th>
                            <th class="text-center">Debit</th>
                            <th class="text-center">Kredit</th>
                            <th class="text-center">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $saldo = 0;
                            $totalSaldo = 0;
                        ?>

                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $debit = $row->debit;
                                $kredit = $row->kredit;
                                
                                // Menentukan jenis akun berdasarkan nama akun
                                switch ($row->nama_akun1) {
                                    case 'Aktiva':
                                        // Akun Aktiva
                                        $nilaiPerubahan = $debit - $kredit;
                                        break;
                                    case 'Pasiva':
                                        // Akun Pasiva
                                        $nilaiPerubahan = $kredit - $debit;
                                        break;
                                    case 'Pendapatan':
                                        // Akun Pendapatan
                                        $nilaiPerubahan = $kredit - $debit;
                                        break;
                                    case 'Pengeluaran':
                                        // Akun Pengeluaran
                                        $nilaiPerubahan = $debit - $kredit;
                                        break;
                                    default:
                                        $nilaiPerubahan = 0;
                                        break;
                                }
                                
                                // Menghitung saldo berdasarkan nilai perubahan
                                $saldo += $nilaiPerubahan;
                                $totalSaldo += $nilaiPerubahan;
                            ?>

                            <tr>
                                <td class="text-left"><?php echo e($row->tanggal); ?></td>
                                <td class="text-left"><?php echo e($row->kode_voucher); ?></td>
                                <td class="text-right"><?php echo e(number_format($row->debit, 0, ',', '.')); ?></td>
                                <td class="text-right"><?php echo e(number_format($row->kredit, 0, ',', '.')); ?></td>
                                <td class="text-right"><?php echo e(number_format($saldo, 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Saldo:</strong></td>
                            <td class="text-right"><?php echo e(number_format($totalSaldo, 0, ',', '.')); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/bukubesar/index.blade.php ENDPATH**/ ?>