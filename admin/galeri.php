<?php
require_once '../koneksi.php';
require_once 'cek_session.php';

$query_classroom = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'classroom' ORDER BY id DESC");
$query_extra = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'extracurricular' ORDER BY id DESC");
$query_events = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'events' ORDER BY id DESC");
$query_videos = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'videos' ORDER BY id DESC");

$active = 'galeri';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manajemen Galeri - SDN Andonosari 1</title>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <style>
        .preview-image {
            max-width: 150px;
            height: auto;
        }
        #imagePreview {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
$active = 'dashboard'; // sesuaikan dengan halaman yang aktif
require_once 'navbar.php';
?>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                                Manajemen Galeri
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addGalleryModal">
                                    Tambah
                                </button>
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

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#classroom">Kegiatan Belajar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#extra">Ekstrakurikuler</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#events">Event Sekolah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#videos">Video</a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content">
                            <!-- Classroom Tab -->
                            <div id="classroom" class="tab-pane active"><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Foto</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; while($classroom = mysqli_fetch_assoc($query_classroom)) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $classroom['judul'] ?></td>
                                                <td><img src="../<?= $classroom['foto'] ?>" class="preview-image"></td>
                                                <td><?= date('d F Y', strtotime($classroom['tanggal'])) ?></td>
                                                <td>
                                                    <a href="edit_galeri.php?id=<?= $classroom['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="hapus_galeri.php?id=<?= $classroom['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Extracurricular Tab -->
                            <div id="extra" class="tab-pane fade"><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Foto</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; while($extra = mysqli_fetch_assoc($query_extra)) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $extra['judul'] ?></td>
                                                <td><img src="../<?= $extra['foto'] ?>" class="preview-image"></td>
                                                <td><?= date('d F Y', strtotime($extra['tanggal'])) ?></td>
                                                <td>
                                                    <a href="edit_galeri.php?id=<?= $extra['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="hapus_galeri.php?id=<?= $extra['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Events Tab -->
                            <div id="events" class="tab-pane fade"><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Foto</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; while($event = mysqli_fetch_assoc($query_events)) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $event['judul'] ?></td>
                                                <td><img src="../<?= $event['foto'] ?>" class="preview-image"></td>
                                                <td><?= date('d F Y', strtotime($event['tanggal'])) ?></td>
                                                <td>
                                                    <a href="edit_galeri.php?id=<?= $event['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="hapus_galeri.php?id=<?= $event['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Videos Tab -->
                            <div id="videos" class="tab-pane fade"><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Video</th>
                                                <th>Thumbnail</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; while($video = mysqli_fetch_assoc($query_videos)) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $video['judul'] ?></td>
                                                <td><img src="../<?= $video['foto'] ?>" class="preview-image"></td>
                                                <td><img src="../<?= $video['thumbnail'] ?>" class="preview-image"></td>
                                                <td><?= date('d F Y', strtotime($video['tanggal'])) ?></td>
                                                <td>
                                                    <a href="edit_galeri.php?id=<?= $video['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="hapus_galeri.php?id=<?= $video['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Gallery Modal -->
    <div class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGalleryModalLabel">Tambah Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="proses_tambah_galeri.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="classroom">Kegiatan Belajar</option>
                                <option value="extracurricular">Ekstrakurikuler</option>
                                <option value="events">Event Sekolah</option>
                                <option value="videos">Video</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>
                        <!-- Form Foto -->
                        <div class="form-group photo-only">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control-file" onchange="previewImage(this)">
                            <small class="text-muted">Format: jpg, jpeg, png (Max 2MB)</small>
                            <img id="imagePreview" src="#" alt="Preview" style="display: none;">
                        </div>

                        <!-- Form Video -->
                        <div class="form-group video-only" style="display: none;">
                            <label for="video">Upload Video</label>
                            <input type="file" name="video" id="video" class="form-control-file">
                            <small class="text-muted">Format: MP4, AVI, MOV, MKV (Max 50MB)</small>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../resources/js/jquery.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>
    <script>
$(document).ready(function () {
    $('#kategori').change(function () {
        let selectedCategory = $(this).val();

        if (selectedCategory === 'videos') {
            $('.video-only').show();
            $('.photo-only').hide();
            $('#video').prop('required', true);
            $('#foto').prop('required', false);
        } else {
            $('.photo-only').show();
            $('.video-only').hide();
            $('#foto').prop('required', true);
            $('#video').prop('required', false);
        }
    });

    // Reset form and previews when modal is closed
    $('#addGalleryModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('#imagePreview').hide();
        $('.video-only').hide();
        $('.photo-only').show();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    });

    // Form validation before submit
    $('form').on('submit', function (e) {
        let isValid = true;

        // Clear previous validation
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Validate required fields
        $(this).find('[required]').each(function () {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
                $(this).after('<div class="invalid-feedback">Field ini harus diisi</div>');
            }
        });

        // Validate file size
        const maxFotoSize = 2 * 1024 * 1024; // 2MB
        const maxVideoSize = 50 * 1024 * 1024; // 50MB
        const foto = $('#foto')[0].files[0];
        const video = $('#video')[0].files[0];

        // Pastikan hanya satu jenis file yang diunggah
        if (foto && video) {
            isValid = false;
            $('#foto').addClass('is-invalid');
            $('#video').addClass('is-invalid');
            $('#foto').after('<div class="invalid-feedback">Hanya boleh mengunggah satu jenis file (Foto atau Video)</div>');
        }

        if (foto && foto.size > maxFotoSize) {
            isValid = false;
            $('#foto').addClass('is-invalid');
            $('#foto').after('<div class="invalid-feedback">Ukuran file tidak boleh lebih dari 2MB</div>');
        }

        if (video && video.size > maxVideoSize) {
            isValid = false;
            $('#video').addClass('is-invalid');
            $('#video').after('<div class="invalid-feedback">Ukuran file tidak boleh lebih dari 50MB</div>');
        }

        return isValid;
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
});

    </script>
</body>
</html>