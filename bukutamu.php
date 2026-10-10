<?php 
require_once 'koneksi.php';
$aktif = 'bukutamu'; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/fonts/stylesheet.css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .contact-section {
            padding: 20px 0;
        }

        .contact-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.08);
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: #011638ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .contact-icon i {
            font-size: 24px;
            color: white;
        }

        .contact-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #011638ff;
        }

        .contact-text {
            color: #666;
            margin-bottom: 0;
            font-size: 15px;
            line-height: 1.6;
        }

        .contact-link {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-link:hover {
            color: #011638ff;
            text-decoration: none;
        }

        .map-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
            border-radius: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            color: #011638ff;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #011638ff;
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
        <div class="row p-3">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="title">
                    Hubungi Kami
                </div>

                <!-- Contact Info Cards -->
                <div class="contact-section">
                    <div class="row">
                        <!-- Address Card -->
                        <div class="col-md-6 mb-4">
                            <div class="contact-card">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-title">Alamat Sekolah</div>
                                <p class="contact-text">
                                    Jl. Tutur, Siwil, Andono Sari, Kec. Tutur, Pasuruan, Jawa Timur 67165
                                </p>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div class="col-md-6 mb-4">
                            <div class="contact-card">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-title">Email</div>
                                <p class="contact-text">
                                    <a href="mailto:sdn_andonosari1@yahoo.com" class="contact-link">sdn_andonosari1@yahoo.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Maps -->
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1174.9256867963127!2d112.83311984919715!3d-7.898914360281909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6330c79c6011d%3A0x5de6e7ff30208ee3!2sSD%20NEGERI%2001%20ANDONOSARI!5e0!3m2!1sid!2sid!4v1739239734139!5m2!1sid!2sid" allowfullscreen></iframe>
                </div>
            </div>

            <!-- Sidebar -->
            <?php require_once 'sidebar.php'; ?>
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