<?php 
session_start();
include("config/function.php");
// CHECK SESSION
if(empty($_SESSION['username']) or empty($_SESSION['level'])){
    echo "<script>alert('Anda Harus Login Terlebih Dahulu!')
            document.location='login.php'</script>";
            exit;
}

// MEMBATASI AKSES HALAMAN URL
if($_SESSION['level'] != "admin" && $_SESSION['level'] != "gudang"){
    echo "<script>alert('Anda Tidak Mempunyai Akses!')
            document.location='home.php'</script>";
            exit;
}
// TAMPILKAN DATA
// $data_barang = mysqli_query($conn,"SELECT * FROM user ORDER BY id");
                    
// TOMBOL TAMBAH DI JALANKAN
// if(isset($_POST['tambah'])) {
//     if(create_akun($_POST) > 0){
//         echo "<script>
//             alert('User Baru Berhasil Ditambahkan!')
//             document.location.href = 'data_akun.php'
//             </script>";
//     }else{
//         echo "<script>
//             alert('User Baru Gagal Ditambahkan!')
//             document.location.href = 'data_akun.php'
//             </script>";
//     }

// }

// // TOMBOL EDIT DI JALANKAN PADA TAMPILAN MODAL
// if(isset($_POST['edit'])) {
//     if(update_akun($_POST) > 0){
//         echo "<script>
//             alert('User Berhasil Diupdate!')
//             document.location.href = 'data_akun.php'
//             </script>";
//     }else{
//         echo "<script>
//             alert('User Gagal Diupdate!')
//             document.location.href = 'data_akun.php'
//             </script>";
//     }

// }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'layouts/header.php'?>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <?php include 'layouts/navbar.php'?>
        </nav>

        <!-- SIDE NAV -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <?php include 'layouts/sidebar.php'?>
                </nav>
            </div>
                              
            <!-- ISI KONTENT -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Barang</h1>
                        <hr>
                        <div class="card mb-4">
                            <div class="card-body">
                            <table class="table table-bordered table-striped mt-3" id="table">
                                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#ModalTambah"><i class="fas fa-plus"></i> Tambah Barang </button>
                                <thead>
                                    <tr>
                                        <th scope='col' class="text-center">No</th>
                                        <th scope='col'>id_barang</th>
                                        <th scope='col'>Nama Barang</th>
                                        <th scope='col'>Stock</th>
                                        <th scope='col'>Harga</th>
                                        <th scope='col' class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =1; ?>
                                    <!-- <?php foreach ($data_barang as $barang) : ?> -->
                                            <tr>
                                            <td scope="row" class="text-center"></td>
                                            <td scope="row"></td>
                                            <td scope="row"></td>
                                            <td scope="row"></td>
                                            <td scope="row"></td>
                                            <td scope="row" class="text-center">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#ModalEdit<?= $barang['id']; ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                                                data-bs-target="#ModalHapus<?= $barang['id']; ?>">Delete</button>
                                            </td>
                                        </tr>
                                    <!-- <?php endforeach; ?> -->
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- Modal Tambah -->
                        <div class="modal fade" id="ModalTambah" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-secondary text-white">
                                    <h5 class="modal-title">Tambah Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label for="username">Nama Barang</label>
                                            <input type="text" name="username" id="username" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Stock</label>
                                            <input type="text" name="stock" id="stock" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Harga</label>
                                            <input type="text" name="harga" id="harga" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" name="tambah" class="btn btn-primary">Tambah Barang</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <!-- <?php foreach ($data_barang as $barang) : ?> -->
                        <div class="modal fade" id="ModalEdit<?= $barang['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?= $barang['id']; ?>">
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" value="<?= $barang['username']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Nama Pengguna</label>
                                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $barang['nama']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password <small>(Inputkan Password Baru/Lama)</small></label>
                                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                                        </div>
                                        <div class="mb-3">
                                            <label for="level">Level</label>
                                            <select name="level" id="level" class="form-control" required>
                                                <?php $level = $barang['level'];?>
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
                        <!-- <?php endforeach; ?> -->

                        <!-- Modal Hapus -->
                        <!-- <?php foreach ($data_barang as $barang) : ?> -->
                        <div class="modal fade" id="ModalHapus<?= $barang['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p> Apakah Anda Yakin Ingin Menghapus User <b><?= $barang['username'];?></b> ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <a href="hapus_akun.php?id=<?= $barang['id'];?>" class="btn btn-danger">Hapus</a>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- <?php endforeach; ?> -->
                    </div>
                </main>
                <!-- FOOTER -->
                <footer class="py-4 bg-light mt-auto">
                    <?php include 'layouts/footer.php'?>
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
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
        <!-- SCRIPT TABLE JQUERY -->
        <script>
            $(document).ready( function () {
                $('#table').DataTable();
            } );
        </script>
    </body>
</html>


