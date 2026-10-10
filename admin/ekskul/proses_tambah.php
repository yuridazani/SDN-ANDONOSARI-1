<?php
session_start();
require_once '../../koneksi.php';

if(isset($_POST['tambah'])) {
    $nama_ekskul = mysqli_real_escape_string($koneksi, $_POST['nama_ekskul']);
    
    // Validasi input kosong
    if(empty($nama_ekskul)) {
        $_SESSION['gagal'] = 'Nama ekskul tidak boleh kosong!';
        header('Location: tambah.php');
        exit;
    }
    
    // Cek apakah nama ekskul sudah ada
    $check = mysqli_query($koneksi, "SELECT nama_ekskul FROM tbl_ekskul WHERE nama_ekskul = '$nama_ekskul'");
    if(mysqli_num_rows($check) > 0) {
        $_SESSION['gagal'] = 'Nama ekskul sudah ada!';
        header('Location: tambah.php');
        exit;
    }
    
    // Proses insert data
    $query = mysqli_query($koneksi, "INSERT INTO tbl_ekskul (nama_ekskul) VALUES ('$nama_ekskul')");
    
    if($query) {
        $_SESSION['sukses'] = 'Data Berhasil Ditambahkan!';
        header('Location: index.php');
    } else {
        $_SESSION['gagal'] = 'Data Gagal Ditambahkan! ' . mysqli_error($koneksi);
        header('Location: tambah.php');
    }
} else {
    header('Location: tambah.php');
}
exit;