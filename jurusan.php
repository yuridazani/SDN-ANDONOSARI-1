<?php 
require_once 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM tbl_program_unggulan");
$aktif = 'program_unggulan';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Unggulan - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/fonts/stylesheet.css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .program-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
            background: white;
        }
        
        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .program-icon {
            background: linear-gradient(135deg, #011638 0%, #1a3a7e 100%);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .program-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .card-title {
            color: #011638;
            font-weight: bold;
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .page-title {
            color: #011638;
            margin-bottom: 40px;
            padding-bottom: 15px;
            border-bottom: 3px solid #011638;
            display: inline-block;
        }

        .program-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .koordinator-badge {
            background-color: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #011638;
            display: inline-block;
        }

        .koordinator-badge i {
            margin-right: 5px;
            color: #011638;
        }

        .intro-text {
            color: #666;
            margin-bottom: 40px;
            font-size: 1.1rem;
            line-height: 1.8;
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
                    <h2 class="page-title">Program Unggulan</h2>
                </div>
                <div class="intro-text">
                    Kami menyediakan berbagai program unggulan yang dirancang untuk mengembangkan potensi siswa secara maksimal dan mempersiapkan mereka menghadapi tantangan global.
                </div>
                <div class="row">
                    <?php while($row = mysqli_fetch_assoc($query)) : ?>
                        <div class="col-md-6 mb-4">
                            <div class="card program-card shadow-sm p-4">
                                <div class="program-icon">
                                    <i class="fas <?= $row['icon'] ?>"></i>
                                </div>
                                <h5 class="card-title"><?= $row['nama_program'] ?></h5>
                                <p class="program-description">
                                    <?= $row['deskripsi'] ?>
                                </p>
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