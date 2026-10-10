<!-- admin/statistik/hapus.php -->
<?php
require_once '../../koneksi.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM statistik_siswa WHERE id = $id");

if($query) {
    $_SESSION['sukses'] = "Data Berhasil Dihapus!";
    header('Location: index.php');
} else {
    $_SESSION['gagal'] = "Data Gagal Dihapus!";
    header('Location: index.php');
}