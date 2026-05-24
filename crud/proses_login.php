<?php
// 1. Memulai session untuk menyimpan status login dan hak akses
session_start();

// 2. Memeriksa apakah data dikirim dari form login
if (isset($_POST['username']) && isset($_POST['password'])) {
    
    // Mengambil data yang diketik di halaman login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 3. Memeriksa apakah username dan password cocok
    if ($username === 'aulia' && $password === 'aulia123') {
        
        // Simpan status login ke komputer
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        
        // KUNCI JAWABAN: Tambahkan role admin di sini agar file hapus.php bisa mengizinkanmu masuk
        $_SESSION['role'] = 'admin'; 

        // Langsung pindah ke halaman utama dashboard
        header("Location: index.php");
        exit;
    } else {
        echo "<script>
                alert('Username atau Password Salah!');
                window.location.href = 'login.php';
              </script>";
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>