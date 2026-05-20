<?php
include 'koneksi.php';

// Menangkap data dari form edit
$id            = $_POST['id'];
$nama          = $_POST['nama'];
$alamat        = $_POST['alamat'];
$tempat_lahir  = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];

// Query untuk memperbarui (UPDATE) data di database berdasarkan ID
$query = mysqli_query($koneksi, "UPDATE biodata_guru SET nama='$nama', alamat='$alamat', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir' WHERE id='$id'");

// Mengalihkan halaman kembali ke index.php
header("location:index.php");
?>