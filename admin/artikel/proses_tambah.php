<?php 
session_start(); // Mulai session

if(!isset($_POST['tambah'])) {
    header('Location: tambah.php');
    exit;
}

require_once '../../koneksi.php';

// Ambil data dari form
$judul = mysqli_real_escape_string($koneksi, $_POST['judul'] ?? '');
$id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori'] ?? '');
$isi = mysqli_real_escape_string($koneksi, $_POST['isi'] ?? '');
$tanggal = date('Ymd');

// Periksa apakah file diunggah
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== 0) {
    $_SESSION['gagal'] = 'Terjadi kesalahan saat mengunggah file!';
    header('Location: tambah.php');
    exit;
}

// Proses Upload Foto
$ekstensi_diperbolehkan = ['jpg', 'jpeg', 'png', 'gif'];
$ekstensi = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
    $_SESSION['gagal'] = 'Format file tidak valid! Hanya JPG, JPEG, PNG, dan GIF.';
    header('Location: tambah.php');
    exit;
}

// Buat nama file unik
$nama_foto = $tanggal . '-' . strtolower(str_replace(' ', '-', $judul)) . '.' . $ekstensi;
$asal = $_FILES['foto']['tmp_name'];
$tujuan = dirname(__DIR__, 2) . '/images/artikel/' . $nama_foto;

// Periksa ukuran file (max 1MB)
if ($_FILES['foto']['size'] > 1000000) {
    $_SESSION['gagal'] = 'Ukuran gambar tidak boleh lebih dari 1MB!';
    header('Location: tambah.php');
    exit;
}

// Simpan ke database sebelum memindahkan file
$query = mysqli_query($koneksi, "INSERT INTO tbl_artikel (judul, isi, tanggal, foto, id_kategori) 
VALUES ('$judul', '$isi', '$tanggal', '$nama_foto', '$id_kategori')");

if ($query) {
    if (move_uploaded_file($asal, $tujuan)) {
        $_SESSION['sukses'] = 'Data Berhasil Ditambahkan!';
    } else {
        $_SESSION['gagal'] = 'Gagal menyimpan gambar ke folder!';
    }
} else {
    $_SESSION['gagal'] = 'Data Gagal Ditambahkan ke database!';
}

header('Location: index.php');
exit;
