<?php
require_once '../koneksi.php';
require_once 'cek_session.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE id = $id");
$data = mysqli_fetch_assoc($query);

$active = 'galeri';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Galeri - SDN Andonosari 1</title>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <style>
        .preview-image {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                                Edit Galeri
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($_SESSION['sukses'])) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> <?= $_SESSION['sukses'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['sukses']) ?>
                        <?php elseif(isset($_SESSION['gagal'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> <?= $_SESSION['gagal'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php unset($_SESSION['gagal']) ?>
                        <?php endif; ?>
                        
                        <form method="POST" action="proses_edit_galeri.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?>">
                            <input type="hidden" name="thumbnail_lama" value="<?= $data['thumbnail'] ?>">
                            
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <option value="classroom" <?= $data['kategori'] == 'classroom' ? 'selected' : '' ?>>Kegiatan Belajar</option>
                                    <option value="extracurricular" <?= $data['kategori'] == 'extracurricular' ? 'selected' : '' ?>>Ekstrakurikuler</option>
                                    <option value="events" <?= $data['kategori'] == 'events' ? 'selected' : '' ?>>Event Sekolah</option>
                                    <option value="videos" <?= $data['kategori'] == 'videos' ? 'selected' : '' ?>>Video</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" required value="<?= $data['judul'] ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control-file" onchange="previewImage(this)">
                                <small class="text-muted">Format: jpg, jpeg, png (Max 2MB). Biarkan kosong jika tidak ingin mengubah foto.</small>
                                <img src="../<?= $data['foto'] ?>" class="preview-image" id="imagePreview">
                            </div>
                            
                            <div class="form-group video-only" style="display: <?= $data['kategori'] == 'videos' ? 'block' : 'none' ?>">
                                <label for="thumbnail">Thumbnail Video</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file" onchange="previewThumbnail(this)">
                                <small class="text-muted">Format: jpg, jpeg, png (Max 2MB). Biarkan kosong jika tidak ingin mengubah thumbnail.</small>
                                <?php if(!empty($data['thumbnail'])): ?>
                                    <img src="../<?= $data['thumbnail'] ?>" class="preview-image" id="thumbnailPreview">
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"><?= $data['deskripsi'] ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="edit">Update</button>
                                <a href="galeri.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../resources/js/jquery.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>
    <script>
        $('#kategori').change(function() {
            if($(this).val() === 'videos') {
                $('.video-only').show();
            } else {
                $('.video-only').hide();
            }
        });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#imagePreview')
                        .attr('src', e.target.result)
                        .show();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewThumbnail(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#thumbnailPreview')
                        .attr('src', e.target.result)
                        .show();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Form validation before submit
        $('form').on('submit', function(e) {
            let isValid = true;
            
            // Clear previous validation
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            // Validate required fields
            $(this).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    $(this).after('<div class="invalid-feedback">Field ini harus diisi</div>');
                }
            });

            // Validate file size if files are selected
            const maxSize = 2 * 1024 * 1024; // 2MB
            const foto = $('#foto')[0].files[0];
            const thumbnail = $('#thumbnail')[0].files[0];

            if (foto && foto.size > maxSize) {
                isValid = false;
                $('#foto').addClass('is-invalid');
                $('#foto').after('<div class="invalid-feedback">Ukuran file tidak boleh lebih dari 2MB</div>');
            }

            if (thumbnail && thumbnail.size > maxSize) {
                isValid = false;
                $('#thumbnail').addClass('is-invalid');
                $('#thumbnail').after('<div class="invalid-feedback">Ukuran file tidak boleh lebih dari 2MB</div>');
            }

            return isValid;
        });
    </script>
</body>
</html>