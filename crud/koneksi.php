<?php
session_start(); // INI HARUS ADA DI SINI
$host     = "localhost";
$username = "root"; // Sesuaikan jika Anda memiliki username db yang berbeda
$password = "";     // Kosongkan jika menggunakan XAMPP default
$database = "db_tkj";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>