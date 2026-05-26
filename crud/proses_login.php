<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'koneksi.php';

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // 1. JALUR KHUSUS UNTUK ADMIN (AULIA)
    if ($username === '2526_25' && $password === 'aulia079') {
        $_SESSION['username'] = 'aulia';
        $_SESSION['role']     = 'admin'; // Menandakan bahwa ini adalah admin
        
        echo "<script>
                alert('Login Berhasil! Selamat Datang Admin Aulia.');
                window.location.href = 'index.php';
              </script>";
        exit();
    }

    // 2. JALUR UNTUK SISWA / USER BIASA (MENGAMBIL DARI DATABASE)
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = 'siswa'; // Menandakan bahwa ini adalah siswa biasa

            echo "<script>
                    alert('Login Berhasil! Selamat Datang " . htmlspecialchars($row['username']) . ".');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Gagal Masuk: Password Salah!');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('Gagal Masuk: Username tidak ditemukan!');
                window.location.href = 'login.php';
              </script>";
        exit();
    }
}
?>