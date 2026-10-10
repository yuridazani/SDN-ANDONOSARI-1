<?php 
require_once 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT id, nama, nip, jabatan, foto FROM tbl_guru");
$aktif = 'guru';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Guru - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
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
            
        <!-- nav bar -->
        <?php require_once 'navbar.php'; ?>

        <!-- content -->
        <div class="row p-3">
            <div class="col-md-8">
                <div class="title mb-3">
                    Daftar Guru
                </div>
                <div class="row">
                    <?php while($row = mysqli_fetch_assoc($query)) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="images/guru/<?= $row['foto'] ?>" class="card-img-top" alt="Foto <?= $row['nama'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama'] ?></h5>
                                    <p class="card-text">
                                        <strong>NIP:</strong> <?= $row['nip'] ?><br>
                                        <strong>Jabatan:</strong> <?= $row['jabatan'] ?>
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