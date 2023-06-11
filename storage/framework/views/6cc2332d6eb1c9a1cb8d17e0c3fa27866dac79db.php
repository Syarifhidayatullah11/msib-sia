<?php $__env->startSection('isi'); ?>
    <div class="container">
        <h1>Neraca Saldo</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Akun</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $totalDebit = 0;
                    $totalKredit = 0;
                ?>

                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $saldo = $row->saldo;
                        
                        // Menentukan apakah saldo termasuk dalam kolom debit atau kredit berdasarkan nilai saldo
                        if ($saldo >= 0) {
                            $debit = $saldo;
                            $kredit = 0;
                        } else {
                            $debit = 0;
                            $kredit = abs($saldo);
                        }
                        
                        $totalDebit += $debit;
                        $totalKredit += $kredit;
                    ?>

                    <tr>
                        <td><?php echo e($row->nama_akun3); ?></td>
                        <td><?php echo e(number_format($debit, 0, ',', '.')); ?></td>
                        <td><?php echo e(number_format($kredit, 0, ',', '.')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><strong>Total</strong></td>
                    <td><?php echo e(number_format($totalDebit, 0, ',', '.')); ?></td>
                    <td><?php echo e(number_format($totalKredit, 0, ',', '.')); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/neracasaldo/index.blade.php ENDPATH**/ ?>