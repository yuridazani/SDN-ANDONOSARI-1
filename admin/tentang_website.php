<?php 
require_once '../koneksi.php';
require_once 'cek_session.php';

// Fetch website data
$query = mysqli_query($koneksi, "SELECT * FROM tbl_tentang_website WHERE id = 1");
if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}

$tentang_kami = mysqli_fetch_assoc($query);
$active = 'tentang_kami'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tentang Kami - SDN Andonosari 1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
<?php
$active = 'dashboard'; // sesuaikan dengan halaman yang aktif
require_once 'navbar.php';
?>
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Tentang Kami</span>
                        <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="proses_tentang_website.php" enctype="multipart/form-data" id="tentangForm">
                            <!-- Profil Sekolah -->
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control" value="<?= htmlspecialchars($tentang_kami['nama_sekolah'] ?? '') ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">NPSN</label>
                                <input type="text" name="npsn" class="form-control" value="<?= htmlspecialchars($tentang_kami['npsn'] ?? '') ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Tanggal SK Pendirian</label>
                                <input type="date" name="sk_pendirian" class="form-control" value="<?= htmlspecialchars($tentang_kami['sk_pendirian'] ?? '') ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Status Kepemilikan</label>
                                <select name="status_kepemilikan" class="form-control">
                                    <option value="Negeri" <?= ($tentang_kami['status_kepemilikan'] ?? '') == 'Negeri' ? 'selected' : '' ?>>Negeri</option>
                                    <option value="Swasta" <?= ($tentang_kami['status_kepemilikan'] ?? '') == 'Swasta' ? 'selected' : '' ?>>Swasta</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Tanggal SK Izin Operasional</label>
                                <input type="date" name="sk_operasional" class="form-control" value="<?= htmlspecialchars($tentang_kami['sk_operasional'] ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                    <label class="form-label">Prasarana Sekolah</label>
                                    <div id="prasarana-container">
                                        <?php 
                                        if(!empty($tentang_kami['prasarana'])) {
                                            $prasarana = json_decode($tentang_kami['prasarana'], true);
                                            foreach($prasarana as $item) {
                                        ?>
                                        <div class="prasarana-item mb-2">
                                            <div class="input-group">
                                                <input type="text" name="prasarana_nama[]" class="form-control" placeholder="Nama Prasarana" value="<?= htmlspecialchars($item['nama']) ?>">
                                                <input type="text" name="prasarana_detail[]" class="form-control" placeholder="Detail/Jumlah" value="<?= htmlspecialchars($item['detail']) ?>">
                                                <button type="button" class="btn btn-danger remove-prasarana">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-prasarana">
                                        <i class="fas fa-plus"></i> Tambah Prasarana
                                    </button>
                                </div>


                             <!-- Visi & Misi -->
                            <div class="form-group mb-3">
                                <label class="form-label">Visi</label>
                                <textarea name="visi" class="editor form-control"><?= htmlspecialchars(str_replace("\r\n", "\n", $tentang_kami['visi'] ?? '')) ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Misi</label>
                                <textarea name="misi" class="editor form-control"><?= htmlspecialchars(str_replace("\r\n", "\n", $tentang_kami['misi'] ?? '')) ?></textarea>

                            </div>

                            <!-- Organization Structure -->
                            <div class="form-group mb-3">
                                <label class="form-label">Struktur Organisasi</label>
                                <input type="file" name="struktur_organisasi" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Upload gambar bagan struktur organisasi sekolah</small>
                                <?php if(!empty($tentang_kami['guru_staf'])): ?>
                                    <div class="mt-2">
                                        <small>Struktur Organisasi saat ini:</small><br>
                                        <img src="<?= htmlspecialchars($tentang_kami['guru_staf']) ?>" class="img-fluid mt-2" alt="Struktur Organisasi">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Academic Achievements -->
                            <div class="form-group mb-3">
                                <label class="form-label">Prestasi Akademik</label>
                                <div id="prestasi-akademik-container">
                                    <?php 
                                    if(!empty($tentang_kami['prestasi_akademik'])) {
                                        $prestasi_akademik = explode("\n", $tentang_kami['prestasi_akademik']);
                                        foreach($prestasi_akademik as $prestasi) {
                                            if(!empty(trim($prestasi))):
                                    ?>
                                    <div class="prestasi-item mb-2">
                                        <div class="input-group">
                                            <input type="text" name="prestasi_akademik[]" class="form-control" value="<?= htmlspecialchars(trim($prestasi)) ?>">
                                            <button type="button" class="btn btn-danger remove-prestasi" title="Hapus prestasi">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php 
                                            endif;
                                        }
                                    }
                                    ?>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-prestasi-akademik">
                                    <i class="fas fa-plus"></i> Tambah Prestasi Akademik
                                </button>
                            </div>

                            <!-- Non-Academic Achievements -->
                            <div class="form-group mb-3">
                                <label class="form-label">Prestasi Non-Akademik</label>
                                <div id="prestasi-non-akademik-container">
                                    <?php 
                                    if(!empty($tentang_kami['prestasi_non_akademik'])) {
                                        $prestasi_non_akademik = explode("\n", $tentang_kami['prestasi_non_akademik']);
                                        foreach($prestasi_non_akademik as $prestasi) {
                                            if(!empty(trim($prestasi))):
                                    ?>
                                    <div class="prestasi-item mb-2">
                                        <div class="input-group">
                                            <input type="text" name="prestasi_non_akademik[]" class="form-control" value="<?= htmlspecialchars(trim($prestasi)) ?>">
                                            <button type="button" class="btn btn-danger remove-prestasi" title="Hapus prestasi">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php 
                                            endif;
                                        }
                                    }
                                    ?>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-prestasi-non-akademik">
                                    <i class="fas fa-plus"></i> Tambah Prestasi Non-Akademik
                                </button>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary" name="ubah">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-danger ms-2">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
            document.addEventListener("DOMContentLoaded", function() {
        // Add prasarana item
        function createPrasaranaInput() {
            return `
                <div class="prasarana-item mb-2">
                    <div class="input-group">
                        <input type="text" name="prasarana_nama[]" class="form-control" placeholder="Nama Prasarana">
                        <input type="text" name="prasarana_detail[]" class="form-control" placeholder="Detail/Jumlah">
                        <button type="button" class="btn btn-danger remove-prasarana">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            `;
        }

        document.getElementById('add-prasarana').addEventListener('click', function() {
            const container = document.getElementById('prasarana-container');
            container.insertAdjacentHTML('beforeend', createPrasaranaInput());
        });

        // Remove prasarana
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-prasarana')) {
                e.target.closest('.prasarana-item').remove();
            }
        });

        // Existing JavaScript remains the same
        // Initialize CKEditor
        document.querySelectorAll('.editor').forEach(editor => {
            ClassicEditor
                .create(editor)
                .catch(error => {
                    console.error(error);
                });
        });
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        // Function to create new achievement input
        function createAchievementInput(type) {
            return `
                <div class="prestasi-item mb-2">
                    <div class="input-group">
                        <input type="text" name="prestasi_${type}[]" class="form-control" placeholder="Masukkan prestasi ${type === 'akademik' ? 'akademik' : 'non-akademik'}">
                        <button type="button" class="btn btn-danger remove-prestasi" title="Hapus prestasi">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            `;
        }

        // Add academic achievement
        document.getElementById('add-prestasi-akademik').addEventListener('click', function() {
            const container = document.getElementById('prestasi-akademik-container');
            container.insertAdjacentHTML('beforeend', createAchievementInput('akademik'));
        });

        // Add non-academic achievement
        document.getElementById('add-prestasi-non-akademik').addEventListener('click', function() {
            const container = document.getElementById('prestasi-non-akademik-container');
            container.insertAdjacentHTML('beforeend', createAchievementInput('non_akademik'));
        });

        // Remove achievement
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-prestasi')) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Prestasi ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.closest('.prestasi-item').remove();
                    }
                });
            }
        });

        // Form submission
        document.getElementById('tentangForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data akan disimpan ke database',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(this);
                    
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch('proses_tentang_website.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: error.message || 'Terjadi kesalahan saat menyimpan data'
                        });
                    });
                }
            });
        });

        // Initialize CKEditor for rich text fields
        document.querySelectorAll('.editor').forEach(editor => {
            ClassicEditor
                .create(editor)
                .catch(error => {
                    console.error(error);
                });
        });

        ClassicEditor.create(document.querySelector('.editor'), {
            removePlugins: ['PasteFromOffice'], // Hindari format aneh dari copy-paste
            enterMode: 'BR', // Buat enter jadi <br> bukan <p>
            shiftEnterMode: 'P' // Shift + Enter jadi <p>
        }).catch(error => console.error(error));

    });
    </script>
</body>
</html>