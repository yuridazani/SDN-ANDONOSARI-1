<?php
if(!isset($_POST['ubah'])) header('Location: ubah.php');

require_once '../../koneksi.php';
$nama = mysqli_real_escape_string($koneksi, isset($_POST['nama']) ? $_POST['nama'] : '');
$nip = mysqli_real_escape_string($koneksi, isset($_POST['nip']) ? $_POST['nip'] : '');
$jabatan = mysqli_real_escape_string($koneksi, isset($_POST['jabatan']) ? $_POST['jabatan'] : '');
$id = $_GET['id'];

if($_FILES['foto']['error'] == 0){
    $ekstensi = $_FILES['foto']['name'];
    $ekstensi = pathinfo($ekstensi, PATHINFO_EXTENSION);

    $nama_foto = strtolower($nama);
    $nama_foto = str_replace(' ', '-', $nama_foto) . '.' . $ekstensi;

    $asal = $_FILES['foto']['tmp_name'];
    
    if($_FILES['foto']['size'] < 1000000){
        if (file_exists('../../images/guru/' . $nama_foto)) unlink('../../images/guru/' . $nama_foto);
        move_uploaded_file($asal, '../../images/guru/' . $nama_foto) or die('gagal upload foto');

        $query = mysqli_query($koneksi, "UPDATE tbl_guru SET nama = '$nama', nip = '$nip', jabatan = '$jabatan', foto = '$nama_foto' WHERE id = $id") or die(mysqli_error($koneksi));
        if($query){
            $_SESSION['sukses'] = 'Data Berhasil Diubah!';
            header('Location: index.php');
        } else {
            $_SESSION['gagal'] = 'Data Gagal Diubah!';
            header('Location: index.php');
        }
    } else {
        $_SESSION['gagal'] = 'ukuran gambar tidak boleh lebih dari 1000kb!';
        header('Location: index.php');
    }
} else {
    $query = mysqli_query($koneksi, "UPDATE tbl_guru SET nama = '$nama', nip = '$nip', jabatan = '$jabatan' WHERE id = $id") or die(mysqli_error($koneksi));
    if($query){
        $_SESSION['sukses'] = 'Data Berhasil Diubah!';
        header('Location: index.php');
    } else {
        $_SESSION['gagal'] = 'Data Gagal Diubah!';
        header('Location: index.php');
    }
}
?>