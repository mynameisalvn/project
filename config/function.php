<?php
// Koneksi Database
$conn = mysqli_connect('localhost','root','','system_inventory');



// Fungsi Menambahkan Akun
function create_akun($post){
    global $conn;

    $username = mysqli_real_escape_string($conn,$post['username']);
    $nama = mysqli_real_escape_string($conn,$post['nama']);
    $pass = md5($post['password']);
    $level = strip_tags($post['level']);

    // QUERY TAMBAH AKUN
    $query = "INSERT INTO user VALUES(null, '$username','$nama', '$pass','$level')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
// Fungsi Mengupdate Akun
function update_akun($post){
    global $conn;

    $id = mysqli_real_escape_string($conn,$post['id']);
    $username = mysqli_real_escape_string($conn,$post['username']);
    $nama = mysqli_real_escape_string($conn,$post['nama']);
    $pass = md5($post['password']);
    $level = strip_tags($post['level']);

    // QUERY EDIT AKUN
    $query = "UPDATE user SET username ='$username',nama ='$nama',password ='$pass',level ='$level' WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

// Fungsi Menghapus Akun
function delete_akun($id_akun){
    global $conn;

    // QUERY DELETE AKUN
    $query = "DELETE FROM user WHERE id = $id_akun";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}


?>