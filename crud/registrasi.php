<?php
include 'koneksi.php';

$nama = $kelas = $jenis_tari = $jk = $tanggal_lahir = $username = $email = $jurusan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jurusan       = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $kelas         = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $jenis_tari    = mysqli_real_escape_string($koneksi, $_POST['jenis_tari']);
    $jk            = mysqli_real_escape_string($koneksi, $_POST['jk']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $username      = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email         = mysqli_real_escape_string($koneksi, $_POST['email']);
    
    // MENERIMA PASSWORD TEKS BEBAS BARU
    $password_input = mysqli_real_escape_string($koneksi, $_POST['password']);
    $role          = 'siswa'; 

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        $error = "Username sudah digunakan! Silakan pilih username lain.";
    } else {
        // Kolom password sekarang diisi oleh $password_input (teks bebas)
        $query = "INSERT INTO users (username, nama, kelas, jenis_tari, jk, email, password, role, tanggal_lahir) 
                  VALUES ('$username', '$nama', '$kelas', '$jenis_tari', '$jk', '$email', '$password_input', '$role', '$tanggal_lahir')";
                  
        $execute = mysqli_query($koneksi, $query);

        if ($execute) {
            echo "<script>
                    alert('Pendaftaran Berhasil! Silakan Login dengan Password baru Anda.');
                    window.location.href='login.php';
                  </script>";
            exit();
        } else {
            $error = "Gagal mendaftar: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
     <link rel="icon" href="logotari.jpeg" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyawiji Sukma - Registrasi Anggota</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { background-color: #121212; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 40px 0; }
        .card { background-color: #1a1a1a; border: 1px solid #262626; border-radius: 20px; padding: 40px 35px; width: 100%; max-width: 450px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6); text-align: center; }
        .logo { font-size: 38px; margin-bottom: 10px; }
        h2 { color: #cda22e; font-size: 22px; font-weight: 700; letter-spacing: 1.5px; margin-bottom: 5px; text-transform: uppercase; }
        .subtitle { color: #777777; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 25px; }
        form { text-align: left; }
        .form-group { margin-bottom: 15px; }
        label { display: block; color: #aaaaaa; font-size: 13px; margin-bottom: 6px; font-weight: 600; }
        .input-field, select { width: 100%; background-color: #242424; border: 1px solid #333333; border-radius: 10px; padding: 12px 16px; color: #ffffff; font-size: 14px; outline: none; }
        .input-field:focus, select:focus { border-color: #cda22e; }
        
        .password-container { position: relative; width: 100%; }
        .password-container .input-field { padding-right: 45px; }
        .toggle-password { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 16px; user-select: none; }
        
        .btn-submit { width: 100%; background-color: #cda22e; color: #000000; border: none; border-radius: 10px; padding: 14px; font-size: 14px; font-weight: 700; letter-spacing: 1px; cursor: pointer; margin-top: 15px; text-transform: uppercase; }
        .btn-submit:hover { background-color: #b58d22; }
        .error-msg { color: #ff4d4d; font-size: 13px; margin-bottom: 15px; text-align: left; }
        .login-link { color: #aaaaaa; font-size: 13px; margin-top: 20px; display: inline-block; text-decoration: none; }
        .login-link a { color: #cda22e; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card">
        <div class="logo">💃</div>
        <h2>NYAWIJI SUKMA</h2>
        <p class="subtitle">Buat Akun Anggota Baru</p>

        <?php if (!empty($error)): ?>
            <div class="error-msg">❌ <?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="input-field" placeholder="Masukkan nama lengkap" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <select id="jurusan" name="jurusan" onchange="updateKelas()" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="TJKT" <?php if($jurusan == 'TJKT') echo 'selected'; ?>>Teknik Jaringan Komputer & Telekomunikasi (TJKT)</option>
                    <option value="TKI" <?php if($jurusan == 'TKI') echo 'selected'; ?>>Teknik Komputer & Informatika (TKI)</option>
                    <option value="KULINER" <?php if($jurusan == 'KULINER') echo 'selected'; ?>>Kuliner</option>
                    <option value="BUSANA" <?php if($jurusan == 'BUSANA') echo 'selected'; ?>>Busana</option>
                    <option value="TKC" <?php if($jurusan == 'TKC') echo 'selected'; ?>>Teknik Komputer & Jaringan C (TKC)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select id="kelas" name="kelas" required>
                    <option value="">-- Pilih Jurusan Terlebih Dahulu --</option>
                </select>
            </div>

            <div class="form-group">
                <label>Spesialisasi Tari</label>
                <select name="jenis_tari" required>
                    <option value="">-- Pilih Jenis Tari --</option>
                    <option value="Tradisional" <?php if($jenis_tari == 'Tradisional') echo 'selected'; ?>>Tradisional</option>
                    <option value="Kontemporer" <?php if($jenis_tari == 'Kontemporer') echo 'selected'; ?>>Kontemporer</option>
                    <option value="Modern" <?php if($jenis_tari == 'Modern') echo 'selected'; ?>>Modern</option>
                </select>
            </div>

            <div class="form-group">
                <label>Gender (Jenis Kelamin)</label>
                <select name="jk" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" <?php if($jk == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if($jk == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="input-field" value="<?php echo htmlspecialchars($tanggal_lahir); ?>" required>
            </div>

            <div class="form-group">
                <label>ID Pengguna (Username)</label>
                <input type="text" name="username" class="input-field" placeholder="Buat username baru" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>

            <div class="form-group">
                <label>Kata Sandi (Password)</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="input-field" placeholder="Buat password bebas" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="input-field" placeholder="contoh@gmail.com" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <button type="submit" class="btn-submit">DAFTAR</button>
            
            <center>
                <p class="login-link">Sudah punya akun? <a href="login.php">Masuk</a></p>
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

function updateKelas() {
    var jurusan = document.getElementById("jurusan").value;
    var kelasSelect = document.getElementById("kelas");
    var kelasLama = "<?php echo $kelas; ?>";
    
    kelasSelect.innerHTML = '<option value="">-- Pilih Kelas --</option>';
    if (jurusan === "") return;
    
    var daftarKelas = {
        "TJKT": ["X TjKt1", "X TjKt2", "X TjKt3", "XI TJKT1", "XI TJKT2", "XI TJKT3", "XI TJKT4", "XII TJKT1", "XII TJKT2", "XII TJKT3"],
        "TKI": ["X TKI1", "X TKI2", "X TKI3", "XI TKI1", "XI TKI2", "XI TKI3", "XII TKI1", "XII TKI2", "XII TKI3"],
        "KULINER": ["X KULINER1", "X KULINER2", "X KULINER3", "X KULINER4", "X KULINER5", "XI KULINER 1", "XI KULINER 2", "XI KULINER 3", "XI KULINER 4", "XI KULINER 5", "XI KULINER 6", "XII KULINER 1", "XII KULINER 2", "XII KULINER 3", "XII KULINER 4", "XII KULINER 5"],
        "BUSANA": ["X BUSANA 1", "X BUSANA 2", "X BUSANA 3", "XI BUSANA 1", "XI BUSANA 2", "XI BUSANA 3", "XII BUSANA 1", "XII BUSANA 2", "XII BUSANA 3"],
        "TKC": ["X TKC1", "X TKC2", "X TKC3", "XI TKC1", "XI TKC2", "XI TKC3", "XII TKC1", "XII TKC2", "XII TKC3"]
    };
    
    daftarKelas[jurusan].forEach(function(item) {
        var option = document.createElement("option");
        option.value = item;
        option.text = item;
        if(item === kelasLama) option.selected = true;
        kelasSelect.appendChild(option);
    });
}
window.onload = function() { if(document.getElementById("jurusan").value !== "") updateKelas(); };
</script>
</body>
</html>