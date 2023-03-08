   <!-- SIDE BAR -->
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <img src="img/solar.png" class="ms-4 mt-2" alt="" height="155" width="160">
                            <hr>
                            <div class="sb-sidenav-menu-heading">Halaman Navigasi</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Home
                            </a>
                            <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'gudang'):?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-archive"></i></div>
                                Barang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="data_barang.php">Data Barang</a>
                                </nav>
                            </div>
                            <?php endif; ?>

                            <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'accounting') :?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#transaksi" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="transaksi" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">Data Pembelian</a>
                                    <a class="nav-link" href="">Data Penjualan</a>
                                </nav>
                            </div>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] == 'admin') :?>
                            <div class="sb-sidenav-menu-heading">Data</div>
                            <a class="nav-link" href="data_akun.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Akun User
                            </a>
                            <?php endif; ?>
                            <hr>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['level']?>
                    </div>
    <!-- ///////////////////// -->