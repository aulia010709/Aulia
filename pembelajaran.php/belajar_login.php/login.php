<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: berhasil_login.php");
    exit();
} else if ( isset($_POST['submit'])) {
    $username_benar="aulia";
    $password_benar= hash('sha256',"aulia123");
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    if (($username == $username_benar) && ($password == $password_benar)) {
        $_SESSION['username'] = $username;
        header("Location: berhasil_login.php");
        exit();
    } else {
        echo "<script>alert('Username atau password Anda salah. Silakan coba lagi!')</script>";
        echo "<script>window.location.replace('index.php')</script>";
        exit();
    }
} else {
    echo "<script>alert('Login dulu bos!')</script>";
    echo "<script>window.location.replace('index.php')</script>";
    exit();
}
?>