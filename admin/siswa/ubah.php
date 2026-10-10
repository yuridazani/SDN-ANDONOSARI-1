<!-- admin/statistik/ubah.php -->
<?php
require_once '../../koneksi.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM statistik_siswa WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['submit'])) {
    $tahun = $_POST['tahun'];
    $kelas = $_POST['kelas'];
    $jumlah_laki = $_POST['jumlah_laki'];
    $jumlah_perempuan = $_POST['jumlah_perempuan'];
    $total_siswa = $jumlah_laki + $jumlah_perempuan;

    $query = mysqli_query($koneksi, "UPDATE statistik_siswa SET tahun = '$tahun', kelas = '$kelas', jumlah_laki = '$jumlah_laki', jumlah_perempuan = '$jumlah_perempuan', total_siswa = '$total_siswa' WHERE id = $id");

    if($query) {
        $_SESSION['sukses'] = "Data Berhasil Diubah!";
        header('Location: index.php');
    } else {
        $_SESSION['gagal'] = "Data Gagal Diubah!";
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ubah Statistik Siswa - SMK Negeri 1 Wanareja</title>
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
</head>
<body>
    <?php require_once '../navbar.php'; ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                                Ubah Statistik Siswa
                            </div>
                            <div class="float-right">
                                <a href="index.php">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="ubah.php?id=<?= $id ?>">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" required min="2000" max="2099" step="1" value="<?= $data['tahun'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="I" <?= $data['kelas'] == 'I' ? 'selected' : '' ?>>Kelas I</option>
                                    <option value="II" <?= $data['kelas'] == 'II' ? 'selected' : '' ?>>Kelas II</option>
                                    <option value="III" <?= $data['kelas'] == 'III' ? 'selected' : '' ?>>Kelas III</option>
                                    <option value="IV" <?= $data['kelas'] == 'IV' ? 'selected' : '' ?>>Kelas IV</option>
                                    <option value="V" <?= $data['kelas'] == 'V' ? 'selected' : '' ?>>Kelas V</option>
                                    <option value="VI" <?= $data['kelas'] == 'V' ? 'selected' : '' ?>>Kelas VI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_laki">Jumlah Siswa Laki-laki</label>
                                <input type="number" class="form-control" id="jumlah_laki" name="jumlah_laki" required min="0" value="<?= $data['jumlah_laki'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_perempuan">Jumlah Siswa Perempuan</label>
                                <input type="number" class="form-control" id="jumlah_perempuan" name="jumlah_perempuan" required min="0" value="<?= $data['jumlah_perempuan'] ?>">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
</body>
</html>