<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eskul Seni Tari</title>
    <style>
        /* Mengatur font dan background halaman mirip dengan dashboard */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f2f8; /* Warna latar ungu sangat pudar */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden; /* Mencegah scroll saat bunga berterbangan */
        }

        /* Dekorasi Bunga Statis di Pojok */
        .decor-bunga-statis {
            position: absolute;
            font-size: 40px;
            opacity: 0.15;
            pointer-events: none;
            user-select: none;
        }
        .bunga-s1 { top: 20px; left: 20px; }
        .bunga-s2 { bottom: 30px; right: 30px; }

        /* Membuat kotak form putih dengan sudut membulat seperti tabel dashboard */
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); /* Bayangan sangat halus */
            width: 100%;
            max-width: 380px;
            z-index: 10; /* Agar di atas bunga yang berterbangan */
            position: relative;
        }

        /* Mengatur bagian judul */
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            margin: 0 0 8px 0;
            color: #6a4c93; /* Warna ungu senada dengan teks di dashboard */
            font-size: 24px;
        }

        .login-header p {
            margin: 0;
            font-size: 14px;
            color: #888;
        }

        /* Mengatur jarak antar inputan */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 13px;
            font-weight: 600;
        }

        /* Gaya kotak input (kotak ketik) */
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0dced;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #faf9fc;
            transition: all 0.3s ease;
        }

        /* Efek saat kotak input diklik/sedang mengetik */
        .form-group input:focus {
            border-color: #6a4c93;
            outline: none;
            box-shadow: 0 0 0 3px rgba(106, 76, 147, 0.1);
            background-color: #ffffff;
        }

        /* Gaya tombol ungu senada dengan tombol "+ Tambah Anggota" */
        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: #6a4c93; 
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #543a75; /* Warna ungu lebih gelap saat di-hover */
        }

        /* ==============================
           GAYA UNTUK BUNGA BERTERBANGAN
           ============================== */
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
            font-size: 18px;
            opacity: 0.7;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translate(0, -10px) rotate(0deg);
                opacity: 0.7;
            }
            25% {
                transform: translate(60px, 25vh) rotate(90deg);
            }
            50% {
                transform: translate(0px, 50vh) rotate(180deg);
                opacity: 0.5;
            }
            75% {
                transform: translate(60px, 75vh) rotate(270deg);
            }
            100% {
                transform: translate(0px, 100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

    <div class="decor-bunga-statis bunga-s1">🌸</div>
    <div class="decor-bunga-statis bunga-s2">🌸</div>

    <div class="falling-flowers" id="fallingFlowers"></div>

    <div class="login-container">
        <div class="login-header">
            <h2>💃 ESKUL SENI TARI</h2>
            <p>Silakan login untuk masuk ke sistem</p>
        </div>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="username">ID Pengguna</label>
                <input type="text" id="username" name="username" placeholder="Masukkan ID Pengguna" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
            </div>

            <button type="submit" class="btn-login">Masuk Sistem</button>
            
            <p style="text-align: center; font-size: 13px; color: #666; margin-top: 25px; margin-bottom: 0;">
                Belum punya akun? <a href="registrasi.php" style="color: #6a4c93; font-weight: bold; text-decoration: none;">Sign Up</a>
            </p>
        </form>
    </div>

    <script>
        const container = document.getElementById('fallingFlowers');
        const numberOfFlowers = 25; // Jumlah bunga di halaman login

        for (let i = 0; i < numberOfFlowers; i++) {
            const flower = document.createElement('div');
            flower.classList.add('flower');
            flower.innerText = '🌸';
            
            flower.style.left = Math.random() * 100 + 'vw';
            flower.style.animationDuration = Math.random() * 3 + 3 + 's'; // Santai dan estetik
            flower.style.animationDelay = Math.random() * 5 + 's';
            
            container.appendChild(flower);
        }
    </script>

</body>
</html>