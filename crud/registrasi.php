<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Eskul Seni Tari</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f2f8; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        /* Gaya Kotak Form Registrasi */
        .register-container {
            background-color: #ffffff;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 420px;
            margin: 20px;
            z-index: 10;
            position: relative;
        }

        .register-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .register-header h2 {
            margin: 0 0 5px 0;
            color: #6a4c93; 
            font-size: 22px;
            font-weight: bold;
        }

        .register-header p {
            margin: 0;
            font-size: 13px;
            color: #888;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-size: 13px;
            font-weight: 600;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e0dced;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #faf9fc;
            color: #333;
            transition: all 0.3s ease;
        }

        .form-group input:focus, 
        .form-group select:focus {
            border-color: #6a4c93;
            outline: none;
            box-shadow: 0 0 0 3px rgba(106, 76, 147, 0.1);
            background-color: #ffffff;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
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

        .btn-register:hover {
            background-color: #543a75;
        }

        /* Gaya Efek Bunga Berterbangan */
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
            0% { transform: translate(0, -10px) rotate(0deg); opacity: 0.7; }
            50% { transform: translate(50px, 50vh) rotate(180deg); opacity: 0.5; }
            100% { transform: translate(0px, 100vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body>

    <div class="falling-flowers" id="fallingFlowers"></div>

    <div class="register-container">
        <div class="register-header">
            <h2>🌸 Pembuatan Akun Baru 🌸</h2>
            <p>Daftarkan diri Anda untuk bergabung ke dalam sistem</p>
        </div>

        <form action="proses_registrasi.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select id="kelas" name="kelas" required>
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    <option value="X TJKT 1">X TJKT 1</option>
                    <option value="X TJKT 2">X TJKT 2</option>
                    <option value="X TJKT 3">X TJKT 3</option>
                    <option value="X TJKT 4">X TJKT 4</option>
                    <option value="XI TJKT 1">XI TJKT 1</option>
                    <option value="XI TJKT 2">XI TJKT 2</option>
                    <option value="XI TJKT 3">XI TJKT 3</option>
                    <option value="XI TJKT 4">XI TJKT 4</option>
                    <option value="XII TJKT 1">XII TJKT 1</option>
                    <option value="XII TJKT 2">XII TJKT 2</option>
                    <option value="XII TJKT 3">XII TJKT 3</option>
                    <option value="XII TJKT 4">XII TJKT 4</option>
                </select>
            </div>

            <div class="form-group">
                <label for="spesialisasi">Spesialisasi Tari</label>
                <select id="spesialisasi" name="spesialisasi" required>
                    <option value="" disabled selected>-- Pilih Jenis Tari --</option>
                    <option value="Tradisional">Tradisional</option>
                    <option value="Modern">Modern</option>
                    <option value="Kontemporer">Kontemporer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="username">ID Pengguna (Username)</label>
                <input type="text" id="username" name="username" placeholder="Buat username baru" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="contoh@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Buat password baru" required>
            </div>

            <button type="submit" class="btn-register">Daftar Akun Baru</button>
            
            <p style="text-align: center; font-size: 13px; color: #666; margin-top: 15px; margin-bottom: 0;">
                Sudah punya akun? <a href="login.php" style="color: #6a4c93; font-weight: bold; text-decoration: none;">Login Disini</a>
            </p>
        </form>
    </div>

    <script>
        const container = document.getElementById('fallingFlowers');
        const numberOfFlowers = 25;
        for (let i = 0; i < numberOfFlowers; i++) {
            const flower = document.createElement('div');
            flower.classList.add('flower');
            flower.innerText = '🌸';
            flower.style.left = Math.random() * 100 + 'vw';
            flower.style.animationDuration = Math.random() * 3 + 3 + 's';
            flower.style.animationDelay = Math.random() * 5 + 's';
            container.appendChild(flower);
        }
    </script>
</body>
</html>