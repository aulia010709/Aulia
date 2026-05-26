<?php
session_start();

// 1. PROTEKSI UTAMA: Cek apakah user sudah login sebagai admin 'aulia'
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'aulia') {
    echo "<script>
            alert('Akses Ditolak! Anda harus login sebagai admin.');
            window.location.href = 'index.php';
          </script>";
    exit();
}

include 'koneksi.php';

// Menangkap data id/username yang dikirim dari index.php
$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';
if (empty($id)) {
    $id = isset($_GET['username']) ? mysqli_real_escape_string($koneksi, $_GET['username']) : '';
}

// Ambil data siswa yang mau diedit
$query = "SELECT * FROM users WHERE username = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = 'index.php';
          </script>";
    exit();
}

// Proses update data ketika tombol simpan diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama        = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas       = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $jenis_tari  = mysqli_real_escape_string($koneksi, $_POST['jenis_tari']);
    $jk          = mysqli_real_escape_string($koneksi, $_POST['jk']);
    $tgl_lahir   = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']); // Disimpan ke kolom password
    $email       = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Query update data tanpa kolom alamat supaya tidak bentrok dengan database kamu
    $update_query = "UPDATE users SET nama='$nama', kelas='$kelas', jenis_tari='$jenis_tari', jk='$jk', password='$tgl_lahir', email='$email' WHERE username='$id'";
    
    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>
                alert('Data Berhasil Diubah!');
                window.location.href = 'index.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Gagal mengubah data! Periksa kembali database Anda.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="logotari.jpeg" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyawiji Sukma - Ubah Data</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        
        /* Membuat form otomatis berada di rata tengah layar */
        body { 
            background-color: #121212; 
            color: #ffffff; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        /* Ukuran form kotak diperkecil menjadi lebih compact/ramping */
        .form-container { 
            background-color: #1a1a1a; 
            border: 1px solid #2a2a2a; 
            padding: 25px 30px; 
            border-radius: 15px; 
            width: 100%;
            max-width: 420px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }
        
        h2 { 
            color: #cda22e; 
            font-size: 20px;
            margin-bottom: 20px; 
            border-left: 4px solid #cda22e; 
            padding-left: 10px; 
            letter-spacing: 0.5px;
        }
        
        .form-group { 
            margin-bottom: 14px; 
        }
        
        label { 
            display: block; 
            margin-bottom: 6px; 
            color: #aaaaaa; 
            font-size: 13px;
        }
        
        input[type="text"], 
        input[type="email"], 
        input[type="date"], 
        select { 
            width: 100%; 
            padding: 10px 12px; 
            background-color: #222222; 
            border: 1px solid #333333; 
            color: #ffffff; 
            border-radius: 6px; 
            font-size: 14px;
        }
        
        input:focus, select:focus {
            border-color: #cda22e;
            outline: none;
        }
        
        /* Mengunci input username agar tidak bisa diubah */
        input:disabled {
            background-color: #151515;
            color: #666666;
            border-color: #222222;
            cursor: not-allowed;
        }
        
        .btn-submit { 
            background-color: #cda22e; 
            color: #000000; 
            border: none; 
            width: 100%;
            padding: 12px; 
            font-weight: bold; 
            font-size: 14px;
            border-radius: 6px; 
            cursor: pointer; 
            margin-top: 10px;
            transition: 0.2s;
        }
        
        .btn-submit:hover {
            background-color: #b38d24;
        }
        
        .btn-back { 
            display: block; 
            text-align: center;
            margin-top: 15px; 
            color: #888888; 
            text-decoration: none; 
            font-size: 13px; 
        }
        .btn-back:hover {
            color: #cda22e;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Ubah Data Anggota</h2>
    <form method="POST" action="">
        
        <div class="form-group">
            <label>ID Pengguna (Username)</label>
            <input type="text" value="<?php echo htmlspecialchars($data['username']); ?>" disabled>
        </div>
        
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Spesialisasi Tari</label>
            <input type="text" name="jenis_tari" value="<?php echo htmlspecialchars($data['jenis_tari']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Gender</label>
            <select name="jk" required>
                <option value="Perempuan" <?php if($data['jk'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                <option value="Laki-laki" <?php if($data['jk'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" value="<?php echo htmlspecialchars($data['password']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
        </div>
        
        <button type="submit" class="btn-submit">Simpan Perubahan</button>
        <a href="index.php" class="btn-back">← Kembali ke Tabel</a>
    </form>
</div>

</body>
</html>