<?php 
require_once '../../koneksi.php';

if(isset($_POST['tambah'])) {
    $nama_program = $_POST['nama_program'];
    $deskripsi = $_POST['deskripsi'];
    $icon = $_POST['icon'];

    $query = mysqli_query($koneksi, "INSERT INTO tbl_program_unggulan (nama_program, deskripsi, icon) VALUES ('$nama_program', '$deskripsi', '$icon')");

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
    <title>Tambah Program Unggulan - SDN Andonosari 1</title>
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                                Tambah Program Unggulan
                            </div>
                            <div class="float-right">
                                <a href="index.php">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="nama_program">Nama Program</label>
                                <input type="text" class="form-control" id="nama_program" name="nama_program" required="required" placeholder="Nama Program" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Program</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required="required" placeholder="Deskripsi Program"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon (Font Awesome Class)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">fa-</span>
                                    </div>
                                    <input type="text" class="form-control" id="icon" name="icon" required="required" placeholder="Contoh: star, book, graduation-cap" value="star">
                                </div>
                                <small class="form-text text-muted">
                                    Pilih icon dari <a href="https://fontawesome.com/icons" target="_blank">Font Awesome</a>. 
                                    Tulis nama icon tanpa awalan "fa-"
                                </small>
                            </div>
                            <div class="form-group">
                            <button type="submit" name="tambah" class="btn btn-primary btn-sm">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times"></i> Batal
                                </button>
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