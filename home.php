<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("location: index.php?p+Silahkan login terlebih dahulu!");
    exit();
}

date_default_timezone_set('Asia/Jakarta');
$hour = date('H');
$msg = "";

if ($hour < 10) {
    $msg = "Selamat Pagi!";
} else if ($hour < 14) {
    $msg = "Selamat Siang!";
} else if ($hour < 17) {
    $msg = "Selamat Sore!";
} else {
    $msg = "Selamat Malam!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Halaman Home</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2> APLIKASI MANAJEMEN DATA SISWA </h2>
            <p><?php echo date('j F Y')?></p>
            <hr>
            <p> <?php echo $msg;?> </p>
            <p> SELAMAT DATANG DI APLIKASI DATA SISWA SMKS PGRI 3 MALANG </p>
        </div>
    </div>
</body>

</html>