<?php 
$active = 'artikel'; 
require_once '../../koneksi.php';

// Ambil daftar kategori dari database
$query = mysqli_query($koneksi, "SELECT * FROM tbl_kategori_artikel");

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel - SDN Andonosari 1</title>
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
                                <h5>Tambah Artikel</h5>
                            </div>
                            <div class="float-right">
                                <a href="index.php" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($_SESSION['gagal'])) : ?>
                            <div class="alert alert-danger"><?= $_SESSION['gagal']; unset($_SESSION['gagal']); ?></div>
                        <?php endif; ?>

                        <form method="POST" action="proses_tambah.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" placeholder="Judul artikel" name="judul" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="id_kategori">Kategori Artikel</label>
                                <select name="id_kategori" id="id_kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php while($kategori = mysqli_fetch_assoc($query)) : ?>
                                        <option value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control-file" id="foto" name="foto" required accept="image/*">
                            </div>
                            
                            <div class="form-group">
                                <label for="isi">Isi</label>
                                <textarea name="isi" id="ckeditor" class="ckeditor form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary" name="tambah">Tambah</button>
                                <button type="reset" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan?')">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
    <script src="../../resources/ckeditor/ckeditor.js"></script>
</body>
</html>
