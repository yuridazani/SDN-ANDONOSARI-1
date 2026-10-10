<?php 
session_start(); // Mulai session

if(!isset($_POST['ubah'])) {
    header('Location: ubah.php');
    exit;
}

require_once '../../koneksi.php';

// Ambil data dari form
$id = $_POST['id'] ?? '';
$judul = mysqli_real_escape_string($koneksi, $_POST['judul'] ?? '');
$id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori'] ?? '');
$isi = mysqli_real_escape_string($koneksi, $_POST['isi'] ?? '');
$tanggal = date('Ymd');

// Ambil data artikel lama
$query_artikel = mysqli_query($koneksi, "SELECT foto FROM tbl_artikel WHERE id = $id");
$row = mysqli_fetch_assoc($query_artikel);
$nama_foto_lama = $row['foto'];

// Cek apakah ada file foto baru yang diunggah
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $ekstensi_diperbolehkan = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensi = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
        $_SESSION['gagal'] = 'Format file tidak valid! Hanya JPG, JPEG, PNG, dan GIF.';
        header('Location: ubah.php?id=' . $id);
        exit;
    }

    if ($_FILES['foto']['size'] > 1000000) {
        $_SESSION['gagal'] = 'Ukuran gambar tidak boleh lebih dari 1MB!';
        header('Location: ubah.php?id=' . $id);
        exit;
    }

    // Buat nama file baru berdasarkan judul dan tanggal
    $nama_foto_baru = $tanggal . '-' . strtolower(str_replace(' ', '-', $judul)) . '.' . $ekstensi;
    $asal = $_FILES['foto']['tmp_name'];
    $tujuan = '../../images/artikel/' . $nama_foto_baru;

    // Hapus foto lama jika ada
    if (!empty($nama_foto_lama) && file_exists('../../images/artikel/' . $nama_foto_lama)) {
        unlink('../../images/artikel/' . $nama_foto_lama);
    }

    // Pindahkan file yang diunggah
    if (!move_uploaded_file($asal, $tujuan)) {
        $_SESSION['gagal'] = 'Gagal mengunggah gambar!';
        header('Location: ubah.php?id=' . $id);
        exit;
    }
} else {
    // Jika tidak ada foto baru, gunakan foto lama
    $nama_foto_baru = $nama_foto_lama;
}

// Update database
$query = mysqli_query($koneksi, "UPDATE tbl_artikel SET 
    judul = '$judul', 
    id_kategori = '$id_kategori', 
    isi = '$isi', 
    foto = '$nama_foto_baru' 
    WHERE id = $id");

if ($query) {
    $_SESSION['sukses'] = 'Data Berhasil Diubah!';
} else {
    $_SESSION['gagal'] = 'Data Gagal Diubah!';
}

header('Location: index.php');
exit;
