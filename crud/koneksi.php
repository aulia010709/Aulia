<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "2526_25db"; // Menggunakan nama database asli di komputermu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>