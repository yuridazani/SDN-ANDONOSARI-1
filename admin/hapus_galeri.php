<?php
require_once '../koneksi.php';
require_once 'cek_session.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get file information before deleting
    $query = mysqli_query($koneksi, "SELECT foto, thumbnail, kategori FROM tbl_galeri WHERE id = $id");
    $data = mysqli_fetch_assoc($query);
    
    // Delete files from server
    if(file_exists('../' . $data['foto'])) {
        unlink('../' . $data['foto']);
    }
    
    if($data['kategori'] == 'videos' && !empty($data['thumbnail'])) {
        if(file_exists('../' . $data['thumbnail'])) {
            unlink('../' . $data['thumbnail']);
        }
    }
    
    // Delete record from database
    $delete = mysqli_query($koneksi, "DELETE FROM tbl_galeri WHERE id = $id");
    
    if($delete) {
        $_SESSION['sukses'] = 'Data berhasil dihapus!';
    } else {
        $_SESSION['gagal'] = 'Data gagal dihapus!';
    }
}

header('Location: galeri.php');
exit();