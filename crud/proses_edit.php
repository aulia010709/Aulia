<?php
session_start();

// PENGUNCIAN LOOSE: Selama ada session username (kamu sudah login), langsung loloskan!
if (!isset($_SESSION['username'])) {
    die("Akses Ditolak! Silakan login terlebih dahulu.");
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username      = mysqli_real_escape_string($koneksi, $_POST['username']);
    $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas         = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $jenis_tari    = mysqli_real_escape_string($koneksi, $_POST['jenis_tari']);
    $jk            = mysqli_real_escape_string($koneksi, $_POST['jk']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $email         = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Mengupdate data siswa, dan menyimpan tanggal lahir ke dalam kolom password
    $query = "UPDATE users SET 
                nama = '$nama', 
                kelas = '$kelas', 
                jenis_tari = '$jenis_tari', 
                jk = '$jk', 
                password = '$tanggal_lahir', 
                email = '$email' 
              WHERE username = '$username'";

    $execute = mysqli_query($koneksi, $query);

    if ($execute) {
        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>