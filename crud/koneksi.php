<?php
$host     = "localhost";
$username = "root"; 
$password = "";   
$database = "2526_25db"; 

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);


if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>