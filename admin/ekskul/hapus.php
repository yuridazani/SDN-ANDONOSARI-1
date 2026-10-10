<?php
session_start();
if(!isset($_GET['id']) || $_GET['id'] == '') {
    header('Location: index.php');
    exit;
}

require_once '../../koneksi.php';
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Validasi apakah ID ada di database
$check = mysqli_query($koneksi, "SELECT id FROM tbl_ekskul WHERE id = '$id'");
if(mysqli_num_rows($check) == 0) {
    $_SESSION['gagal'] = 'Data tidak ditemukan!';
    header('Location: index.php');
    exit;
}

$query = mysqli_query($koneksi, "DELETE FROM tbl_ekskul WHERE id = '$id'");
if($query){
    $_SESSION['sukses'] = 'Data Berhasil Dihapus!';
} else {
    $_SESSION['gagal'] = 'Data Gagal Dihapus! ' . mysqli_error($koneksi);
}
header('Location: index.php');
exit;