<?php
session_start();

// Hanya mengizinkan akses jika sudah ada session login (yaitu kamu sendiri)
if (!isset($_SESSION['username'])) {
    die("Akses Ditolak! Tombol ini hanya untuk Admin di dalam dashboard.");
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="logotari.jpeg" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyawiji Sukma - Tambah Anggota Baru</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { background-color: #121212; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 40px 0; }
        .card { background-color: #1a1a1a; border: 1px solid #262626; border-radius: 20px; padding: 40px 35px; width: 100%; max-width: 450px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6); text-align: center; }
        h2 { color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: 1.5px; margin-bottom: 5px; text-transform: uppercase; }
        .subtitle { color: #777777; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 25px; }
        form { text-align: left; }
        .form-group { margin-bottom: 15px; }
        label { display: block; color: #aaaaaa; font-size: 13px; margin-bottom: 6px; font-weight: 600; }
        .input-field, select { width: 100%; background-color: #242424; border: 1px solid #333333; border-radius: 10px; padding: 12px 16px; color: #ffffff; font-size: 14px; outline: none; }
        .input-field:focus, select:focus { border-color: #cda22e; }
        .btn-submit { width: 100%; background-color: #cda22e; color: #000000; border: none; border-radius: 10px; padding: 14px; font-size: 14px; font-weight: 700; letter-spacing: 1px; cursor: pointer; margin-top: 15px; text-transform: uppercase; }
        .btn-submit:hover { background-color: #b58d22; }
        .btn-kembali { display: block; text-align: center; color: #aaaaaa; font-size: 13px; margin-top: 15px; text-decoration: none; }
        .btn-kembali:hover { color: #ffffff; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="card">
        <h2>NYAWIJI SUKMA</h2>
        <p class="subtitle">Tambah Anggota Baru</p>

        <form action="proses_tambah.php" method="POST">
            <div class="form-group">
                <label>ID Pengguna (Username)</label>
                <input type="text" name="username" class="input-field" placeholder="Masukkan username unik" required>
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="input-field" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas" required>
                    <option value="">-- Pilih Kelas --</option>
                    <option value="X TJKT 1">X TJKT 1</option>
                    <option value="X TJKT 2">X TJKT 2</option>
                    <option value="X TJKT 3">X TJKT 3</option>
                    <option value="X TJKT 4">XI TJKT 1</option>
                    <option value="XI TJKT 1">XI TJKT 2</option>
                    <option value="XI TJKT 2">XI TJKT 3</option>
                    <option value="XII TJKT 1">XI TJKT 4</option>
                    <option value="X TJKT 4">XII TJKT 1</option>
                    <option value="XI TJKT 1">XII TJKT 2</option>
                    <option value="XI TJKT 2">XII TJKT 3</option>
                </select>
            </div>

            <div class="form-group">
                <label>Spesialisasi Tari</label>
                <select name="jenis_tari" required>
                    <option value="">-- Pilih Jenis Tari --</option>
                    <option value="Tradisional">Tradisional</option>
                    <option value="Kontemporer">Kontemporer</option>
                    <option value="Modern">Modern</option>
                </select>
            </div>

            <div class="form-group">
                <label>Gender (Jenis Kelamin)</label>
                <select name="jk" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="input-field" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="input-field" placeholder="contoh@gmail.com" required>
            </div>

            <button type="submit" class="btn-submit">SIMPAN ANGGOTA</button>
            <a href="index.php" class="btn-kembali">Batal & Kembali</a>
        </form>
    </div>

</body>
</html>