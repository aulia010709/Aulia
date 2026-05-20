<?php
include 'koneksi.php';

// Kunci Pintu: Hanya Admin
if ($_SESSION['role'] != 'admin') die("Akses Ditolak!");

if (isset($_POST['simpan'])) {
    $username      = $_POST['username'];
    $password      = md5($_POST['password']);
    $nama          = $_POST['nama'];
    $alamat        = $_POST['alamat'];
    $tempat_lahir  = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // 1. Simpan ke tabel users
    mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'guru')");
    $user_id_baru = mysqli_insert_id($koneksi); // Mengambil ID dari akun yang barusan dibuat

    // 2. Simpan ke tabel biodata_guru menggunakan ID tersebut
    mysqli_query($koneksi, "INSERT INTO biodata_guru (user_id, nama, alamat, tempat_lahir, tanggal_lahir) VALUES ('$user_id_baru', '$nama', '$alamat', '$tempat_lahir', '$tanggal_lahir')");

    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Tambah Data Guru (Admin)</h2>
    <form method="POST" action="">
        <h4>Akun Login</h4>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <h4>Biodata Lengkap</h4>
        Nama: <input type="text" name="nama" required><br>
        Alamat: <textarea name="alamat" required></textarea><br>
        Tempat Lahir: <input type="text" name="tempat_lahir" required><br>
        Tanggal Lahir: <input type="date" name="tanggal_lahir" required><br><br>
        <button type="submit" name="simpan">Simpan Data</button>
    </form>
</body>
</html>