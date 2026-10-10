<?php
require_once '../koneksi.php';
require_once 'cek_session.php';

if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $foto_lama = $_POST['foto_lama'];
    $thumbnail_lama = $_POST['thumbnail_lama'];
    $tanggal = date('Y-m-d');
    
    // Handle foto upload
    if(!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
        $foto_name = uniqid() . '.' . $foto_ext;
        $foto_path = 'uploads/' . $foto_name;
        
        // Validate file type
        $allowed = ['jpg', 'jpeg', 'png'];
        if(!in_array($foto_ext, $allowed)) {
            $_SESSION['gagal'] = 'Format file foto tidak didukung!';
            header('Location: edit_galeri.php?id=' . $id);
            exit();
        }
        
        // Move uploaded file
        if(move_uploaded_file($foto_tmp, '../' . $foto_path)) {
            // Delete old file
            if(file_exists('../' . $foto_lama)) {
                unlink('../' . $foto_lama);
            }
        } else {
            $_SESSION['gagal'] = 'Gagal upload foto!';
            header('Location: edit_galeri.php?id=' . $id);
            exit();
        }
    } else {
        $foto_path = $foto_lama;
    }
    
    // Handle thumbnail upload for videos
    $thumbnail_path = $thumbnail_lama;
    if($kategori == 'videos' && !empty($_FILES['thumbnail']['name'])) {
        $thumbnail = $_FILES['thumbnail']['name'];
        $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_ext = strtolower(pathinfo($thumbnail, PATHINFO_EXTENSION));
        $thumbnail_name = uniqid() . '_thumb.' . $thumbnail_ext;
        $thumbnail_path = 'uploads/' . $thumbnail_name;
        
        // Validate file type
        $allowed = ['jpg', 'jpeg', 'png'];
        if(!in_array($thumbnail_ext, $allowed)) {
            $_SESSION['gagal'] = 'Format file thumbnail tidak didukung!';
            header('Location: edit_galeri.php?id=' . $id);
            exit();
        }
        
        // Move uploaded file
        if(move_uploaded_file($thumbnail_tmp, '../' . $thumbnail_path)) {
            // Delete old file
            if(!empty($thumbnail_lama) && file_exists('../' . $thumbnail_lama)) {
                unlink('../' . $thumbnail_lama);
            }
        } else {
            $_SESSION['gagal'] = 'Gagal upload thumbnail!';
            header('Location: edit_galeri.php?id=' . $id);
            exit();
        }
    }
    
    // Update database
    $query = mysqli_query($koneksi, "UPDATE tbl_galeri SET 
        kategori = '$kategori',
        judul = '$judul',
        foto = '$foto_path',
        thumbnail = '$thumbnail_path',
        deskripsi = '$deskripsi',
        tanggal = '$tanggal'
        WHERE id = $id");
    
    if($query) {
        $_SESSION['sukses'] = 'Data berhasil diupdate!';
        header('Location: galeri.php');
        exit();
    } else {
        $_SESSION['gagal'] = 'Data gagal diupdate!';
        header('Location: edit_galeri.php?id=' . $id);
        exit();
    }
}

header('Location: galeri.php');
exit();