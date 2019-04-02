<aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            <i class="fa fa-home"></i> CV. Putra Adidarma
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>

                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    @role('admin')
                                    <li class="nav">
                                        <a href="/">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ Request::is('customers') ? 'active' : ''}}">
                                        <a href="/admin/customers">
                                            <i class="fa fa-users"></i>
                                            <span>Customer</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('suppliers') ? 'active' : ''}}">
                                        <a href="/admin/suppliers">
                                            <i class="fa fa-group"></i>
                                            <span>Supplier</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ Request::is('/admin/barangs') ? 'active' : ''}}">
                                        <a href="/admin/barangs">
                                            <i class="fa fa-dropbox"></i>
                                            <span>Barang</span>
                                        </a>
                                    </li>

                                     <li class="nav-item {{ Request::is('/admin/barang_masuks') ? 'active' : ''}}">
                                        <a href="/admin/barang_masuks">
                                            <i class="fa fa-dropbox"></i>
                                            <span>Barang Masuk</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ Request::is('/admin/barang_keluars') ? 'active' : ''}}">
                                        <a href="/admin/barang_keluars">
                                            <i class="fa fa-dropbox"></i>
                                            <span>Barang Keluar</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('/admin/akumulasi') ? 'active' : ''}}">
                                        <a href="/admin/akumulasi">
                                            <i class="fa fa-book"></i>
                                            <span>Laporan Pemasukan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('/admin/laporan_pengeluaran') ? 'active' : ''}}">
                                        <a href="/admin/laporan_pengeluaran">
                                            <i class="fa fa-book"></i>
                                            <span>Laporan Pengeluaran</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('/admin/users') ? 'active' : ''}}">
                                        <a href="/admin/users">
                                            <i class="fa fa-user"></i>
                                            <span>User</span>
                                        </a>
                                    </li>
                                    @endrole
                                    @role('karyawan')
                                    <li class="nav">
                                        <a href="/">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                     <li class="nav-item {{ Request::is('/karyawan/barang_masuks') ? 'active' : ''}}">
                                        <a href="/karyawan/barang_masuks">
                                            <i class="fa fa-dropbox"></i>
                                            <span>Barang Masuk</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ Request::is('/karyawan/barang_keluars') ? 'active' : ''}}">
                                        <a href="/karyawan/barang_keluars">
                                            <i class="fa fa-dropbox"></i>
                                            <span>Barang Keluar</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('/karyawan/akumulasi') ? 'active' : ''}}">
                                        <a href="/karyawan/akumulasi">
                                            <i class="fa fa-book"></i>
                                            <span>Laporan Pemasukan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('/karyawan/laporan_pengeluaran') ? 'active' : ''}}">
                                        <a href="/karyawan/laporan_pengeluaran">
                                            <i class="fa fa-book"></i>
                                            <span>Laporan Pengeluaran</span>
                                        </a>
                                    </li>
                                    @endrole

                                </ul>
                            </nav>


                        </div>

                    </div>

                </aside>
