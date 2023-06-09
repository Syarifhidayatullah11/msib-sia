<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <?php if(auth()->check() && auth()->user()->role_id == '1'): ?>
        <li class="nav-item"><a href="<?php echo e(route('dashboard.admin')); ?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                <p class="text-light">Dashboard</p>
            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->check() && auth()->user()->role_id == '2'): ?>
        <li class="nav-item"><a href="<?php echo e(route('dashboard.manajer')); ?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                <p class="text-light">Dashboard</p>
            </a>
        </li>
    <?php endif; ?>
    <!-- Tambahkan blok kondisional untuk setiap level pengguna yang diperlukan -->
</ul>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-money-bill" style="color: white;"></i>
        <p class="text-light">
            Pencatatan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(route('akuns1.index')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Daftar Kategori</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('akuns2.index')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Daftar Golongan Akun</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('akuns3.index')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Daftar Akun</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo e(url('/kliens/index')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Data Klien</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-book-open" style="color: white;"></i>
        <p class="text-light">
            Transaksi
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(route('transaksi.index')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Jurnal Pencatatan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('jurnalmemorial.index')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Jurnal Memorial</p>
            </a>
        <li class="nav-item">
            <a href="<?php echo e(url('/penutups/index')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Jurnal Penutup</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="<?php echo e(route('bukubesar.index')); ?>" class="nav-link">
        <i class="nav-icon fas fa-book-open" style="color: white;"></i>
        <p class="text-light">
            Buku Besar
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?php echo e(route('neracasaldo.index')); ?>" class="nav-link">
        <i class="nav-icon fas fa-file-alt" style="color: white;"></i>
        <p class="text-light">
            Neraca Saldo
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-bookmark" style="color: white;"></i>
        <p class="text-light">
            Laporan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Posisi Keuangan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Laba Rugi</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Perubahan Modal</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-light">Arus Kas</p>
            </a>
        </li>
    </ul>





    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="<?php echo e(url('logout')); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt" style="color: white;"></i>
                <p class="text-light">Logout</p>
            </a>
        </li>
    </ul>
<?php /**PATH C:\laragon\www\msib-sia\resources\views/menu.blade.php ENDPATH**/ ?>