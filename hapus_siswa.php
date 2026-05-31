<?php
session_start();
include "koneksi.php";
$id =$_GET['id'];

// cek apakah data ada
$cek =mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$data =mysqli_fetch_assoc($cek);

if(!$data) {
    header("location: siswa.php?p=Data tidak di temukan!");
    exit();
}

//proses hapus
$hapus =mysqli_query($koneksi, "DELETE FROM siswa WHERE id='$id'");
if($hapus) {
    header("location: siswa.php?p=Data berhasil dihapus!");
    exit();
} else {
    header ("location: siswa.php?p=Gagal menghapus data!");
    exit();
}
?>