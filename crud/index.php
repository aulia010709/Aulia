<?php 
include 'koneksi.php';

// Jika belum login, tendang kembali ke halaman login

if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
    exit;
}

$role = $_SESSION['role'];
$my_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<body>
    <h3>Halo, <?php echo $_SESSION['username']; ?> (Status: <?php echo $role; ?>)</h3>
    <a href="logout.php">Logout</a> | 
    
    <?php if ($role == 'admin') { ?>
        <a href="tambah.php">+ Tambah Guru Baru</a>
    <?php } ?>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Username</th><th>Nama</th><th>Alamat</th><th>Tempat, Tgl Lahir</th><th>Aksi</th>
        </tr>

        <?php
        // Logika Query: Admin lihat semua, Guru lihat dirinya sendiri
        if ($role == 'admin') {
            $query = mysqli_query($koneksi, "SELECT users.username, biodata_guru.* FROM users JOIN biodata_guru ON users.id = biodata_guru.user_id");
        } else {
            $query = mysqli_query($koneksi, "SELECT users.username, biodata_guru.* FROM users JOIN biodata_guru ON users.id = biodata_guru.user_id WHERE users.id = '$my_id'");
        }

        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['tempat_lahir'] . ", " . $data['tanggal_lahir']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $data['user_id']; ?>">Edit</a>
                
                <?php if ($role == 'admin') { ?>
                    | <a href="hapus.php?id=<?php echo $data['user_id']; ?>" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>