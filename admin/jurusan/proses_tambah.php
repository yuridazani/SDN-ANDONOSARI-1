<?php 
if(!isset($_POST['tambah'])) header('Location: tambah.php');

require_once '../../koneksi.php';
$nama_program = mysqli_real_escape_string($koneksi, isset($_POST['nama_program']) ? $_POST['nama_program'] : '');
$deskripsi = mysqli_real_escape_string($koneksi, isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '');
$icon = mysqli_real_escape_string($koneksi, isset($_POST['icon']) ? $_POST['icon'] : 'fa-star');

$query = mysqli_query($koneksi, "INSERT INTO tbl_program_unggulan (nama_program, deskripsi, icon) VALUES ('$nama_program', '$deskripsi', '$icon')");
if($query){
    $_SESSION['sukses'] = 'Data Berhasil Ditambahkan!';
    header('Location: index.php');
} else {
    $_SESSION['gagal'] = 'Data Gagal Ditambahkan!';
    header('Location: index.php');
}