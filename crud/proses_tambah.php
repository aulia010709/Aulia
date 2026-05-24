<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas        = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
    $gender       = mysqli_real_escape_string($koneksi, $_POST['gender']);
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email        = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Nama tabel aktif berdasarkan temuan error sebelumnya: 'users'
    $nama_tabel = "users";

    // Membaca seluruh struktur kolom database asli kamu secara real-time
    $cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM `$nama_tabel`");
    if (!$cek_kolom) {
        die("Gagal membaca struktur tabel! Error: " . mysqli_error($koneksi));
    }

    $list_kolom = [];
    while ($row_kolom = mysqli_fetch_assoc($cek_kolom)) {
        $list_kolom[] = $row_kolom['Field'];
    }

    // Pemetaan variabel kolom default
    $kolom_id       = isset($list_kolom[0]) ? $list_kolom[0] : 'id';
    $kolom_nama     = isset($list_kolom[1]) ? $list_kolom[1] : 'nama';
    $kolom_kelas    = isset($list_kolom[2]) ? $list_kolom[2] : 'kelas';
    $kolom_tari     = isset($list_kolom[3]) ? $list_kolom[3] : 'jenis_tari';
    $kolom_gender   = isset($list_kolom[4]) ? $list_kolom[4] : 'gender';
    $kolom_user     = isset($list_kolom[5]) ? $list_kolom[5] : 'username';
    $kolom_email    = isset($list_kolom[6]) ? $list_kolom[6] : 'email';

    // Mencocokkan nama kolom jika ada variasi nama di phpMyAdmin kamu
    foreach ($list_kolom as $k) {
        $k_lower = strtolower($k);
        if ($k_lower == 'nama' || $k_lower == 'nama_lengkap') $kolom_nama = $k;
        if ($k_lower == 'kelas') $kolom_kelas = $k;
        if ($k_lower == 'spesialisasi' || $k_lower == 'jenis_tari' || $k_lower == 'tari' || $k_lower == 'kategori') $kolom_tari = $k;
        if ($k_lower == 'gender' || $k_lower == 'jenis_kelamin' || $k_lower == 'jk') $kolom_gender = $k;
        if ($k_lower == 'username' || $k_lower == 'id_pengguna' || $k_lower == 'user_id') $kolom_user = $k;
        if ($k_lower == 'email') $kolom_email = $k;
    }

    // Memasukkan data ke dalam kolom yang sudah terverifikasi ada di phpMyAdmin
    $query = "INSERT INTO `$nama_tabel` 
              (`$kolom_id`, `$kolom_nama`, `$kolom_kelas`, `$kolom_tari`, `$kolom_gender`, `$kolom_user`, `$kolom_email`) 
              VALUES 
              (NULL, '$nama', '$kelas', '$spesialisasi', '$gender', '$username', '$email')";
    
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>
                alert('Selamat Aulia! Data member eskul berhasil disimpan ke tabel $nama_tabel! ✨🌸');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        die("Gagal menyimpan data! <br> <b>Pesan Error:</b> " . mysqli_error($koneksi));
    }
} else {
    header("Location: tambah.php");
    exit;
}
?>