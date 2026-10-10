<?php
require_once '../koneksi.php';
require_once 'cek_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $path = "../uploads/galeri/"; // Direktori penyimpanan file
    $foto_path = null;
    $video_path = null;
    $thumbnail = null;

    // Pastikan direktori ada
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    // Fungsi untuk mengunggah file
    function uploadFile($file, $allowed_types, $max_size, $path, $prefix) {
        if (!empty($file['name'])) {
            $file_name = time() . '_' . $prefix . '_' . basename($file['name']);
            $file_tmp = $file['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_size = $file['size'];

            // Validasi tipe file
            if (!in_array($file_ext, $allowed_types)) {
                return ['error' => "Format file tidak didukung! Hanya " . implode(', ', $allowed_types)];
            }

            // Validasi ukuran file
            if ($file_size > $max_size) {
                return ['error' => "Ukuran file terlalu besar! Maksimal " . ($max_size / (1024 * 1024)) . "MB"];
            }

            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($file_tmp, $path . $file_name)) {
                return ['success' => "uploads/galeri/" . $file_name];
            } else {
                return ['error' => "Gagal mengunggah file!"];
            }
        }
        return null;
    }

    // Proses unggah gambar (foto atau thumbnail)
    if (!empty($_FILES['foto']['name'])) {
        $foto_result = uploadFile($_FILES['foto'], ['jpg', 'jpeg', 'png', 'gif'], 5 * 1024 * 1024, $path, 'foto');
        if (isset($foto_result['error'])) {
            $_SESSION['gagal'] = $foto_result['error'];
            header('Location: galeri.php');
            exit();
        }
        $foto_path = $foto_result['success'];
    }

    // Jika kategori video, proses unggah video dan thumbnail
    if ($kategori === 'videos') {
        // Proses unggah thumbnail
        if (!empty($_FILES['thumbnail']['name'])) {
            $thumb_result = uploadFile($_FILES['thumbnail'], ['jpg', 'jpeg', 'png'], 2 * 1024 * 1024, $path, 'thumb');
            if (isset($thumb_result['error'])) {
                $_SESSION['gagal'] = $thumb_result['error'];
                header('Location: galeri.php');
                exit();
            }
            $thumbnail = $thumb_result['success'];
        }

        // Proses unggah video
        if (!empty($_FILES['video']['name'])) {
            $video_result = uploadFile($_FILES['video'], ['mp4', 'avi', 'mov', 'mkv'], 50 * 1024 * 1024, $path, 'video');
            if (isset($video_result['error'])) {
                $_SESSION['gagal'] = $video_result['error'];
                header('Location: galeri.php');
                exit();
            }
            $video_path = $video_result['success'];
        } else {
            $_SESSION['gagal'] = "Harap unggah video!";
            header('Location: galeri.php');
            exit();
        }
    }

    // Simpan data ke database dengan prepared statement
    $stmt = $koneksi->prepare("INSERT INTO tbl_galeri (kategori, judul, foto, video, thumbnail, deskripsi) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $kategori, $judul, $foto_path, $video_path, $thumbnail, $deskripsi);

    if ($stmt->execute()) {
        $_SESSION['sukses'] = "Data berhasil ditambahkan!";
    } else {
        $_SESSION['gagal'] = "Data gagal ditambahkan! Error: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();

    header('Location: galeri.php');
    exit();
} else {
    header('Location: galeri.php');
    exit();
}
