<?php
session_start();

// PENGUNCIAN RINGAN: Mengizinkan kamu menyimpan data dengan aman
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
    
    $role          = 'siswa'; // Otomatis sebagai siswa yang didaftarkan admin

    // Cek duplikasi username agar tidak bentrok
    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>
                alert('Username sudah digunakan! Cari yang lain.');
                window.history.back();
              </script>";
        exit();
    }

    // Memasukkan data baru ke database (Tanggal lahir dimasukkan ke kolom password sesuai strukturmu)
    $query = "INSERT INTO users (username, nama, kelas, jenis_tari, jk, email, password, role) 
              VALUES ('$username', '$nama', '$kelas', '$jenis_tari', '$jk', '$email', '$tanggal_lahir', '$role')";
                  
    $execute = mysqli_query($koneksi, $query);

    if ($execute) {
        echo "<script>
                alert('Anggota baru berhasil ditambahkan!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>