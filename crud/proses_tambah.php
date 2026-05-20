<?php
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$nama          = $_POST['nama'];
$alamat        = $_POST['alamat'];
$tempat_lahir  = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];

// Query untuk memasukkan (INSERT) data ke database
$query = mysqli_query($koneksi, "INSERT INTO biodata_guru (nama, alamat, tempat_lahir, tanggal_lahir) VALUES ('$nama', '$alamat', '$tempat_lahir', '$tanggal_lahir')");

// Mengalihkan halaman kembali ke index.php
header("location:index.php");
?>