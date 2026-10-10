<?php 
require_once 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT tbl_ekskul.id AS id, tbl_ekskul.nama_ekskul, tbl_ekskul.pembina, tbl_guru.nama, tbl_guru.id AS id_guru FROM tbl_ekskul LEFT JOIN tbl_guru on tbl_ekskul.pembina = tbl_guru.id");
$aktif = 'ekskul';
$no = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstrakurikuler - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/fonts/stylesheet.css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .ekskul-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }
        
        .ekskul-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .ekskul-icon {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 50%;
            margin-bottom: 15px;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .ekskul-icon i {
            font-size: 2rem;
            color: #011638;
        }

        .card-title {
            color: #011638;
            font-weight: bold;
            margin-top: 15px;
        }

        .pembina-link {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .pembina-link:hover {
            color: #011638;
        }

        .page-title {
            color: #011638;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 3px solid #011638;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container bg-light px-0">
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
        <div class="row p-4">
            <div class="col-md-8">
                <div class="title mb-4">
                    <h2 class="page-title">Ekstrakurikuler</h2>
                </div>
                <div class="row">
                    <?php while($row = mysqli_fetch_assoc($query)) : ?>
                        <div class="col-md-6 mb-4">
                            <div class="card ekskul-card shadow-sm">
                                <div class="card-body text-center">
                                    <div class="ekskul-icon">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <h5 class="card-title"><?= $row['nama_ekskul'] ?></h5>
                                    <p class="card-text">
                                        <small>Pembina:</small><br>
                                        <?php if(isset($row['nama'])) : ?>
                                            <a href="detail_guru.php?id=<?= $row['id_guru'] ?>" class="pembina-link" target="_blank">
                                                <?= $row['nama'] ?>
                                            </a>
                                        <?php else : ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php require 'sidebar.php'; ?>
        </div>

        <!-- Footer -->
        <footer class="text-white text-center py-3" style="background-color: #011638;">
            <p>© <span id="year"></span> SDN Andonosari 1 | Dikembangkan oleh <a href="https://www.instagram.com/kknp.andonosari20" target="_blank" class="text-white fw-bold">KKN-P 20 UMSIDA</a></p>
            <p><a href="https://www.umsida.ac.id" target="_blank" class="text-white">Universitas Muhammadiyah Sidoarjo</a></p>
        </footer>
    </div>
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>