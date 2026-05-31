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
        mysqli_query($koneksi, "INSERT INTO siswa
        (nis,nama,kelas,tahun_ajaran,kd_prodi,jenis_kelamin)
        VALUES ('$nis','$nama','$kelas','$tahun_ajaran','$kd_prodi','$jk')");
        header("location: siswa.php");
        exit();
    }
}
?>
<form method="POST">
    <table>
        <tr>
            <td>NIS</td>
            <td><input type="text" name="nis" required></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td><input type="text" name="kelas"></td>
        </tr>
        <tr>
            <td>Tahun Ajaran</td>
            <td><input type="text" name="tahun_ajaran"></td>
        </tr>
        <tr>
            <td>Prodi</td>
            <td>
                <select name="kd_prodi" required>
                    <?php while ($p = mysqli_fetch_assoc($prodi)) { ?>
                        <option value="<?php echo $p['kd_prodi']; ?>">
                            <?php echo $p['nama_prodi']; ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="simpan" class="submit">SUBMIT</button>
                <a href="siswa.php" class="batal">BATAL</a>
            </td>
        </tr>
    </table>