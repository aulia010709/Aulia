<?php
$host = "localhost";
$user = "root";          // Di laptop/XAMPP selalu pakai root
$pass = "";              // Di laptop/XAMPP password-nya dikosongkan
$db   = "2526_25db";     // Nama database sesuai di phpMyAdmin laptopmu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>