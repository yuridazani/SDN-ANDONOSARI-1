<?php 
require_once 'koneksi.php';

// Query untuk mengambil data galeri dari database
$query_classroom = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'classroom' ORDER BY id DESC");
$query_extra = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'extracurricular' ORDER BY id DESC");
$query_events = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'events' ORDER BY id DESC");
$query_videos = mysqli_query($koneksi, "SELECT * FROM tbl_galeri WHERE kategori = 'videos' ORDER BY id DESC");

$aktif = 'galeri'; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Galeri - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/fonts/stylesheet.css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <!-- Tambahan CSS untuk galeri -->
    <style>
        .gallery-container {
            padding: 2rem 0;
        }
        .gallery-item {
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .gallery-item:hover {
            transform: translateY(-5px);
        }
        .gallery-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .gallery-caption {
            background: rgba(0,0,0,0.7);
            color: white;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
        }
        .nav-pills .nav-link {
            color: #011638ff;
            border-radius: 20px;
            margin: 0 5px;
        }
        .nav-pills .nav-link.active {
            background-color: #011638ff;
            color: white;
        }
        .tab-content {
            padding-top: 2rem;
        }
        .section-title {
            color: #011638ff;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #011638ff;
        }
        .video-thumbnail {
            position: relative;
        }
        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 3rem;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container bg-light px-0 ">
        <!-- top bar -->
        <div class="logo clearfix">
            <div class="float-left mt-3 mb-3">
                <img src="resources/images/logo.png" alt="Logo Sekolah" width="70px" class="float-left mr-3">
                <div class="text float-right">
                    <span class="smk">SDN Andonosari 1</span><br>
                    <span class="visi">Jl. Tutur, Siwil, Andono Sari, Kec. Tutur, Pasuruan, Jawa Timur 67165</span>
                </div>
            </div>
        </div>
            
        <!-- nav bar -->
        <?php require_once 'navbar.php'; ?>

        <!-- content -->
        <div class="row p-3">
            <div class="col-md-8">
                <div class="title mb-3">
                    Galeri SDN Andonosari 1
                </div>
                <div class="gallery-container">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills mb-4 justify-content-center" id="galleryTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#classroom">Kegiatan Belajar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#extra">Ekstrakurikuler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#events">Event Sekolah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#videos">Video Dokumentasi</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content">
                        <!-- Kegiatan Belajar -->
                        <div class="tab-pane fade show active" id="classroom">
                            <h4 class="section-title">Foto Kegiatan Belajar di Kelas</h4>
                            <div class="row">
                                <?php while($classroom = mysqli_fetch_assoc($query_classroom)) : ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="gallery-item">
                                        <img src="<?= $classroom['foto'] ?>" alt="<?= $classroom['judul'] ?>" class="gallery-img">
                                        <div class="gallery-caption">
                                            <h5 class="m-0"><?= $classroom['judul'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <!-- Ekstrakurikuler -->
                        <div class="tab-pane fade" id="extra">
                            <h4 class="section-title">Foto Kegiatan Ekstrakurikuler</h4>
                            <div class="row">
                                <?php while($extra = mysqli_fetch_assoc($query_extra)) : ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="gallery-item">
                                        <img src="<?= $extra['foto'] ?>" alt="<?= $extra['judul'] ?>" class="gallery-img">
                                        <div class="gallery-caption">
                                            <h5 class="m-0"><?= $extra['judul'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <!-- Event Sekolah -->
                        <div class="tab-pane fade" id="events">
                            <h4 class="section-title">Foto Event Sekolah</h4>
                            <div class="row">
                                <?php while($event = mysqli_fetch_assoc($query_events)) : ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="gallery-item">
                                        <img src="<?= $event['foto'] ?>" alt="<?= $event['judul'] ?>" class="gallery-img">
                                        <div class="gallery-caption">
                                            <h5 class="m-0"><?= $event['judul'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <!-- Video Dokumentasi -->
                        <div class="tab-pane fade" id="videos">
                            <h4 class="section-title">Video Dokumentasi Sekolah</h4>
                            <div class="row">
                                <?php while($video = mysqli_fetch_assoc($query_videos)) : ?>
                                    <?php if (!empty($video['video'])) : ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="gallery-item">
                                                <video width="100%" height="250" controls>
                                                    <source src="<?= $video['video'] ?>" type="video/mp4">
                                                    Browser Anda tidak mendukung pemutaran video.
                                                </video>
                                                <div class="gallery-caption">
                                                    <h5 class="m-0"><?= $video['judul'] ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk menampilkan video -->
                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel">Tonton Video</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <iframe id="videoFrame" width="100%" height="400" src="" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once 'sidebar.php'; ?>
        </div>
        <div class="text-white footer">
 <!-- Footer -->
 <footer class="text-white text-center py-3" style="background-color: #011638;">
            <p>© <span id="year"></span> SDN Andonosari 1 | Dikembangkan oleh <a href="https://www.instagram.com/kknp.andonosari20" target="_blank" class="text-white fw-bold">KKN-P 20 UMSIDA</a></p>
            <p><a href="https://www.umsida.ac.id" target="_blank" class="text-white">Universitas Muhammadiyah Sidoarjo</a></p>
        </footer>
    </div>
    <script>
    $(document).ready(function(){
        $(".video-thumbnail").click(function(){
            var videoUrl = $(this).data("video"); 
            $("#videoFrame").attr("src", videoUrl);
            $("#videoModal").modal("show");
        });

        $("#videoModal").on("hidden.bs.modal", function(){
            $("#videoFrame").attr("src", "");
        });
    });

        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>