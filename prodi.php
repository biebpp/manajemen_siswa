<?php
session_start();
header("Cache-Control: no-store, no-chace, must-revalidate, max-age=0");
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("location: index.php?p=Silahkan login terlebih dahulu!");
    exit();
}
include "koneksi.php";

$cari = "";
$src = "";
$input = "";
$filter = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['search'])) {
        $src = $_POST['search'];
    }

    if ($src == "cari") {
        $input = $_POST['input-cari'];
        $filter = $_POST['filter'];

        if ($filter == "kd") {
            $etc = "kd_prodi";
        } else {
            $etc = "nama_prodi";
        }

        $cari = "WHERE " . $etc . " LIKE '%$input%'";
    } else if ($src == "reset") {
        $cari = "";
        $input = "";
    } else {
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM prodi $cari");
?>

<!DOCTYPE html>
<html>

<head>
    <title> Data Prodi</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <?php include "navigasi.php"; ?>
    <div class="container">
        <h2> Data Prodi</h2>
        <hr> <br>

        <?php
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 'tambah') {
                echo "<p style='color:green;'> Data berhasil di tambahkan!</p>";
            }

            if ($_GET['success'] == 'edit') {
                echo "<p style='color:green;'>Data berhasil diubah!</p>";
            }
        }
        ?>

        <div class="container-table-control">
            <a href="tambah_prodi.php" class="tambah">TAMBAH DATA PRODI</a>

            <form method="POST" class="form-cari">
                <select name="filter">
                    <option value="kd" <?php if ($filter == "kd") { echo "selected"; } ?>><label>Kode</label></option>
                    <option value="nama" <?php if ($filter == "nama") { echo "selected"; } ?>><label>Nama</label></option>
                </select>
                <input type="text" name="input-cari" placeholder="Kolom Pencarian..." value="<?php echo $input; ?>">
                <button type="submit" name="search" value="cari" class="cari">Cari</button>
                <button type="submit" name="search" value="reset" class="reset">Reset</button>
            </form>
        </div>

        <table>
            <tr>
                <th> Kode Prodi</th>
                <th> Nama Prodi</th>
                <th>ACTION</th>

            </tr>
            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?php echo $row['kd_prodi']; ?></td>
                    <td><?php echo $row['nama_prodi']; ?></td>
                    <td>
                        <a class="hapus-action" href="edit_prodi.php?id_prodi=<?php echo
                            $row['id_prodi']; ?>">EDIT</a>

                        <a class="edit-action" href="hapus_prodi.php?id_prodi=<?php echo
                            $row['id_prodi']; ?>" onclick="return confirm('Yakin ingin hapus?')"> DELETE</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>