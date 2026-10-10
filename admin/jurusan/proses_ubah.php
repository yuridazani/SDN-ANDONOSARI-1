<?php 
if(!isset($_GET['id']) || $_GET['id'] == '') header('Location: index.php');

require_once '../../koneksi.php';
$id = $_GET['id'];
$nama_program = mysqli_real_escape_string($koneksi, $_POST['nama_program']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$icon = mysqli_real_escape_string($koneksi, $_POST['icon']);

$query = mysqli_query($koneksi, "UPDATE tbl_program_unggulan SET nama_program = '$nama_program', deskripsi = '$deskripsi', icon = '$icon' WHERE id = $id");
if($query){
    $_SESSION['sukses'] = 'Data Berhasil Diubah!';
    header('Location: index.php');
} else {
    $_SESSION['gagal'] = 'Data Gagal Diubah!';
    header('Location: index.php');
}