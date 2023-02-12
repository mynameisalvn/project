<?php 
session_start();
include("config/function.php");
// CHECK SESSION
if(empty($_SESSION['username']) or empty($_SESSION['level'])){
    echo "<script>alert('Anda Harus Login Terlebih Dahulu!')
            document.location='login.php'</script>";
}

// JIKA BUKAN ADMIN MAKA TIDAK BISA AKSES URL
if(($_SESSION['level'] != 'admin')){
    echo "<script>alert('Anda tidak memiliki akses')
            document.location='login.php'</script>";
}
//

// TAMPILKAN DATA
$data_akun = mysqli_query($conn,"SELECT * FROM user ORDER BY id");
                    
// TOMBOL TAMBAH DI JALANKAN
if(isset($_POST['tambah'])) {
    if(create_akun($_POST) > 0){
        echo "<script>
            alert('User Baru Berhasil Ditambahkan!')
            document.location.href = 'data_akun.php'
            </script>";
    }else{
        echo "<script>
            alert('User Baru Gagal Ditambahkan!')
            document.location.href = 'data_akun.php'
            </script>";
    }

}

// TOMBOL EDIT DI JALANKAN PADA TAMPILAN MODAL
if(isset($_POST['edit'])) {
    if(update_akun($_POST) > 0){
        echo "<script>
            alert('User Berhasil Diupdate!')
            document.location.href = 'data_akun.php'
            </script>";
    }else{
        echo "<script>
            alert('User Gagal Diupdate!')
            document.location.href = 'data_akun.php'
            </script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>System Inventory</title>
        <link rel="icon" type="image/x-icon" href="img/favico.png" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">WiSiYu Souvenir</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <p class="d-none d-md-inline-block form-inline ms-auto me-0 my-2 my-md-0 text-white">
            <?php echo $_SESSION['username']?>
            </p>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- SIDE NAV -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <img src="img/logo1.png" alt="rounded-circle" class="text-center" height="160" width="200">
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
                </nav>
            </div>
                              
            <!-- ISI KONTENT -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data User</h1>
                        <hr>
                        <div class="card mb-4">
                            <div class="card-body">
                            <table class="table table-bordered table-striped mt-3">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambah"><i class="fas fa-plus"></i> Create User </button>
                                <thead>
                                    <tr>
                                        <th scope='col' class="text-center">No</th>
                                        <th scope='col'>Username</th>
                                        <th scope='col'>Nama Pengguna</th>
                                        <th scope='col'>Password</th>
                                        <th scope='col'>Level</th>
                                        <th scope='col' class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =1; ?>
                                    <?php foreach ($data_akun as $akun) : ?>
                                            <tr>
                                            <td scope="row" class="text-center"><?= $no++; ?></td>
                                            <td scope="row"><?= $akun['username']; ?></td>
                                            <td scope="row"><?= $akun['nama']; ?></td>
                                            <td scope="row">Password (Ter-enkripsi)</td>
                                            <td scope="row"><?= $akun['level']; ?></td>
                                            <td scope="row" class="text-center">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#ModalEdit<?= $akun['id']; ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                                                data-bs-target="#ModalHapus<?= $akun['id']; ?>">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- Modal Tambah -->
                        <div class="modal fade" id="ModalTambah" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-secondary text-white">
                                    <h5 class="modal-title">Add User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Nama Pengguna</label>
                                            <input type="text" name="nama" id="nama" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                                        </div>
                                        <!-- DAPAT TAMBAH LEVEL -->
                                        <div class="mb-3">
                                            <label for="level">Level</label>
                                            <select name="level" id="level" class="form-control" required>
                                                <option value="">-- Pilih Level --</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                                <option value="accounting">Accounting</option>
                                                <option value="gudang">Gudang</option>
                                            </select>
                                        </div>  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <?php foreach ($data_akun as $akun) : ?>
                        <div class="modal fade" id="ModalEdit<?= $akun['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?= $akun['id']; ?>">
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Nama Pengguna</label>
                                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password <small>(Inputkan Password Baru/Lama)</small></label>
                                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                                        </div>
                                        <div class="mb-3">
                                            <label for="level">Level</label>
                                            <select name="level" id="level" class="form-control" required>
                                                <?php $level = $akun['level'];?>
                                                <option value="admin"<?= $level == 'admin' ? 'selected' : null ?>>Admin</option>
                                                <option value="user" <?= $level == 'user' ? 'selected' : null ?>>User</option>
                                                <option value="accounting"<?= $level == 'accounting' ? 'selected' : null ?>>Accounting</option>
                                                <option value="gudang" <?= $level == 'gudang' ? 'selected' : null ?>>Gudang</option>
                                            </select>
                                        </div>  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" name="edit" class="btn btn-success">Edit</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <!-- Modal Hapus -->
                        <?php foreach ($data_akun as $akun) : ?>
                        <div class="modal fade" id="ModalHapus<?= $akun['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p> Apakah Anda Yakin Ingin Menghapus User <b><?= $akun['username'];?></b> ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <a href="hapus_akun.php?id=<?= $akun['id'];?>" class="btn btn-danger">Hapus</a>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </main>
                <!-- FOOTER -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Alvn ,2023</div>
                        </div>
                    </div>
                </footer>
                <!-- AKHIR -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>


