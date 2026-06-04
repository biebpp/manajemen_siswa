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

    $target_path = "assets/uploads/";
    $fileExtension = strtolower(pathinfo($_FILES["pfpFile"]["name"], PATHINFO_EXTENSION));
    $file = time() . "_" . date('jmY') . "." . $fileExtension;
    $target_path = $target_path . $file;

    if (move_uploaded_file($_FILES["pfpFile"]["tmp_name"], $target_path)) {
        mysqli_query($koneksi, "UPDATE siswa SET
        nis='$nis',
        nama='$nama',
        kelas='$kelas',
        tahun_ajaran='$tahun_ajaran',
        kd_prodi='$kd_prodi',
        jenis_kelamin='$jk',
        profile = '$file'
        WHERE id='$id'
    ");
    header("location:siswa.php?success=edit");
    exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2>EDIT DATA SISWA</h2>
            <hr>
            <form enctype="multipart/form-data" method="POST">
                <div class="form-control">
                    <label>NIS</label>
                    <input type="text" name="nis" value="<?php echo $data['nis']; ?>" required>
                </div>

                <div class="form-control">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
                </div>

                <div class="form-control">
                    <label>Kelas</label>
                    <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" required>
                </div>

                <div class="form-control">
                    <label>Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran']; ?>" required>
                </div>

                <div class="form-control">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <input type="radio" id="laki-laki" name="jenis_kelamin" value="L" <?php if ($data['jenis_kelamin'] == 'L') {
                            echo "checked";
                        } ?>> <label for="laki-laki"
                            class="radio-label">Laki-Laki</label>
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="P" <?php if ($data['jenis_kelamin'] == 'P') {
                            echo "checked";
                        } ?>> <label for="perempuan"
                            class="radio-label">Perempuan</label>
                    </div>
                </div>

                <div class="form-control">
                    <label>Prodi</label>
                    <select name="kd_prodi" required>
                        <option value="">
                            -- Pilih Prodi --
                        </option>
                        <?php
                        while ($p = mysqli_fetch_assoc($prodi)) {
                            ?>
                            <option value="<?php echo $p['kd_prodi']; ?>" <?php
                               if ($p['kd_prodi'] == $data['kd_prodi']) {
                                   echo "selected";
                               }
                               ?>>
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
                        <button type="submit" name="update" class="submit">UPDATE</button>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>