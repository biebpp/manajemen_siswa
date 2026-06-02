<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("location: index.php?error=session_ranout");
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
        $type = "%$input%";
        
        if ($filter == "nis") {
            $etc = "s.nis";
            $type = "$input";
        } else if ($filter == "kelas") {
            $etc = "s.kelas";
        } else if ($filter == "prodi") {
            $etc = "s.kd_prodi";
        } else {
            $etc = "s.nama";
        }

        $cari = "WHERE " . $etc . " LIKE '$type'";

    } else if ($src == "reset") {
        $cari = "";
        $input = "";
    } else {
    }
}

// ambil data siswa + prodi (JOIN)
$data = mysqli_query($koneksi, "SELECT s.*, p.nama_prodi FROM siswa s 
                                JOIN prodi p ON s.kd_prodi = p.kd_prodi $cari");
?>
<!DOCTYPE html>
<html <head>
<title>Data Siswa</title>
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</head>

<body>
    <?php include "navigasi.php"; ?>
    <div class="container">
        <h2>Data Siswa</h2>
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

            <a href="tambah_siswa.php" class="tambah"> TAMBAH DATA SISWA</a>

            <form method="POST" class="form-cari">
                <select name="filter">
                    <option value="nis" <?php if($filter == "nis") {echo "selected";} ?>><label>NIS</label></option>
                    <option value="nama" <?php if($filter == "nama") {echo "selected";} ?>><label>Nama</label></option>
                    <option value="kelas" <?php if($filter == "kelas") {echo "selected";} ?>><label>Kelas</label></option>
                    <option value="prodi" <?php if($filter == "prodi") {echo "selected";} ?>><label>Prodi</label></option>
                </select>
                <input type="text" name="input-cari" placeholder="Kolom Pencarian..." value="<?php echo $input; ?>">
                <button type="submit" name="search" value="cari" class="cari">Cari</button>
                <button type="submit" name="search" value="reset" class="reset">Reset</button>
            </form>
        </div>

        <table>
            <tr>
                <th>Profil</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Tahun Ajaran</th>
                <th>Prodi</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><img src="assets/images/pfp.png" alt="pfp" class="profil"></td>
                    <td> <?php echo $row['nis']; ?> </td>
                    <td> <?php echo $row['nama']; ?> </td>
                    <td> <?php echo $row['kelas']; ?> </td>
                    <td> <?php if ($row['jenis_kelamin'] == "L") {echo "Laki-Laki";} else {echo "Perempuan";} ?> </td>
                    <td> <?php echo $row['tahun_ajaran']; ?> </td>
                    <td> <?php echo $row['kd_prodi']; ?> </td>
                    <td>
                        <a class="edit-action" href="edit_siswa.php?id=<?php echo $row['id']; ?>">EDIT</a>
                        <a class="hapus-action" href="hapus_siswa.php?id=<?php echo $row['id']; ?>"
                            onclick="return confirm('Yakin ingin hapus?')">DELETE</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>