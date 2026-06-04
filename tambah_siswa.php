<?php
session_start();
include "koneksi.php";
$prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
$error = "";

if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $kd_prodi = $_POST['kd_prodi'];
    $jk = $_POST['jenis_kelamin'];

    if (empty($nis) || empty($nama)) {
        $error = "Data wajib diisi!";
    } else {
        $target_path = "assets/uploads/";
        $fileExtension = strtolower(pathinfo($_FILES["pfpFile"]["name"], PATHINFO_EXTENSION));
        $file = time() . "_" . date('jmY') . "." . $fileExtension;
        $target_path = $target_path . $file;

        if (move_uploaded_file($_FILES["pfpFile"]["tmp_name"], $target_path)) {
            $query = "INSERT INTO siswa
            (nis, nama, kelas, tahun_ajaran, kd_prodi, jenis_kelamin, profile)
            VALUES ('$nis','$nama','$kelas','$tahun_ajaran','$kd_prodi','$jk', '$file')";
            mysqli_query($koneksi, $query);
            header("location: siswa.php?success=tambah");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data Siswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2>TAMBAH DATA SISWA</h2>
            <hr>
            <form enctype="multipart/form-data" method="POST">
                <div class="form-control">
                    <label>NIS</label>
                    <input type="text" name="nis" required>
                </div>

                <div class="form-control">
                    <label>Nama</label>
                    <input type="text" name="nama" required>
                </div>

                <div class="form-control">
                    <label>Kelas</label>
                    <input type="text" name="kelas" required>
                </div>

                <div class="form-control">
                    <label>Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" required>
                </div>

                <div class="form-control">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <input type="radio" id="laki-laki" name="jenis_kelamin" value="L"> <label for="laki-laki"
                            class="radio-label">Laki-Laki</label>
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="P"> <label for="perempuan"
                            class="radio-label">Perempuan</label>
                    </div>
                </div>

                <div class="form-control">
                    <label>Prodi</label>
                    <select name="kd_prodi" required>
                        <?php while ($p = mysqli_fetch_assoc($prodi)) { ?>
                            <option value="<?php echo $p['kd_prodi']; ?>">
                                <?php echo $p['nama_prodi']; ?>
                            </option>
                        <?php } ?>
                    </select>

                    <div class="form-control">
                        <div class="input-file">
                            <label for="file">Upload Photo</label>
                            <input name="pfpFile" type="file" id="file">
                        </div>
                    </div>

                    <div class="button-control">
                        <a href="siswa.php" class="batal">BATAL</a>
                        <button type="submit" name="simpan" class="submit">TAMBAH</button> <br> <br>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>