<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @if (auth()->check() && auth()->user()->role_id == '1')
        <!-- Admin -->
        <li class="nav-item">
            <a href="{{ route('dashboard.admin') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                <p class="text-light">Dashboard</p>
            </a>
        </li>
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
                    <a href="{{ route('akuns1.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Daftar Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('akuns2.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Daftar Golongan Akun</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('akuns3.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Daftar Akun</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kliens.index') }}" class="nav-link">
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
                    <a href="{{ route('transaksi.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Jurnal Pencatatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jurnalmemorial.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Jurnal Memorial</p>
                    </a>
                <li class="nav-item">
                    <a href="{{ url('/penutups/index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Jurnal Penutup</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('bukubesar.index') }}" class="nav-link">
                <i class="nav-icon fas fa-book-open" style="color: white;"></i>
                <p class="text-light">
                    Buku Besar
                </p>
            </a>
        </li>
    @endif

    @if (auth()->check() && auth()->user()->role_id == '2')
        <!-- Manajer -->
        <li class="nav-item">
            <a href="{{ route('dashboard.manajer') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                <p class="text-light">Dashboard</p>
            </a>
        </li>

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
                    <a href="{{ route('akuns1.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Daftar Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('akuns2.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Daftar Golongan Akun</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('akuns3.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Daftar Akun</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kliens.index') }}" class="nav-link">
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
                    <a href="{{ route('transaksi.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Jurnal Pencatatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jurnalmemorial.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Jurnal Memorial</p>
                    </a>
                <li class="nav-item">
                    <a href="{{ url('/penutups/index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Jurnal Penutup</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('bukubesar.index') }}" class="nav-link">
                <i class="nav-icon fas fa-book-open" style="color: white;"></i>
                <p class="text-light">
                    Buku Besar
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('neracasaldo.index') }}" class="nav-link">
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
                    <a href="{{ route('labarugi.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Laba Rugi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('perubahanmodal.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Perubahan Modal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posisikeuangan.index') }}"class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Posisi Keuangan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('aruskas.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="text-light">Arus Kas</p>
                    </a>
                </li>
            </ul>
    @endif

    <li class="nav-item">
        <a href="{{ url('logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt" style="color: white;"></i>
            <p class="text-light">Logout</p>
        </a>
    </li>
</ul>
