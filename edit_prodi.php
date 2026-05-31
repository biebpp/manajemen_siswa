<?php
session_start();
include "koneksi.php";
$id_prodi = isset($_GET['id_prodi']) ? $_GET['id_prodi'] : '';
$query = mysqli_query($koneksi, "SELECT * FROM prodi WHERE id_prodi='$id_prodi'");
$data = mysqli_fetch_assoc($query);

$error = "";
if (isset($_POST['update'])) {
    $kd_prodi = $_POST['kd_prodi'];
    $nama_prodi = $_POST['nama_prodi'];
    mysqli_query($koneksi, "UPDATE prodi SET kd_prodi='$kd_prodi', nama_prodi='$nama_prodi' WHERE id_prodi='$id_prodi'");
    header("location: prodi.php?success=edit");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Prodi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2>EDIT DATA PRODI</h2>
            <hr>
            <!--- Form dengan value terisi data lama --->
            <form method="POST">
                <label>Kode Prodi</label><br>
                <input type="text" name="kd_prodi" value="<?php echo $data['kd_prodi']; ?>" required>
                <label>Nama Prodi</label><br>
                <input type="text" name="nama_prodi" value="<?php echo $data['nama_prodi']; ?>" required><br><br>
                <div class="button-control">
                    <a href="prodi.php" class="batal">BATAL</a>
                    <button type="submit" name="update" class="submit">UPDATE</button> <br> <br>
                </div>
            </form>
        </div>
    </div>
</body>

</html>