<?php
session_start();
include "koneksi.php";

// CEK LOGIN
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
$prodi = mysqli_query($koneksi, "SELECT * FROM prodi");

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $kd_prodi = $_POST['kd_prodi'];
    $jk = $_POST['jenis_kelamin'];
    
    mysqli_query($koneksi, "UPDATE siswa SET
        nis='$nis',
        nama='$nama',
        kelas='$kelas',
        tahun_ajaran='$tahun_ajaran',
        kd_prodi='$kd_prodi',
        jenis_kelamin='$jk'
        WHERE id='$id'
    ");
    
    header("location:siswa.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Data Siswa</title>
        <link rel ="tylesheet" href="style.css">
</head>
<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2>EDIT DATA SISWA</h2>
            <hr>
<form method="POST">
    <table>
        <tr>
            <td>NIS</td>
            <td>
                <input type="text" name="nis" value="<?php echo $data['nis']; ?>" required>
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>
                <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
            </td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>
                <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" required>
            </td>
        </tr>
        <tr>
            <td>Tahun Ajaran</td>
            <td>
                <input type="text" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran']; ?>" required>
            </td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>
                <input type="radio" name="jenis_kelamin" value="L" <?php
            if ($data['jenis_kelamin'] == 'L') {
                echo "checked";
            }
            ?>>Laki-Laki
            <input type="radio" name="jenis_kelamin" value="P" <?php
            if ($data['jenis_kelamin'] == 'P') {
                echo "checked";
            }
            ?>>Perempuan
        </td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td>
            <select name="kd_prodi" required>
                <option value="">
                    -- Pilih Prodi --
                </option>
                <?php
                while ($p = mysqli_fetch_assoc($prodi)) {
                ?>
                <option value="<?php echo $p['kd_prodi']; ?>"
         <?php
                 if ($p['kd_prodi'] == $data['kd_prodi']) {
                   echo "selected" }
        ?>>
                <?php echo $p['nama_prodi']; ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" name="update" class="submit">
                UPDATE
            </button>
        </td>
    </tr>
</table>
</form>
</div>
</div>
</body>
</html>