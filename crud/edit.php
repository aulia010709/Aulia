<?php
// 1. Memulai session
session_start();

// 2. Menghubungkan ke database
include 'koneksi.php';

// Cek apakah ada ID yang dikirim di URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

$id = $_GET['id'];

// =============================================================
// KUNCI UTAMA: DETEKTOR OTOMATIS NAMA TABEL NYATA DI DATABASEMU
// =============================================================
$nama_tabel = "";
$ambil_tabel = mysqli_query($koneksi, "SHOW TABLES");

if ($ambil_tabel) {
    while ($baris_tabel = mysqli_fetch_row($ambil_tabel)) {
        $tabel_dicoba = $baris_tabel[0];
        
        // Cek apakah tabel ini menyimpan data ID yang kita cari (id atau id_anggota)
        $tes_query = @mysqli_query($koneksi, "SELECT * FROM `$tabel_dicoba` WHERE `id` = '$id' OR `id_anggota` = '$id'");
        if ($tes_query && mysqli_num_rows($tes_query) > 0) {
            $nama_tabel = $tabel_dicoba;
            $result = $tes_query;
            break; 
        }
    }
}

// Jika detektor otomatis di atas masih gagal menemukan datamu
if (empty($nama_tabel) || !$result) {
    $ambil_tabel_darurat = mysqli_query($koneksi, "SHOW TABLES");
    if ($ambil_tabel_darurat && mysqli_num_rows($ambil_tabel_darurat) > 0) {
        $baris_darurat = mysqli_fetch_row($ambil_tabel_darurat);
        $nama_tabel = $baris_darurat[0]; 
        $result = mysqli_query($koneksi, "SELECT * FROM `$nama_tabel` WHERE 1 LIMIT 1");
    } else {
        die("Gagal total: Tidak ada tabel sama sekali di dalam database '2526_25db' kamu. Silakan import file db_tkj.sql dulu di phpMyAdmin!");
    }
}

$data = mysqli_fetch_array($result);

// Menentukan nama kolom ID yang aktif
$kolom_id = isset($data['id']) ? 'id' : (isset($data['id_anggota']) ? 'id_anggota' : '');
if (empty($kolom_id) && $data) {
    $kunci_kolom = array_keys($data);
    $kolom_id = $kunci_kolom[1]; 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data - Eskul Seni Tari</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f2f8; /* Latar belakang ungu sangat pudar halus */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            position: relative;
            overflow-x: hidden; /* Mencegah scroll horizontal akibat bunga */
        }

        /* Container Utama Box Putih Elegan */
        .edit-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(106, 76, 147, 0.08); /* Bayangan ungu tipis estetik */
            width: 100%;
            max-width: 440px;
            margin: 30px 20px;
            z-index: 10; /* Berada di atas bunga berterbangan */
            position: relative;
            border: 1px solid rgba(224, 220, 237, 0.6);
        }

        .edit-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .edit-header h2 {
            margin: 0 0 6px 0;
            color: #6a4c93; 
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .edit-header p {
            font-size: 12px;
            color: #a09cb0;
            margin: 0;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a4355;
            font-size: 13px;
            font-weight: 600;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2def0;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #faf9fd;
            color: #333;
            transition: all 0.3s ease;
        }

        .form-group input:focus, 
        .form-group select:focus {
            border-color: #6a4c93;
            outline: none;
            box-shadow: 0 0 0 4px rgba(106, 76, 147, 0.12);
            background-color: #ffffff;
        }

        /* Tombol Utama */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: #6a4c93; 
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 12px;
            box-shadow: 0 4px 12px rgba(106, 76, 147, 0.2);
        }

        .btn-submit:hover {
            background-color: #543a75;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(106, 76, 147, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-kembali {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #8e8796;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }

        .btn-kembali:hover {
            color: #6a4c93;
            text-decoration: underline;
        }

        /* ====================================
           EFEK KELOPAK BUNGA BERTERBANGAN
           ==================================== */
        .falling-flowers {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }

        .flower {
            position: absolute;
            background-color: transparent;
            font-size: 20px;
            opacity: 0.7;
            user-select: none;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-20px) translateX(0) rotate(0deg);
                opacity: 0.8;
            }
            50% {
                transform: translateY(50vh) translateX(80px) rotate(180deg);
                opacity: 0.5;
            }
            100% {
                transform: translateY(100vh) translateX(-20px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

    <div class="falling-flowers" id="fallingFlowers"></div>

    <div class="edit-container">
        <div class="edit-header">
            <h2>📝 Ubah Data Anggota</h2>
            <p>Membaca otomatis dari tabel: <b><?php echo $nama_tabel; ?></b></p>
        </div>

        <form action="proses_edit.php" method="POST">
            
            <input type="hidden" name="id" value="<?php echo isset($data[$kolom_id]) ? $data[$kolom_id] : $id; ?>">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" value="<?php echo isset($data['kelas']) ? $data['kelas'] : ''; ?>" placeholder="Contoh: XI TJKT 1" required>
            </div>

            <div class="form-group">
                <label>Spesialisasi Tari</label>
                <select name="spesialisasi" required>
                    <option value="Tradisional" <?php echo (isset($data['spesialisasi']) && $data['spesialisasi'] == 'Tradisional') ? 'selected' : ''; ?>>Tradisional</option>
                    <option value="Modern" <?php echo (isset($data['spesialisasi']) && $data['spesialisasi'] == 'Modern') ? 'selected' : ''; ?>>Modern</option>
                    <option value="Kontemporer" <?php echo (isset($data['spesialisasi']) && $data['spesialisasi'] == 'Kontemporer') ? 'selected' : ''; ?>>Kontemporer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="Laki-laki" <?php echo (isset($data['gender']) && $data['gender'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo (isset($data['gender']) && $data['gender'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>ID Pengguna (Username)</label>
                <input type="text" name="username" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="nama@email.com" required>
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
            <a href="index.php" class="btn-kembali">← Batal dan Kembali</a>
        </form>
    </div>

    <script>
        const container = document.getElementById('fallingFlowers');
        const numberOfFlowers = 30; // Jumlah kelopak bunga di layar

        for (let i = 0; i < numberOfFlowers; i++) {
            const flower = document.createElement('div');
            flower.classList.add('flower');
            flower.innerText = '🌸';
            
            // Mengacak posisi sebaran kiri-kanan bunga
            flower.style.left = Math.random() * 100 + 'vw';
            
            // Mengacak kecepatan jatuh bunga agar terlihat alami (antara 4 sampai 8 detik)
            flower.style.animationDuration = Math.random() * 4 + 4 + 's'; 
            
            // Mengacak waktu tunggu kemunculan awal bunga
            flower.style.animationDelay = Math.random() * 6 + 's';
            
            container.appendChild(flower);
        }
    </script>

</body>
</html>