<?php
$host = "localhost";
$user = "2526_25";
$pass = "12345678";
$db   = "2526_25db"; // Menggunakan nama database asli di komputermu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>