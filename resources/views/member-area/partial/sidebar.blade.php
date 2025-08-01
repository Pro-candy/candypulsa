
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="{{ url('/member-area/dashboard') }}" class="brand-link">
            <img
                src="{{ asset('member-assets/assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">Candy Pulsa</span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                <a href="{{ url('/member-area') }}" class="nav-link">
                    <i class="nav-icon bi bi-houses"></i>
                    <p>Home</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>
                        Manajemen Produk
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="{{ url('member-area/produk/supplier') }}" class="nav-link {{ request()->is('member-area/produk/supplier') ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i>
                                <p>Supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('member-area/produk/kategori') }}" class="nav-link">
                                <i class="bi bi-tags-fill"></i>
                                <p>Kategori Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('member-area/produk') }}" class="nav-link">
                                <i class="bi bi-bag-fill"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ url('member-area/produk/pembelian') }}" class="nav-link">
                                <i class="bi bi-cart-plus-fill"></i>
                                <p>Pembelian Produk</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-cart-check"></i>
                    <p>
                    Penjualan
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="{{ url('/kasir') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Kasir</p></a></li>
                    <li class="nav-item"><a href="{{ url('/transaksi/batal') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Pembatalan Transaksi</p></a></li>
                    <li class="nav-item"><a href="{{ url('/transaksi/retur') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Pengembalian Barang</p></a></li>
                </ul>
                </li>

                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-bar-chart-line-fill"></i>
                    <p>
                    Laporan Keuangan
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="{{ url('/laporan/penjualan') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Laporan Penjualan</p></a></li>
                    <li class="nav-item"><a href="{{ url('/laporan/keuangan') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Laporan Keuangan</p></a></li>
                    <li class="nav-item"><a href="{{ url('/laporan/stok') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Laporan Stock</p></a></li>
                </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Pelanggan
                             <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="{{ route('reseller.pelanggan') }}" class="nav-link"><i class="bi bi-people-fill"></i> <p>List Pelanggan</p></a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-tambah-pelanggan">
                                <i class="bi bi-person-add"></i><p>Tambah Pelanggan</p>
                            </a>
                        </li>
                    </ul>   
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-gear-fill"></i>
                    <p>
                    Setting
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="{{ url('/setting/aplikasi') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Aplikasi</p></a></li>
                    <li class="nav-item"><a href="{{ url('/setting/profil') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Profile</p></a></li>
                    <li class="nav-item"><a href="{{ url('/setting/pembayaran') }}" class="nav-link"><i class="bi bi-circle"></i> <p>Pembayaran</p></a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a href="{{ route('reseller.logout') }}" class="nav-link">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <p>Logout</p>
                </a>
                </li>
            </ul>
            </nav>
        </div>
        </aside>