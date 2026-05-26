<?php
session_start();

// 1. PROTEKSI UTAMA: Cek apakah user sudah login atau belum?
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Mengambil data session user yang sedang aktif login
$username_sekarang = $_SESSION['username'];
$role_sekarang     = isset($_SESSION['role']) ? $_SESSION['role'] : 'siswa';

// Ambil semua data pengguna (Kecuali akun admin 'aulia') untuk ditampilkan di tabel
$query = "SELECT * FROM users WHERE username != 'aulia'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
     <link rel="icon" href="logotari.jpeg" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyawiji Sukma - Dashboard Utama</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { background-color: #121212; color: #ffffff; padding: 30px 40px; }
        
        /* HEADER NAVBAR */
        .navbar { background-color: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 12px; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
        .brand { display: flex; align-items: center; gap: 10px; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.2; }
        .brand-title { font-size: 18px; font-weight: bold; letter-spacing: 1.5px; color: #cda22e; text-transform: uppercase; }
        .brand-subtitle { color: #777777; font-size: 10px; letter-spacing: 0.5px; text-transform: lowercase; font-weight: normal; }
        
        .welcome-text { color: #aaaaaa; font-size: 13px; }
        .btn-logout { background-color: transparent; color: #ff4d4d; border: 1px solid #ff4d4d; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 12px; }
        .btn-logout:hover { background-color: #ff4d4d; color: #ffffff; }
        
        /* CONTAINER UTAMA */
        .main-container { background-color: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 15px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.4); }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-left: 4px solid #cda22e; padding-left: 12px; }
        .section-header h2 { font-size: 20px; letter-spacing: 1px; color: #ffffff; }
        .section-header p { color: #777777; font-size: 12px; margin-top: 3px; }
        
        .btn-add { background-color: #cda22e; color: #000000; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 12px; }
        .btn-add:hover { background-color: #b38d24; }
        
        /* STYLE TABEL - TETAP PERKECIL (FONT-SIZE: 13px) */
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; margin-top: 10px; border: 1px solid #2a2a2a; }
        
        th { background-color: #242424; color: #cda22e; padding: 12px; font-size: 12px; text-transform: uppercase; border-bottom: 2px solid #333333; border-right: 1px solid #2e2e2e; letter-spacing: 0.5px; }
        th:last-child { border-right: none; }
        
        td { padding: 12px; font-size: 13px; color: #e0e0e0; border-bottom: 1px solid #262626; border-right: 1px solid #262626; vertical-align: middle; }
        td:last-child { border-right: none; }
        tr:hover td { background-color: #222222; }
        
        .tari-badge { font-weight: bold; color: #cda22e; background-color: #2b2515; border: 1px solid #cda22e; padding: 3px 8px; border-radius: 5px; font-size: 11px; display: inline-block; }
        
        .action-links { display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 10px; white-space: nowrap; }
        .btn-edit { color: #cda22e; text-decoration: none; font-weight: bold; display: inline-block; font-size: 12px; }
        .btn-delete { color: #ff4d4d; text-decoration: none; font-weight: bold; display: inline-block; font-size: 12px; }
        .btn-edit:hover, .btn-delete:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="brand">
            <div style="font-size: 24px;">💃</div>
            <div class="brand-text">
                <span class="brand-title">NYAWIJI SUKMA</span>
                <span class="brand-subtitle">Ekskul Seni Tari SMKN 2 Baleendah</span>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <span class="welcome-text">Selamat datang, <b><?php echo htmlspecialchars($username_sekarang); ?></b></span>
            <a href="logout.php" class="btn-logout">Keluar Sistem</a>
        </div>
    </div>

    <div class="main-container">
        <div class="section-header">
            <div>
                <h2>Daftar Anggota Eskul Tari</h2>
                <p>Biodata eskul seni tari</p>
            </div>
            
            <?php if ($username_sekarang === 'aulia' || $role_sekarang === 'admin'): ?>
                <a href="tambah.php" class="btn-add">+ Tambah Anggota</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Jenis Tari</th>
                        <th>Gender</th>
                        <th>ID Pengguna</th>
                        <th>Tanggal Lahir</th> 
                        <th>Email</th>         
                        <?php if ($username_sekarang === 'aulia' || $role_sekarang === 'admin'): ?>
                            <th>Aksi </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $nama          = !empty($row['nama']) ? $row['nama'] : '-';
                        $kelas         = !empty($row['kelas']) ? $row['kelas'] : '-';
                        $jenis_tari    = !empty($row['jenis_tari']) ? $row['jenis_tari'] : '-';
                        $gender        = !empty($row['jk']) ? $row['jk'] : '-';
                        $username      = !empty($row['username']) ? $row['username'] : '-';
                        $email         = !empty($row['email']) ? $row['email'] : '-';
                        
                        // Memformat tampilan Tanggal Lahir (mengambil dari kolom password database kamu)
                        $tgl_lahir     = !empty($row['password']) ? date('d-m-Y', strtotime($row['password'])) : '-';

                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td><b>" . htmlspecialchars($nama) . "</b></td>";
                        echo "<td>" . htmlspecialchars($kelas) . "</td>";
                        echo "<td><span class='tari-badge'>" . htmlspecialchars($jenis_tari) . "</span></td>";
                        echo "<td>" . htmlspecialchars($gender) . "</td>";
                        echo "<td>" . htmlspecialchars($username) . "</td>";
                        echo "<td>" . htmlspecialchars($tgl_lahir) . "</td>"; 
                        echo "<td>" . htmlspecialchars($email) . "</td>";     
                        
                        // JIKA YANG LOGIN ADALAH ADMIN 'AULIA' -> TAMPILKAN TOMBOL MANAGEMENT NYA
                        if ($username_sekarang === 'aulia' || $role_sekarang === 'admin') {
                            $id_kirim = urlencode($username);
                            echo "<td>
                                    <div class='action-links'>
                                        <a href='edit.php?id={$id_kirim}&username={$id_kirim}' class='btn-edit'>Ubah</a>
                                        <a href='hapus.php?id={$id_kirim}&username={$id_kirim}' class='btn-delete' onclick=\"return confirm('Hapus data?')\">Hapus</a>
                                    </div>
                                  </td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px; margin-bottom: 15px; color: #475569; font-weight: bold;">
        <span>&copy; 2026 by Aulia nur yulianti 💃</span>  
    </div>
</body>
</html>