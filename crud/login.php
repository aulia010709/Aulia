<?php
session_start();
// Jika sudah login, langsung lempar ke index.php biar tidak bolak-balik login
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
     <link rel="icon" href="logotari.jpeg" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyawiji Sukma - Masuk</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { background-color: #121212; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background-color: #1a1a1a; border: 1px solid #262626; border-radius: 20px; padding: 40px 35px; width: 100%; max-width: 400px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6); text-align: center; }
        .logo { font-size: 38px; margin-bottom: 10px; }
        h2 { color: #cda22e; font-size: 22px; font-weight: 700; letter-spacing: 1.5px; margin-bottom: 5px; text-transform: uppercase; }
        .subtitle { color: #777777; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 25px; }
        form { text-align: left; }
        .form-group { margin-bottom: 20px; }
        label { display: block; color: #aaaaaa; font-size: 13px; margin-bottom: 8px; font-weight: 600; }
        .input-field { width: 100%; background-color: #242424; border: 1px solid #333333; border-radius: 10px; padding: 14px 16px; color: #ffffff; font-size: 14px; outline: none; }
        .input-field:focus { border-color: #cda22e; }
        
        .password-container { position: relative; width: 100%; }
        .password-container .input-field { padding-right: 45px; }
        .toggle-password { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 16px; user-select: none; }

        .btn-submit { width: 100%; background-color: #cda22e; color: #000000; border: none; border-radius: 10px; padding: 14px; font-size: 14px; font-weight: 700; letter-spacing: 1px; cursor: pointer; margin-top: 10px; text-transform: uppercase; }
        .btn-submit:hover { background-color: #b58d22; }
        .reg-link { color: #aaaaaa; font-size: 13px; margin-top: 25px; display: inline-block; text-decoration: none; }
        .reg-link a { color: #cda22e; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card">
        <div class="logo">💃</div>
        <h2>NYAWIJI SUKMA</h2>
        <p class="subtitle">eskul seni tari</p>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label>ID Pengguna (Username)</label>
                <input type="text" name="username" class="input-field" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Kata Sandi (Password)</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="input-field" placeholder="Masukkan password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                </div>
            </div>

            <button type="submit" class="btn-submit">MASUK</button>
            
            <center>
                <p class="reg-link">Belum punya akun? <a href="registrasi.php"> Yu Daftar Sekarang !</a></p>
            </center>
        </form>
    </div>

<script>
function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var toggleIcon = document.querySelector(".toggle-password");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.textContent = "🙈";
    } else {
        passwordField.type = "password";
        toggleIcon.textContent = "👁️";
    }
}
</script>
</body>
</html>