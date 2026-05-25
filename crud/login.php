<?php
// 1. Memulai session
session_start();

// Jika admin sudah dalam kondisi login, langsung lempar ke dashboard utama
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// 2. Hubungkan ke database
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Mencari akun berdasarkan username di tabel users kamu
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    // Cek apakah username tersebut terdaftar
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        /* SISTEM VERIFIKASI DUAL MODE (Aman & Fleksibel):
           Bisa membaca password teks biasa (plain text) maupun yang terenkripsi (password_hash).
        */
        if (password_verify($password, $row['password']) || $password === $row['password']) {
            // Set session tanda login berhasil
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            
            header("Location: index.php");
            exit;
        }
    }
    
    // Jika salah, aktifkan tanda error
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Login - Nyawiji Sukma</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            /* Latar belakang gelap arang mengikuti identitas logo Nyawiji Sukma */
            background: linear-gradient(135deg, #111115 0%, #070709 100%);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #ffffff;
        }

        /* Kotak Login Transparan Mewah (Glassmorphism) */
        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 28px;
            padding: 45px 35px;
            border: 1px solid rgba(255, 255, 255, 0.03);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        /* Tampilan Logo Utama di Atas Form */
        .login-logo {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #d4af37; /* Bingkai Keemasan murni */
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
            background-color: #ffffff;
            margin-bottom: 20px;
        }

        .login-card h1 {
            font-size: 24px;
            color: #ffffff;
            margin: 0 0 5px 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .login-card p {
            font-size: 11px;
            color: #8a8a93;
            margin: 0 0 35px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Desain Kolom Isian Form */
        .input-group {
            margin-bottom: 24px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 11px;
            color: #a1a1aa;
            margin-bottom: 8px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        /* Efek Berpendar Emas Saat Input Diklik/Fokus */
        .input-group input:focus {
            border-color: #d4af37;
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 12px rgba(212, 175, 55, 0.2);
        }

        /* Notifikasi Alert Error Jika Gagal Login */
        .error-alert {
            background: rgba(255, 78, 78, 0.1);
            border: 1px solid rgba(255, 78, 78, 0.2);
            color: #ff6b6b;
            padding: 12px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 25px;
            text-align: center;
        }

        /* Tombol Masuk Bertema Gradasi Emas Nyawiji Sukma */
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #d4af37 0%, #b38f1d 100%);
            color: #0d0d11;
            padding: 14px;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(212, 175, 55, 0.45);
        }

        /* Footer Keterangan Tambahan Swasta */
        .login-footer {
            margin-top: 35px;
            font-size: 11px;
            color: #52525b;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <img src="logo - Copy.jpg" alt="Logo Nyawiji Sukma" class="login-logo">
        
        <h1>NYAWIJI SUKMA</h1>
        <p>Seni Tari Portal Admin</p>

        <?php if (isset($error)) : ?>
            <div class="error-alert">
                ❌ Username atau Password salah!
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-group">
                <label for="username">Nama Pengguna (Username)</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda..." autocomplete="off" required>
            </div>

            <div class="input-group">
                <label for="password">Kata Sandi (Password)</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda..." required>
            </div>

            <button type="submit" name="login" class="btn-login">Masuk Sistem</button>
        </form>

        <div class="login-footer">
            &copy; 2026 Nyawiji Sukma Studio. All Rights Reserved.
        </div>
    </div>

</body>
</html>