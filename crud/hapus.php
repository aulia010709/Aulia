<?php
session_start();

// Cek apakah yang menghapus data benar-handal admin 'aulia'
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'aulia') {
    echo "<script>
            alert('Akses Ditolak! Anda harus login sebagai admin.');
            window.location.href = 'index.php';
          </script>";
    exit();
}

include 'koneksi.php';

// Menangkap data id atau username dari link index.php
$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';
if (empty($id)) {
    $id = isset($_GET['username']) ? mysqli_real_escape_string($koneksi, $_GET['username']) : '';
}

if (!empty($id)) {
    // Jalankan perintah hapus data
    $query = "DELETE FROM users WHERE username = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data Anggota Berhasil Dihapus!');
                window.location.href = 'index.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menghapus data dari database!');
                window.location.href = 'index.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ID Data tidak valid atau kosong!');
            window.location.href = 'index.php';
          </script>";
    exit();
}
?>