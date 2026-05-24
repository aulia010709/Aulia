<?php
// 1. Jalankan session di baris paling pertama
session_start();

// 2. Hubungkan dengan database
include 'koneksi.php';

// 3. Keamanan: Cek apakah user sudah login dan benar seorang admin
// Menggunakan isset() agar tidak memicu error "Undefined array key" jika session kosong
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Akses Ditolak! Anda harus login sebagai admin.");
}

// 4. Proses Hapus Data jika ID tersedia di URL
if (isset($_GET['id'])) {
    // Ambil id dari URL dan amankan dari input berbahaya
    $id_target = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Hapus data dari tabel biodata_guru terlebih dahulu
    mysqli_query($koneksi, "DELETE FROM biodata_guru WHERE user_id = '$id_target'");

    // Hapus data dari tabel users
    mysqli_query($koneksi, "DELETE FROM users WHERE id = '$id_target'");

    // Alihkan halaman kembali ke index.php setelah berhasil menghapus
    header("Location: index.php");
    exit;
} else {
    // Jika tidak ada ID yang dikirim di URL, kembalikan ke index.php
    header("Location: index.php");
    exit;
}
?>