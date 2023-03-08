<?php 
session_start();
include("config/function.php");
// MEMBUAT USER LOGIN TERLEBIH DAHULU
if(empty($_SESSION['username']) or empty($_SESSION['level'])){
    echo "<script>alert('Anda Harus Login Terlebih Dahulu!')
            document.location='login.php'</script>";
}




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
                        <h1 class="mt-4 mb-4">Selamat Datang, <?php echo $_SESSION['nama']?></h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> --> 
                        
                    </div>
                </main>
                <!-- FOOTER-->
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
    </body>
</html>