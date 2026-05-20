<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);
    
    // Simpan data ke dalam session
    $_SESSION['user_id']  = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role']     = $data['role'];

    header("location:index.php");
} else {
    echo "<script>alert('Username atau Password salah!'); window.location='login.php';</script>";
}
?>