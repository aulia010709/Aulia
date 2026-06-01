<?php
// Sesuaikan isi di dalam tanda kurung dengan data servermu
$koneksi = mysqli_connect("localhost", "username_kamu", "password_kamu", "nama_database_kamu");

// TAMBAHKAN KODE INI DI BAWAHNYA:
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke database: " . mysqli_connect_error();
    exit();
}
?>