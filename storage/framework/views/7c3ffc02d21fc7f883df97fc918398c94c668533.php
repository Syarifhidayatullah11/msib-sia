

<?php $__env->startSection('title', 'Dashboard - Admin'); ?>


<!-- Header Konten -->
<?php $__env->startSection('content'); ?> 
<center>
  <a class="font-weight-bold">DASHBOARD ADMIN</a>
</center>
<?php $__env->stopSection(); ?>


<!-- KONTEN ADMIN -->
<?php $__env->startSection('isi'); ?>
<!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 
<?php $__env->stopSection(); ?> 


<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\msib-sia\resources\views/dashboard_admin.blade.php ENDPATH**/ ?>