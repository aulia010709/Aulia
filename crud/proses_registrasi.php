<?php
// Hubungkan ke file database
include 'koneksi.php';

if (
    isset($_POST['nama']) && 
    isset($_POST['kelas']) && 
    isset($_POST['spesialisasi']) && 
    isset($_POST['gender']) && 
    isset($_POST['username']) && 
    isset($_POST['email']) && 
    isset($_POST['password'])
) {
    
    $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas         = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $spesialisasi  = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
    $gender        = mysqli_real_escape_string($koneksi, $_POST['gender']);
    $username      = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email         = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password      = mysqli_real_escape_string($koneksi, $_POST['password']);
    $role          = 'user'; // Pendaftar baru otomatis diset sebagai biasa ('user')

    // Catatan: Jika nama tabel di databasemu bukan 'tb_anggota', silakan ganti tulisan 'tb_anggota' di bawah ini sesuai nama tabelmu ya!
    $query = "INSERT INTO tb_anggota (nama, kelas, spesialisasi, gender, username, email, password, role) 
              VALUES ('$nama', '$kelas', '$spesialisasi', '$gender', '$username', '$email', '$password', '$role')";
              
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Akun Berhasil Dibuat! Silakan login.');
                window.location.href = 'login.php';
              </script>";
        exit;
    } else {
        die("Gagal mendaftarkan akun baru: " . mysqli_error($koneksi));
    }
} else {
    header("Location: registrasi.php");
    exit;
}
?>