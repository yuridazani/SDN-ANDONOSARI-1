<!-- admin/statistik/tambah.php -->
<?php
require_once '../../koneksi.php';

if(isset($_POST['submit'])) {
    $tahun = $_POST['tahun'];
    $kelas = $_POST['kelas'];
    $jumlah_laki = $_POST['jumlah_laki'];
    $jumlah_perempuan = $_POST['jumlah_perempuan'];
    $total_siswa = $jumlah_laki + $jumlah_perempuan;

    $query = mysqli_query($koneksi, "INSERT INTO statistik_siswa (tahun, kelas, jumlah_laki, jumlah_perempuan, total_siswa) VALUES ('$tahun', '$kelas', '$jumlah_laki', '$jumlah_perempuan', '$total_siswa')");

    if($query) {
        $_SESSION['sukses'] = "Data Berhasil Ditambahkan!";
        header('Location: index.php');
    } else {
        $_SESSION['gagal'] = "Data Gagal Ditambahkan!";
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tambah Statistik Siswa - SMK Negeri 1 Wanareja</title>
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
                                Tambah Statistik Siswa
                            </div>
                            <div class="float-right">
                                <a href="index.php">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="tambah.php">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" required min="2000" max="2099" step="1" value="<?= date('Y') ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="I" >Kelas I</option>
                                    <option value="II">Kelas II</option>
                                    <option value="III">Kelas III</option>
                                    <option value="IV">Kelas IV</option>
                                    <option value="V">Kelas V</option>
                                    <option value="VI">Kelas VI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_laki">Jumlah Siswa Laki-laki</label>
                                <input type="number" class="form-control" id="jumlah_laki" name="jumlah_laki" required min="0">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_perempuan">Jumlah Siswa Perempuan</label>
                                <input type="number" class="form-control" id="jumlah_perempuan" name="jumlah_perempuan" required min="0">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
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