<?php $__env->startSection('isi'); ?>
    <div class="container">
        <h1>Buku Besar</h1>

        <?php $__currentLoopData = $groupedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kodeAkun => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $saldoAwal = $rows[0]->saldo_awal;
            ?>

            <?php if($saldoAwal !== null): ?>
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #C3C6FF;">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title">Kode Akun: <?php echo e($kodeAkun); ?></h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h3 class="card-title" style="text-align: 150px;">Nama Akun:
                                    <h6 style="text-align: end;"> <?php echo e($rows[0]->nama_akun3); ?></h6>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-left">Tanggal</th>
                                <th class="text-left">Keterangan</th>
                                <th class="text-right">Debit</th>
                                <th class="text-right">Kredit</th>
                                <th class="text-right">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $saldo = $saldoAwal;
                                $totalSaldo = $saldoAwal;
                            ?>

                            <tr>
                                <td class="text-left"><?php echo e($rows[0]->tanggal); ?></td>
                                <td class="text-left"><strong>Saldo Awal:</strong></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><?php echo e(number_format($saldoAwal, 0, ',', '.')); ?></td>
                            </tr>

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
                                    <td class="text-left"><?php echo e($row->deskripsi); ?></td>
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
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/bukubesar/index.blade.php ENDPATH**/ ?>