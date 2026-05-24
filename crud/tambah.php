<?php
// 1. Memulai session dan cek login
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anggota</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e2e1ec; /* Warna latar belakang ungu abu-abu */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 120vh; /* Ditambah tingginya agar halaman bisa digeser/di-scroll ke bawah */
            position: relative;
            overflow-y: auto; /* Memastikan scrollbar aktif jika layar laptop kecil */
        }

        /* Kotak Putih Form Pendaftaran */
        .container {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(93, 66, 117, 0.05);
            z-index: 10;
            position: relative;
            
            /* KUNCI UTAMA: Menggeser dan memberi jarak kotak agar turun ke bawah */
            margin-top: 70px; 
            margin-bottom: 70px;
        }

        h2 {
            text-align: center;
            color: #5d4275;
            font-size: 22px;
            margin-bottom: 5px;
        }

        p.subtitle {
            text-align: center;
            color: #aaa7be;
            font-size: 13px;
            margin: 0 0 30px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4e4a66;
            font-size: 14px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cccaf0;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 14px;
            color: #4e4a66;
            background-color: #fcfbfe;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #7d52a8;
            background-color: #ffffff;
        }

        /* Tombol Simpan Berwarna Ungu */
        .btn-submit {
            background-color: #7d52a8;
            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(125, 82, 168, 0.2);
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #643f8a;
        }

        .btn-kembali {
            display: block;
            text-align: center;
            text-decoration: none;
            color: #7d7a96;
            font-size: 13px;
            margin-top: 15px;
        }

        .btn-kembali:hover {
            text-decoration: underline;
        }

        /* Efek Bunga Sakura */
        .sakura-ambience {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }

        .petal {
            position: absolute;
            font-size: 20px;
            opacity: 0.5;
            animation: drift linear infinite;
        }

        @keyframes drift {
            0% { transform: translateY(-20px) rotate(0deg); opacity: 0.6; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body>

    <div class="sakura-ambience" id="sakuraContainer"></div>

    <div class="container">
        <h2>🌸 Tambah Data Anggota 🌸</h2>
        <p class="subtitle">Masukkan data baru anggota eskul seni tari</p>
        
        <form action="proses_tambah.php" method="POST">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    <option value="X TJKT 3">X TJKT 3</option>
                    <option value="X TJKT 4">X TJKT 4</option>
                    <option value="XI TJKT 4">XI TJKT 4</option>
                </select>
            </div>

            <div class="form-group">
                <label>Spesialisasi Tari</label>
                <select name="spesialisasi" class="form-control" required>
                    <option value="Tradisional">Tradisional</option>
                    <option value="Modern">Modern</option>
                    <option value="Kontemporer">Kontemporer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-laki">Laki-laki</option>
                </select>
            </div>

            <div class="form-group">
                <label>ID Pengguna (Username)</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required placeholder="contoh@gmail.com">
            </div>

            <button type="submit" class="btn-submit">Simpan Data Member</button>
            <a href="index.php" class="btn-kembali">Batal & Kembali</a>
        </form>
    </div>

    <script>
        const container = document.getElementById('sakuraContainer');
        for (let i = 0; i < 15; i++) {
            const petal = document.createElement('div');
            petal.classList.add('petal');
            petal.innerText = '🌸';
            petal.style.left = Math.random() * 100 + 'vw';
            petal.style.animationDuration = Math.random() * 4 + 5 + 's';
            petal.style.animationDelay = Math.random() * 4 + 's';
            container.appendChild(petal);
        }
    </script>
</body>
</html>