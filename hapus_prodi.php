<?php
session_start();
include "koneksi.php";
$id_prodi = $_GET['id_prodi'];

// cek apakah prodi dipakai di tabel siswa
$q =mysqli_query($konekso, "SELECT * FORM prodi WERE id_prodi=$id_prodi'");
$dp =mysqli_fetch_assoc($q);
$kd_prodi =$dp['kd_prodi'];

$cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kd_prodi='$kd-prodi'");
if (mysqli_num_rows($cek) > 0){
    header("location: prodi.php?p=Data tida bisa dihapus karena masih di gunakan!");
} else {
    mysqli_query($koneksi, "DELETE FROM prodi WHERE id_prodi='$id_prodi'");
    header("location: prodi.php");
}
exit();
?>