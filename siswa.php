<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!isset($_SESSION['login']) || $_SESSION ['login'] != true) {
    header("location: index.php?p=Silahkan login terlebih dahulu!");
    exit();
}
include "koneksi.php";

// ambil data siswa + prodi (JOIN)
$data =mysqli_query($koneksi, "SELECT s.*, p.nama-prodi FROM siswa s JOIN prodi p ON s.kd_prodi =p.kd_prodi");
?>
<!DOCTYPE html>
<html 
<head>
    <title>Data Siswa</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <?php include "navigasi.php"; ?>
    <div class="container">
        <h2>Data Siswa</h2>
        <hr>
        <a href="tambah_siswa.php" class="tambah"> TAMBAH DATA SISWA</a>
        <table>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Action</th>
</tr>
<?php while ($row=mysqli_fetch_assoc($data)) { ?>
<tr> 
    <td><?php echp $row['nis']; ?></td>
     <td><?php echp $row['nama']; ?></td>
    <td><?php echp $row['nis']; ?></td>
  <td><?php echp $row['nis']; ?></td>
    <td><?php echp $row['nis']; ?></td>
    <td><?php echp $row['nis']; ?></td>
<td>
    <a href="edit_siswa.php?id=<?php echo $row['id'];

    <a href="hapus_siswa.php?id=<?php echo $row['id']; ?>"
    onclick="return confirm('yakin ingin hapus?')">DELETE</a>
    </td>
    </tr>
    <?php } ?>
    </table>
    </div>
    </div>
    </body>
    </html>
    

