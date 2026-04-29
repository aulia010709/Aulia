<?php
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Terminate script execution after the redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Ekskul Seni</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>FORM BIODATA PENDAFTAR EKSKUL SENI</h2>
<h3>Selamat datang, <?php echo $_SESSION['username']; ?>!</h3>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>NIS</th>
        <th>Alamat</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
    </tr>

    <tr>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="date"></td>
    </tr>
</table>

<br>

<form action="logout.php" method="POST">
    <input type="submit" value="Logout">
</form>

</body>
</html>