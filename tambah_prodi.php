<?php
session_start();
include "koneksi.php";
$error ="";

//proses simpan
if (isset($_POST['simpan'])) {
    $kd_prodi =$_POST['kd_prodi'];
    $nama_prodi =$_POST['nama_prodi'];

    //validasi tidak boleh kosong
    if (empty($kd_prodi)|| empty($nama_prodi)){
        $error ="Semua data harus diisi!";
    } else {
        // cek kode prodi
        $cek=mysqli_query($koneksi, "SELECT * FROM prodi WHERE kd_prodi='$kd_prodi'");

        if (mysqli_num_rows($cek)> 0) {
            $error="Kode prodi sudah di gunakan!";
        } else {
            mysqli_query($koneksi, "INSERT INTO prodi VALUES (NULL,'$kd_prodi,'$nama_prodi')");
            header("location: prodi.php?success=tambah");
        }
    }
    }
?>

<!--- Menampilkan pesan validasi -->
<?php
if ($error !=""){
    echo "<p style='color:red;'>$error</p>";
}
?>

    <label>Kode Prodi</label><br>
    <input type="text" name="kd_prodi" required><br><br>
    <label>Nama prodi</label><br>
    <input type="text" name="nama_prodi" required><br><br>
    <button type="submit" name="simpan" class="submit">SIMPAN</button>
    <a href="prodi.php" class="batal">BATAL</a>
</form>


