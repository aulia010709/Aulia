<?php
$host = "localhost";
$user = "root";      // Di localhost laptop, standarnya adalah 'root'
$pass = "";          // Di localhost laptop, password-nya dikosongkan saja
$db   = "db_tkj";    // Sesuaikan dengan nama database yang kamu buat di phpMyAdmin laptop

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>