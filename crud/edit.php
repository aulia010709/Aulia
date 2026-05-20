<?php
include 'koneksi.php';

$target_id = $_GET['id'];

// Kunci Pintu: Jika dia Guru, pastikan dia hanya buka ID miliknya sendiri
if ($_SESSION['role'] == 'guru' && $target_id != $_SESSION['user_id']) {
    die("Anda tidak berhak mengedit data orang lain!");
}

// Ambil data lama
$query = mysqli_query($koneksi, "SELECT users.username, biodata_guru.* FROM users JOIN biodata_guru ON users.id = biodata_guru.user_id WHERE users.id = '$target_id'");
$data = mysqli_fetch_array($query);

// Proses jika tombol update ditekan
if (isset($_POST['update'])) {
    $nama          = $_POST['nama'];
    $alamat        = $_POST['alamat'];
    $tempat_lahir  = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $username_baru = $_POST['username'];
    $password_baru = $_POST['password'];

    // Update biodata
    mysqli_query($koneksi, "UPDATE biodata_guru SET nama='$nama', alamat='$alamat', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir' WHERE user_id='$target_id'");

    // Update username (Karena input username readonly untuk guru, nilainya tetap sama)
    mysqli_query($koneksi, "UPDATE users SET username='$username_baru' WHERE id='$target_id'");

    // Update password HANYA jika kolomnya diisi
    if (!empty($password_baru)) {
        $pass_enkripsi = md5($password_baru);
        mysqli_query($koneksi, "UPDATE users SET password='$pass_enkripsi' WHERE id='$target_id'");
    }

    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Edit Data</h2>
    <form method="POST" action="">
        <h4>Akun Login</h4>
        Username: <input type="text" name="username" value="<?php echo $data['username']; ?>" <?php echo ($_SESSION['role'] == 'guru') ? 'readonly' : ''; ?> required><br>
        Password Baru: <input type="password" name="password" placeholder="Kosongkan jika tidak ganti"><br>
        
        <h4>Biodata Lengkap</h4>
        Nama: <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required><br>
        Alamat: <textarea name="alamat" required><?php echo $data['alamat']; ?></textarea><br>
        Tempat Lahir: <input type="text" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" required><br>
        Tanggal Lahir: <input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>" required><br><br>
        
        <button type="submit" name="update">Update Data</button>
    </form>
</body>
</html>