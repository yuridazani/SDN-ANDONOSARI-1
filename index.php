<?php 
require_once 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM tbl_artikel");
$aktif = 'home';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/fonts/stylesheet.css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <style>

            /* Layout fixes */
    .content-wrapper {
        padding: 0;
        margin: 0;
    }
    
    .main-content {
        padding: 1rem;
    }
    
    .sidebar-content {
        padding: 1rem;
        background-color: #f8f9fa;
    }
    
    /* Article image sizing */
    .artikel .artikel-img {
        width: 200px;
        height: 150px;
        overflow: hidden;
    }
    
    .artikel .artikel-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    @media (max-width: 768px) {
        .sidebar-content {
            margin-top: 2rem;
        }
    }

    /* Modern Carousel Styles */
    .carousel-container {
        width: 100%;
        overflow: hidden;
        position: relative;
    }
    
    #heroCarousel {
        margin: 0;
        padding: 0;
        width: 100%;
    }
    
    .carousel-inner {
        height: 500px;
    }
    
    .carousel-item {
        height: 100%;
        width: 100%;
    }
    
    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    
    /* Modern controls with transparency */
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        background: rgba(0, 0, 0, 0.2);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    #heroCarousel:hover .carousel-control-prev,
    #heroCarousel:hover .carousel-control-next {
        opacity: 1;
    }
    
    /* Modern indicators */
    .carousel-indicators {
        margin-bottom: 1rem;
    }
    
    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 5px;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        transition: background-color 0.3s ease;
    }
    
    .carousel-indicators button.active {
        background-color: #fff;
        transform: scale(1.2);
    }
    
    .container {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    
    @media (max-width: 768px) {
        .carousel-inner {
            height: 300px;
        }
    }
</style>
</head>
<body>
    <div class="container bg-light px-0">
        <!-- top bar -->
        <div class="logo py-3">
            <div class="d-flex align-items-center px-3">
                <img src="resources/images/logo.png" alt="Logo Sekolah" class="logo-img me-3" style="width: 70px; height: auto;">
                <div class="text">
                    <span class="smk d-block">SDN Andonosari 1</span>
                    <span class="visi d-block">Jl. Tutur, Siwil, Andono Sari, Kec. Tutur, Pasuruan, Jawa Timur 67165</span>
                </div>
            </div>
        </div>
            
        <!-- nav bar -->
        <?php require_once 'navbar.php'; ?>

        <!-- Hero Carousel -->
        <div class="carousel-container">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="resources/images/bann-1.jpg" class="d-block" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="resources/images/bann-2.jpg" class="d-block" alt="Banner 2">
                    </div>
                    <div class="carousel-item">
                        <img src="resources/images/bann-3.jpg" class="d-block" alt="Banner 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- content -->
        <div class="content-wrapper">
            <div class="row g-0">
                <div class="col-12 col-md-8 main-content">
                    <div class="title mb-4">Informasi Terbaru</div>
                    <?php while($artikel = mysqli_fetch_assoc($query)) : ?>
                    <div class="artikel mb-4">
                        <div class="info">
                            <div class="post mb-3">
                                <span class="tgl d-block mb-2"><?= date('d M y', strtotime($artikel['tanggal'])) ?></span>
                                <span class="judul"><a href="detail_artikel.php?id=<?= $artikel['id'] ?>" class="text-decoration-none"><?= $artikel['judul'] ?></a></span>
                            </div>
                        </div>
                        <div class="detail">
                            <div class="d-flex flex-column flex-md-row">
                                <div class="artikel-img me-md-3 mb-3 mb-md-0">
                                    <img src="images/artikel/<?= $artikel['foto'] ?>" alt="<?= $artikel['judul'] ?>">
                                </div>
                                <div class="artikel-text">
                                    <?= substr($artikel['isi'], 0, 150) . '...' ?>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                    </div>
                    <?php endwhile; ?>
                </div>
                    <?php require_once 'sidebar.php'; ?>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-white text-center py-3" style="background-color: #011638;">
            <div class="container">
                <p class="mb-1">© <span id="year"></span> SDN Andonosari 1 | Dikembangkan oleh 
                    <a href="https://www.instagram.com/kknp.andonosari20" target="_blank" class="text-white fw-bold">KKN-P 20 UMSIDA</a>
                </p>
                <p class="mb-0">
                    <a href="https://www.umsida.ac.id" target="_blank" class="text-white">Universitas Muhammadiyah Sidoarjo</a>
                </p>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi carousel
        var myCarousel = new bootstrap.Carousel(document.getElementById('heroCarousel'), {
            interval: 3000,
            wrap: true,
            touch: true,
            pause: 'hover'
        });
        
        // Tambahan event listener untuk tombol prev/next
        document.querySelector('.carousel-control-prev').addEventListener('click', function() {
            myCarousel.prev();
        });
        
        document.querySelector('.carousel-control-next').addEventListener('click', function() {
            myCarousel.next();
        });
    });

        document.getElementById("year").textContent = new Date().getFullYear();
    </script>

</body>
</html>
