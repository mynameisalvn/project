<?php 

include "config/function.php";

// Mengambil id 
$id_akun = (int)$_GET['id'];

if(delete_akun($id_akun) > 0){
    echo "<script>
        alert('User Berhasil Dihapus')
        document.location.href = 'data_akun.php'
        </script>";
}else{
    echo "<script>
        alert('User Gagal Dihapus')
        document.location.href = 'data_akun.php'
        </script>";
}


?>
