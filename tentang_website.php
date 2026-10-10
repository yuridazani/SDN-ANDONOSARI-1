<?php 
require_once 'koneksi.php';

// Tambahkan ini di awal file
ini_set('memory_limit', '256M');
set_time_limit(60);

// Ambil data tentang website
$query = mysqli_query($koneksi, "SELECT * FROM tbl_tentang_website WHERE id = 1");
if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}

$tentang_website = mysqli_fetch_assoc($query);
if (!$tentang_website) {
    die("Data tidak ditemukan.");
}

// Konversi BLOB ke format gambar - letakkan ini di bagian atas file
$struktur_organisasi_img = '';
if (!empty($tentang_website['struktur_organisasi'])) {
    $struktur_organisasi_img = 'data:image/*;base64,' . base64_encode($tentang_website['struktur_organisasi']);
}

$aktif = 'tentang_kami'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/fonts/stylesheet.css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <style>
        .about-section {
            padding: 2rem 0;
        }
        .section-title {
            position: relative;
            color: #011638;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            font-size: 2.2rem;
            font-weight: 600;
        }
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background: #011638;
        }
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .content-card:hover {
            transform: translateY(-5px);
        }
        .content-card h3 {
            color: #011638;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-left: 1rem;
            border-left: 4px solid #011638;
        }
        .vision-box, .mission-box {
            background: #011638;
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        .profile-info {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        .profile-info dt {
            color: #011638;
            font-weight: 600;
        }
        .prasarana-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }
        .prasarana-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #011638;
        }
        .achievement-card {
            background: linear-gradient(45deg, #011638, #023373);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: visible; /* Penting! */
        }

        .struktur-organisasi {
            width: 100%;
            overflow: visible;
        }

        .struktur-organisasi img {
            display: block;
            width: 100%;
            height: auto;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container bg-light px-0">
        <!-- Top Bar -->
        <div class="logo clearfix">
            <div class="float-left mt-3 mb-3">
                <img src="resources/images/logo.png" alt="Logo Sekolah" width="70px" class="float-left mr-3">
                <div class="text float-right">
                    <span class="smk">SDN Andonosari 1</span><br>
                    <span class="visi">Jl. Tutur, Siwil, Andono Sari, Kec. Tutur, Pasuruan, Jawa Timur 67165</span>
                </div>
            </div>
        </div>
        
        <!-- Navbar -->
        <?php require_once 'navbar.php'; ?>

        <!-- Content -->
        <div class="row p-4">
            <div class="col-md-8">
                <h1 class="section-title">Tentang Kami</h1>
                
                <!-- Profile Sekolah -->
                <div class="content-card">
                    <h3>Profil Sekolah</h3>
                    <dl class="row profile-info">
                        <dt class="col-sm-4">Nama Sekolah</dt>
                        <dd class="col-sm-8"><?= htmlspecialchars($tentang_website['nama_sekolah']) ?></dd>
                        
                        <dt class="col-sm-4">NPSN</dt>
                        <dd class="col-sm-8"><?= htmlspecialchars($tentang_website['npsn']) ?></dd>
                        
                        <dt class="col-sm-4">Status Kepemilikan</dt>
                        <dd class="col-sm-8"><?= htmlspecialchars($tentang_website['status_kepemilikan']) ?></dd>
                        
                        <dt class="col-sm-4">SK Pendirian</dt>
                        <dd class="col-sm-8"><?= $tentang_website['sk_pendirian'] ? date('d F Y', strtotime($tentang_website['sk_pendirian'])) : '-' ?></dd>
                        
                        <dt class="col-sm-4">SK Operasional</dt>
                        <dd class="col-sm-8"><?= $tentang_website['sk_operasional'] ? date('d F Y', strtotime($tentang_website['sk_operasional'])) : '-' ?></dd>
                    </dl>
                </div>

                <!-- Prasarana -->
                <div class="content-card">
                    <h3>Prasarana Sekolah</h3>
                    <div class="prasarana-grid">
                        <?php 
                        if(!empty($tentang_website['prasarana'])) {
                            $prasarana = json_decode($tentang_website['prasarana'], true);
                            foreach($prasarana as $item) {
                                echo '<div class="prasarana-item">
                                    <h5>' . htmlspecialchars($item['nama']) . '</h5>
                                    <p class="mb-0">' . htmlspecialchars($item['detail']) . '</p>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- Visi & Misi -->
                <div class="content-card">
                    <h3>Visi & Misi</h3>
                    <div class="vision-box">
                        <h4 class="mb-3">Visi</h4>
                        <div class="mb-0"><?= $tentang_website['visi'] ?></div>
                    </div>
                    <div class="mission-box">
                        <h4 class="mb-3">Misi</h4>
                        <div class="mb-0"><?= $tentang_website['misi'] ?></div>
                    </div>
                </div>

                <!-- Struktur Organisasi -->
                <div class="content-card">
                    <h3>Struktur Organisasi</h3>
                    <?php if (!empty($struktur_organisasi_img)): ?>
                        <div class="struktur-organisasi">
                            <img src="<?= $struktur_organisasi_img ?>" alt="Struktur Organisasi">
                        </div>
                    <?php else: ?>
                        <p>Belum ada gambar struktur organisasi.</p>
                    <?php endif; ?>
                </div>

                <!-- Prestasi -->
                <div class="content-card">
                    <h3>Prestasi Sekolah</h3>
                    <div class="achievement-card mb-3">
                        <h4>Prestasi Akademik</h4>
                        <div class="mb-0"><?= $tentang_website['prestasi_akademik'] ?></div>
                    </div>
                    <div class="achievement-card">
                        <h4>Prestasi Non-Akademik</h4>
                        <div class="mb-0"><?= $tentang_website['prestasi_non_akademik'] ?></div>
                    </div>
                </div>
            </div>
            <?php require_once 'sidebar.php'; ?>
        </div>
        
        <!-- Footer -->
         <footer class="text-white text-center py-3" style="background-color: #011638;">
            <p>© <span id="year"></span> SDN Andonosari 1 | Dikembangkan oleh <a href="https://www.instagram.com/kknp.andonosari20" target="_blank" class="text-white fw-bold">KKN-P 20 UMSIDA</a></p>
            <p><a href="https://www.umsida.ac.id" target="_blank" class="text-white">Universitas Muhammadiyah Sidoarjo</a></p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var img = document.querySelector('.struktur-organisasi img');
            if (img) {
                img.addEventListener('load', function() {
                    console.log('Gambar dimuat dengan ukuran:', this.naturalWidth, 'x', this.naturalHeight);
                });
                
                img.addEventListener('error', function() {
                    console.error('Gagal memuat gambar');
                });
            }
        });

        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>