<?php
session_start();

if(isset ($_SESSION['username']) and ($_SESSION['level'])){
    header("Location: home.php");
    exit;
}

include ("config/function.php");

// Variable
if( isset($_POST["login"]) ){

    $username = mysqli_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $password = mysqli_escape_string($conn, $pass);
    $query = mysqli_query($conn,"SELECT * FROM user WHERE username ='$username'");
    $check = mysqli_fetch_array($query);
    if($check){
        if ($password == $check['password']){
            // SESSION
            $_SESSION['nama'] = $check['nama'];
            $_SESSION['username'] = $check['username'];
            $_SESSION['level'] = $check['level'];

            // TAMBAH NAMA ROLE PADA SESSION
            // LEVEL
            if($check ['level'] == "admin"){
                header('Location:home.php');
            }elseif($check ['level'] == "user"){
                header('Location:home.php');
            }elseif($check ['level'] == "accounting"){
                header('Location:home.php');
            }elseif($check ['level'] == "gudang"){
                header('Location:home.php');
        }else{
            echo "<script>alert('Login Gagal, Password Anda Tidak Sesuai, Coba Lagi')
            document.location='login.php'</script>";
        
        }
    }else{
        echo "<script>alert('Login Gagal, Username Anda Tidak Sesuai, Coba Lagi')
        document.location='login.php'</script>";
    }
    
  }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="icon" type="image/x-icon" href="img/favico.png" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Log-in</title>
</head>

<body>
    <section class="">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card bg-light" style="border-radius: 1rem;">
                        <div class="card-body text-center">

                            <div class="mb-md-3 mt-md-2 pb-3">
                                <img src="img/logo1.png" class="rounded" alt="" width="200" height="160">
                                <h2 class="fw-bold mb-3 mt-3 text-uppercase">Login Page</h2>
                                <form action="" method="post">
                                    <div class="form-outline form-white mt-5 mb-4">
                                        <input type="username" name="username" id="username" placeholder="Username"class="form-control form-control-md" />
                                    </div>
                                    <div class="form-outline form-white mt-4 mb-4">
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control form-control-md" />
                                    </div>
                                    <button class="btn btn-dark btn-lg px-5" type="submit" name="login">Login</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <!-- Copyright -->
        <div class="text-center p-3">
            ©2023 Copyright - <i> Alvn</i>
        </div>
        <!-- Copyright -->
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>