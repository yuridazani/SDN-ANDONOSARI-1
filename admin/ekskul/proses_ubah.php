<?php
session_start();
require_once '../../koneksi.php';

if(isset($_POST['ubah'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_ekskul = mysqli_real_escape_string($koneksi, $_POST['nama_ekskul']);
    
    // Validasi apakah ID ada di database
    $check = mysqli_query($koneksi, "SELECT id FROM tbl_ekskul WHERE id = '$id'");
    if(mysqli_num_rows($check) == 0) {
        $_SESSION['gagal'] = 'Data tidak ditemukan!';
        header('Location: index.php');
        exit;
    }

    $query = mysqli_query($koneksi, "UPDATE tbl_ekskul SET nama_ekskul = '$nama_ekskul' WHERE id = '$id'");
    
    if($query) {
        $_SESSION['sukses'] = 'Data Berhasil Diubah!';
        header('Location: index.php');
    } else {
        $_SESSION['gagal'] = 'Data Gagal Diubah! ' . mysqli_error($koneksi);
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
exit;