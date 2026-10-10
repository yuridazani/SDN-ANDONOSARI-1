<?php 
session_start();
if(!isset($_GET['id']) || $_GET['id'] == '') {
    header('Location: index.php');
    exit;
}

require_once '../../koneksi.php';
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE id = '$id'");

if(mysqli_num_rows($query) == 0) {
    $_SESSION['gagal'] = 'Data tidak ditemukan!';
    header('Location: index.php');
    exit;
}

$ekskul = mysqli_fetch_assoc($query);
$active = 'master';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ubah Ekstrakurikuler - SDN Andonosari 1</title>
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
                                Ubah Ekstrakurikuler
                            </div>
                            <div class="float-right">
                                <a href="index.php">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="proses_ubah.php">
                            <input type="hidden" name="id" value="<?= $ekskul['id'] ?>">
                            <div class="form-group">
                                <label for="nama_ekskul">Nama Ekstrakurikuler</label>
                                <input type="text" value="<?= htmlspecialchars($ekskul['nama_ekskul']) ?>" class="form-control" id="nama_ekskul" placeholder="Nama Ekstrakurikuler" autocomplete="off" required="required" name="nama_ekskul">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary" name="ubah">Ubah</button>
                                <button type="reset" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')">Batal</button>
                                <a href="index.php" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
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