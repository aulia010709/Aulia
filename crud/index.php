<?php
// 1. Memulai session dan cek login
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// 2. Hubungkan ke file koneksi database
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
    <title>Sistem Informasi Seni Tari</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e2e1ec;
            margin: 0;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .navbar-top {
            width: 100%;
            max-width: 1050px;
            background-color: #ffffff;
            padding: 18px 30px;
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            margin-bottom: 25px;
            z-index: 10;
            position: relative;
        }

        .brand-title {
            color: #5d4275; 
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .btn-keluar {
            border: 1px solid #cccaf0;
            background: transparent;
            color: #7d7a96;
            padding: 8px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-keluar:hover {
            background-color: #fceeed;
            color: #d9534f;
            border-color: #f5c6cb;
        }

        .white-card {
            width: 100%;
            max-width: 1050px;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(93, 66, 117, 0.04);
            box-sizing: border-box;
            z-index: 10;
            position: relative;
        }

        .card-header-area {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .title-section h1 {
            color: #5d4275;
            font-size: 24px;
            margin: 0 0 6px 0;
            font-weight: 700;
            border-left: 4px solid #7d52a8;
            padding-left: 15px;
        }

        .title-section p {
            color: #aaa7be;
            font-size: 12px;
            margin: 0;
            padding-left: 15px;
        }

        .btn-add-member {
            background-color: #7d52a8;
            color: white;
            padding: 12px 22px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(125, 82, 168, 0.2);
            transition: all 0.3s ease;
        }

        .btn-add-member:hover {
            background-color: #643f8a;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            border: 1px solid #e3def2; 
        }

        table th {
            color: #7d52a8;
            background-color: #fcfbfe; 
            font-weight: 600;
            font-size: 13px;
            padding: 15px 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e3def2;
            border-right: 1px solid #e3def2;
        }

        table td {
            padding: 15px 12px;
            font-size: 14px;
            color: #4e4a66;
            border-bottom: 1px solid #e3def2;
            border-right: 1px solid #e3def2;
        }

        table th:last-child, table td:last-child {
            border-right: none;
        }

        table tr:hover td {
            background-color: #faf9fe;
        }

        .text-tari {
            color: #e35283; 
            font-weight: 500;
        }

        .action-container {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-action-edit, .btn-action-delete {
            color: #e35283; 
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-action-edit:hover, .btn-action-delete:hover {
            color: #b0365f; 
            text-decoration: underline;
        }

        /* Dekorasi kelopak bunga sakura pelengkap */
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
            opacity: 0.6;
            animation: drift linear infinite;
            user-select: none;
        }

        @keyframes drift {
            0% { transform: translateY(-20px) rotate(0deg); opacity: 0.7; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body>

    <div class="sakura-ambience" id="sakuraContainer"></div>

    <div class="navbar-top">
        <h2 class="brand-title">💃 ESKUL SENI TARI 🌸</h2>
        <a href="logout.php" class="btn-keluar" onclick="return confirm('Apakah anda yakin ingin keluar sistem?')">Keluar Sistem</a>
    </div>

    <div class="white-card">
        <div class="card-header-area">
            <div class="title-section">
                <h1>Daftar Anggota & Kategori eskul Tari</h1>
                <p>Manajemen data biodata eskul seni tari</p>
            </div>
            <a href="tambah.php" class="btn-add-member">+ Tambah Anggota</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>KELAS</th>
                        <th>JENIS TARI</th> <th>GENDER</th>
                        <th>ID PENGGUNA</th>
                        <th>EMAIL</th>
                        <th style="text-align: center; width: 140px;">AKSI MANAJEMEN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if ($result && mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) : 
                            
                            // Ambil ID otomatis dari kolom index pertama
                            $val_id = current($row); 

                            // 1. Ambil data nama lengkap
                            $val_nama = isset($row['nama']) ? $row['nama'] : (isset($row['nama_lengkap']) ? $row['nama_lengkap'] : '');
                            
                            // 2. Ambil data kelas
                            $val_kelas = isset($row['kelas']) ? $row['kelas'] : '';
                            
                            // 3. KUNCI MEMUNCULKAN JENIS TARI: Deteksi nama kolom alternatif di phpMyAdmin
                            $val_tari = '';
                            if (isset($row['jenis_tari'])) {
                                $val_tari = $row['jenis_tari'];
                            } elseif (isset($row['tari'])) {
                                $val_tari = $row['tari'];
                            } elseif (isset($row['spesialisasi'])) {
                                $val_tari = $row['spesialisasi'];
                            } elseif (isset($row['kategori'])) {
                                $val_tari = $row['kategori'];
                            } else {
                                // Jika tidak cocok, ambil nilai kolom urutan ke-4
                                $array_values = array_values($row);
                                $val_tari = isset($array_values[3]) ? $array_values[3] : '';
                            }

                            // 4. KUNCI MEMUNCULKAN GENDER: Deteksi nama kolom alternatif di phpMyAdmin
                            $val_gender = '';
                            if (isset($row['jenis_kelamin'])) {
                                $val_gender = $row['jenis_kelamin'];
                            } elseif (isset($row['jk'])) {
                                $val_gender = $row['jk'];
                            } elseif (isset($row['gender'])) {
                                $val_gender = $row['gender'];
                            } else {
                                // Jika tidak cocok, ambil nilai kolom urutan ke-5
                                $array_values = array_values($row);
                                $val_gender = isset($array_values[4]) ? $array_values[4] : '';
                            }

                            // 5. Ambil data username & email
                            $val_user = isset($row['username']) ? $row['username'] : '';
                            $val_email = isset($row['email']) ? $row['email'] : '';
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><b><?php echo $val_nama; ?></b></td>
                        <td><?php echo $val_kelas; ?></td>
                        <td><span class="text-tari"><?php echo $val_tari; ?></span></td> <td><?php echo $val_gender; ?></td> <td><?php echo $val_user; ?></td>
                        <td><span style="color:#7d7a96; font-size:13px;"><?php echo $val_email; ?></span></td>
                        <td align="center">
                            <div class="action-container">
                                <a href="edit.php?id=<?php echo $val_id; ?>" class="btn-action-edit">Ubah</a>
                                <a href="hapus.php?id=<?php echo $val_id; ?>" class="btn-action-delete" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<tr><td colspan='8' align='center' style='color:#999; padding:30px;'>Belum ada data anggota.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const container = document.getElementById('sakuraContainer');
        for (let i = 0; i < 20; i++) {
            const petal = document.createElement('div');
            petal.classList.add('petal');
            petal.innerText = '🌸';
            petal.style.left = Math.random() * 100 + 'vw';
            petal.style.animationDuration = Math.random() * 4 + 4 + 's';
            petal.style.animationDelay = Math.random() * 5 + 's';
            container.appendChild(petal);
        }
    </script>
</body>
</html>