<?php
    if (isset($_GET['kirim'])) {
        $nama = $_GET['name'];
    if (isset($_POST['kirim'])) {
        $nama = $_POST['name'];
        echo "Nama : $nama";
    }
