<?php 
require_once '../../koneksi.php';

if(!isset($_GET['id']) || $_GET['id'] == '') header('Location: index.php');

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_program_unggulan WHERE id = $id");
$program = mysqli_fetch_assoc($query);

if(!$program) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ubah Program Unggulan - SDN Andnosari 1</title>
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
                                Ubah Program Unggulan
                            </div>
                            <div class="float-right">
                                <a href="index.php">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="proses_ubah.php?id=<?= $program['id'] ?>">
                            <div class="form-group">
                                <label for="nama_program">Nama Program</label>
                                <input type="text" class="form-control" id="nama_program" name="nama_program" required="required" placeholder="Nama Program" autocomplete="off" value="<?= $program['nama_program'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Program</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required="required" placeholder="Deskripsi Program"><?= $program['deskripsi'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon (Font Awesome Class)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">fa-</span>
                                    </div>
                                    <input type="text" class="form-control" id="icon" name="icon" required="required" placeholder="Contoh: star, book, graduation-cap" value="<?= str_replace('fa-', '', $program['icon']) ?>">
                                </div>
                                <small class="form-text text-muted">
                                    Pilih icon dari <a href="https://fontawesome.com/icons" target="_blank">Font Awesome</a>. 
                                    Tulis nama icon tanpa awalan "fa-"
                                </small>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">
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