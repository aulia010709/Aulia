<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    // Password otomatis disamakan dengan username, bisa diganti sesuai keinginan
    $password = password_hash($username, PASSWORD_DEFAULT); 
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $jenis_tari = mysqli_real_escape_string($koneksi, $_POST['jenis_tari']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);

    // Urutan Query INSERT disamakan persis dengan urutan struktur phpMyAdmin kamu
    $query = "INSERT INTO users (id, username, password, email, nama, kelas, tgl_lahir, jenis_tari, jenis_kelamin) 
              VALUES ('', '$username', '$password', '$email', '$nama', '$kelas', '$tgl_lahir', '$jenis_tari', '$jenis_kelamin')";
    
    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        echo "<script>
                alert('Data Anggota Nyawiji Sukma Berhasil Disimpan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Anggota - Nyawiji Sukma</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #111115 0%, #070709 100%);
            margin: 0; padding: 40px 20px;
            display: flex; flex-direction: column; align-items: center; min-height: 100vh; color: #ffffff;
        }
        .form-card {
            width: 100%; max-width: 650px; background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(25px); -webkit-backdrop-filter: blur(25px);
            border-radius: 28px; padding: 45px; border: 1px solid rgba(255, 255, 255, 0.03);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.7);
        }
        .form-header { display: flex; align-items: center; gap: 15px; margin-bottom: 35px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); padding-bottom: 20px; }
        .mini-logo { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #d4af37; background-color: #ffffff; }
        .form-header h1 { font-size: 22px; color: #ffffff; margin: 0; font-weight: 600; }
        .form-header p { font-size: 11px; color: #8a8a93; margin: 3px 0 0 0; text-transform: uppercase; letter-spacing: 1.5px; }
        .input-group { margin-bottom: 22px; }
        .input-group label { display: block; font-size: 12px; color: #a1a1aa; margin-bottom: 8px; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; }
        .input-group input, .input-group select {
            width: 100%; padding: 14px 16px; background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; color: #ffffff; font-size: 14px; outline: none; transition: all 0.3s ease;
        }
        .input-group input:focus, .input-group select:focus { border-color: #d4af37; background: rgba(255, 255, 255, 0.06); box-shadow: 0 0 12px rgba(212, 175, 55, 0.2); }
        .input-group select option { background-color: #141419; color: #ffffff; }
        .action-row { display: flex; gap: 15px; margin-top: 35px; }
        .btn-submit { flex: 2; background: linear-gradient(135deg, #d4af37 0%, #b38f1d 100%); color: #0d0d11; padding: 14px; border: none; border-radius: 14px; font-size: 14px; font-weight: 700; cursor: pointer; box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3); transition: all 0.3s ease; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 25px rgba(212, 175, 55, 0.45); }
        .btn-cancel { flex: 1; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); color: #a1a1aa; padding: 14px; border-radius: 14px; text-align: center; text-decoration: none; font-size: 14px; font-weight: 500; }
        .btn-cancel:hover { background: rgba(255, 255, 255, 0.08); color: #ffffff; }
    </style>
</head>
<body>
    <div class="form-card">
        <div class="form-header">
            <img src="logo - Copy.jpg" alt="Logo" class="mini-logo">
            <div>
                <h1>Tambah Anggota Baru</h1>
                <p>Nyawiji Sukma </p>
            </div>
        </div>

        <form action="" method="POST">
            <div class="input-group">
                <label>Nama Lengkap </label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap..." required>
            </div>
            <div class="input-group">
                <label>Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: XI-TJKT-1" required>
            </div>
            <div class="input-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" required>
            </div>
            <div class="input-group">
                <label>Jenis Tari</label>
                <select name="jenis_tari" required>
                    <option value="" disabled selected>-- Pilih Kategori Tari --</option>
                    <option value="Tradisional">Tradisional</option>
                    <option value="Modern Dance">Modern Dance</option>
                    <option value="Kontemporer">Kontemporer</option>
                </select>
            </div>
            <div class="input-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-laki">Laki-laki</option>
                </select>
            </div>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Buat nama pengguna..." required>
            </div>
            <div class="input-group">
                <label>Alamat Email</label>
                <input type="email" name="email" placeholder="contoh@domain.com" required>
            </div>
            <div class="action-row">
                <a href="index.php" class="btn-cancel">Batal</a>
                <button type="submit" name="submit" class="btn-submit">Simpan Anggota</button>
            </div>
        </form>
    </div>
</body>
</html>