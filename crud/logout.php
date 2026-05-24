<?php
// 1. Wajib jalankan session_start() terlebih dahulu untuk mengenali session yang ada
session_start();

// 2. Hapus semua data variabel session yang tersimpan
session_unset();

// 3. Hancurkan/patahkan sesi login yang sedang berjalan di server komputer
session_destroy();

// 4. Otomatis alihkan (redirect) pengguna kembali ke halaman login.php setelah logout
echo "<script>
        alert('Anda telah berhasil keluar dari sistem.');
        window.location.href = 'login.php';
      </script>";
exit;
?>