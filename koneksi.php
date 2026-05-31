<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "kelompok6_penilaian";

    $koneksi = mysqli_connect($host, $username, $password);

    if ($koneksi) {
        $pilih_db = mysqli_select_db($koneksi, $database);
        if ($pilih_db) {
            // echo "success";
        }
    }
?>