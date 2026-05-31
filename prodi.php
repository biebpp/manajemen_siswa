<?php
session_start();
header("Cache-Control: no-store, no-chace, must-revalidate, max-age=0");
if (!isset($_SESSION['login'])|| $_SESSION['login'] !=true){
    header("location: index.php?p=Silahkan login terlebih dahulu!");
    exit();
}
include "koneksi.php";
$data =mysqli_query($koneksi, "SELECT * FROM prodi");
?>

<!DOCTYPE html>
<html>

<head>
    <title> Data Prodi</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body> 
    <?php include "navigasi.php";?>
    <?php
    if (isset($_GET['success'])){
        if($_GET['success']=='tambah') {
            echo "<p style='color:green;'> Data berhasil di tambahkan!</p>";
        }

        if ($_GET['success']== 'edit'){
            echo "<p style='color:green;'>Data berhasil diubah!</p>";
        }
    }
    ?>
    <div class="container">
        <h2> Data Prodi</h2>
        <hr>
        <a href="tambah_prodi.php" class="tambah">TAMBAH DATA PRODI</a>
        <br><br>
        <table>
            <tr>
                <th> Kode Prodi</th>
                <th> Nama Prodi</th>
                <th>ACTION</th>

</tr>
<?php while ($row =mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?php echo $row['kd_prodi']; ?></td>
    <td><?php echo $row['nama_prodi']; ?></td>
    <td>
    <a href= "edit_prodi.php?id_prodi=<?php echo
    $row['id_prodi']; ?>"<EDIT</a>

    <a href="hapus_prodi.php?id_prodi=<?php echo
    $row['id_prodi']; ?>"
    onclick="return confrim('Yakin ingin hapus?)"> DELETE</a>
    </td>
    </tr>
    <?php } ?>
    </table>
    </div>
    </div>
    </body>
    </html>