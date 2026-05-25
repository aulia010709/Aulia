<?php
// 1. Memulai session dan cek login
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// 2. Hubungkan ke database
include 'koneksi.php';

// Mengambil data dari tabel users
$query = "SELECT * FROM users ORDER BY 1 DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyawiji Sukma - Dance Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            /* Perubahan Warna Latar Belakang: Mengikuti Hitam Pekat Logo Nyawiji Sukma */
            background: linear-gradient(135deg, #111115 0%, #070709 100%);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: #ffffff;
        }

        /* Top Bar / Navigasi Mewah */
        .navbar-top {
            width: 100%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 15px 30px;
            border-radius: 20px;
            border: 1px solid rgba(212, 175, 55, 0.2); /* Sentuhan Garis Emas */
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .main-logo {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #d4af37; /* Bingkai Emas Logo */
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
            background-color: #ffffff;
        }

        .brand-text-area {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            color: #d4af37; /* Text Emas Nyawiji Sukma */
            font-weight: 700;
            font-size: 18px;
            margin: 0;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            color: #8a8a93;
            font-size: 11px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .btn-keluar {
            background: rgba(255, 78, 78, 0.05);
            border: 1px solid rgba(255, 78, 78, 0.25);
            color: #ff6b6b;
            padding: 10px 22px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-keluar:hover {
            background-color: #ff4e4e;
            color: white;
            box-shadow: 0 5px 20px rgba(255, 78, 78, 0.4);
            transform: translateY(-2px);
        }

        /* Card Utama Bergaya Glassmorphism */
        .white-card {
            width: 100%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 28px;
            padding: 45px;
            border: 1px solid rgba(255, 255, 255, 0.03);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.7);
        }

        .card-header-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 25px;
        }

        .title-section h1 {
            color: #ffffff;
            font-size: 26px;
            margin: 0 0 6px 0;
            font-weight: 600;
        }

        .title-section p {
            color: #8a8a93;
            font-size: 13px;
            margin: 0;
        }

        /* Tombol Registrasi Berwarna Emas Logo */
        .btn-add-member {
            background: linear-gradient(135deg, #d4af37 0%, #b38f1d 100%);
            color: #0d0d11;
            padding: 13px 26px;
            border-radius: 14px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
        }

        .btn-add-member:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.5);
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        /* Tabel Gaya Melayang Hitam Eksklusif */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        table th {
            color: #a1a1aa;
            font-weight: 500;
            font-size: 12px;
            padding: 12px 15px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: none;
        }

        table td {
            background: rgba(255, 255, 255, 0.02);
            padding: 18px 15px;
            font-size: 14px;
            color: #e4e4e7;
            border-top: 1px solid rgba(255, 255, 255, 0.01);
            border-bottom: 1px solid rgba(255, 255, 255, 0.01);
            transition: all 0.25s ease;
        }

        table tr td:first-child {
            border-left: 1px solid rgba(255, 255, 255, 0.01);
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
            font-weight: 600;
            color: #d4af37; /* Nomor Urut Emas */
            text-align: center;
        }

        table tr td:last-child {
            border-right: 1px solid rgba(255, 255, 255, 0.01);
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        /* Efek Hover Baris Bersinar Emas */
        table tr:hover td {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            transform: scale(1.002);
            border-color: rgba(212, 175, 55, 0.25);
        }

        .text-nama {
            color: #ffffff;
            font-weight: 600;
            font-size: 15px;
        }

        /* Kapsul Jenis Tari Warna Emas Logo */
        .badge-tari {
            background: rgba(212, 175, 55, 0.08);
            color: #e5c158;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        /* Text Tanggal Lahir */
        .text-tanggal {
            color: #d4af37;
            font-weight: 500;
            font-size: 13px;
        }

        .action-container {
            display: flex;
            gap: 15px;
        }

        .btn-action-edit {
            color: #e5c158; 
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-action-edit:hover {
            color: #ffffff;
            text-shadow: 0 0 8px #e5c158;
        }

        .btn-action-delete {
            color: #ff6b6b; 
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-action-delete:hover {
            color: #ff4e4e;
            text-shadow: 0 0 8px #ff6b6b;
        }
    </style>
</head>
<body>

    <div class="navbar-top">
        <div class="logo-container">
            <img src="logo - Copy.jpg" alt="Logo Nyawiji Sukma" class="main-logo">
            <div class="brand-text-area">
                <h2 class="brand-title">NYAWIJI SUKMA</h2>
                <span class="brand-subtitle">Seni Tari </span>
            </div>
        </div>
        <a href="logout.php" class="btn-keluar" onclick="return confirm('Apakah anda yakin ingin keluar dari sistem?')">Keluar Sistem</a>
    </div>

    <div class="white-card">
        <div class="card-header-area">
            <div class="title-section">
                <h1>Daftar Anggota & Kategori Tari</h1>
                <p>Data administrasi keanggotaan eskul seni tari</p>
            </div>
            <a href="tambah.php" class="btn-add-member">+ Registrasi Anggota</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px; text-align: center;">NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>KELAS</th>
                        <th>TANGGAL LAHIR</th> <th>JENIS TARI</th>
                        <th>GENDER</th>
                        <th>ID PENGGUNA</th>
                        <th>EMAIL</th>
                        <th style="width: 120px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if ($result && mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) : 
                            
                            $val_id = current($row); 
                            $val_nama = isset($row['nama']) ? $row['nama'] : (isset($row['nama_lengkap']) ? $row['nama_lengkap'] : '');
                            $val_kelas = isset($row['kelas']) ? $row['kelas'] : '';
                            
                            // 1. SISTEM DETEKSI OTOMATIS TANGGAL LAHIR
                            $val_tanggal = '';
                            if (isset($row['tanggal_lahir'])) {
                                $val_tanggal = $row['tanggal_lahir'];
                            } elseif (isset($row['tgl_lahir'])) {
                                $val_tanggal = $row['tgl_lahir'];
                            } elseif (isset($row['lahir'])) {
                                $val_tanggal = $row['lahir'];
                            } else {
                                // Jika nama kolom tidak terdeteksi, ambil data dari index kolom ke-3 (opsional)
                                $array_values = array_values($row);
                                $val_tanggal = isset($array_values[2]) ? $array_values[2] : '-';
                            }
                            // Mengubah format tanggal Indonesia (jika datanya berbentuk YYYY-MM-DD)
                            if($val_tanggal != '-' && strtotime($val_tanggal)) {
                                $val_tanggal = date('d-m-Y', strtotime($val_tanggal));
                            }

                            // 2. Deteksi otomatis kolom Jenis Tari
                            $val_tari = isset($row['jenis_tari']) ? $row['jenis_tari'] : (isset($row['tari']) ? $row['tari'] : (isset($row['spesialisasi']) ? $row['spesialisasi'] : ''));
                            if (empty($val_tari)) {
                                $array_values = array_values($row);
                                $val_tari = isset($array_values[4]) ? $array_values[4] : '';
                            }

                            // 3. Deteksi otomatis kolom Gender
                            $val_gender = isset($row['jenis_kelamin']) ? $row['jenis_kelamin'] : (isset($row['jk']) ? $row['jk'] : (isset($row['gender']) ? $row['gender'] : ''));
                            if (empty($val_gender)) {
                                $array_values = array_values($row);
                                $val_gender = isset($array_values[5]) ? $array_values[5] : '';
                            }

                            $val_user = isset($row['username']) ? $row['username'] : '';
                            $val_email = isset($row['email']) ? $row['email'] : '';
                    ?>
                    <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td><span class="text-nama"><?php echo $val_nama; ?></span></td>
                        <td style="text-transform: uppercase; color: #a1a1aa; font-size: 13px;"><?php echo $val_kelas; ?></td>
                        
                        <td><span class="text-tanggal">📅 <?php echo $val_tanggal; ?></span></td>
                        
                        <td><span class="badge-tari">💃 <?php echo $val_tari; ?></span></td>
                        <td><?php echo $val_gender; ?></td>
                        <td style="color: #a1a1aa; font-size: 13px;">@<?php echo $val_user; ?></td>
                        <td style="color: #71717a; font-size: 13px;"><?php echo $val_email; ?></td>
                        <td>
                            <div class="action-container">
                                <a href="edit.php?id=<?php echo $val_id; ?>" class="btn-action-edit">Ubah</a>
                                <a href="hapus.php?id=<?php echo $val_id; ?>" class="btn-action-delete" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<tr><td colspan='9' align='center' style='color:#71717a; padding:40px;'>Belum ada data anggota yang tersimpan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>