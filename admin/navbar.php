<?php require_once 'cek_session.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= $active == 'dashboard' ? 'active' : '' ?>" href="/SDNANDONOSARI1/admin/index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/SDNANDONOSARI1" target="_blank">Lihat Website</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= $active == 'artikel' ? 'active' : '' ?>" href="#" id="artikelDropdown" data-toggle="dropdown">Artikel</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/SDNANDONOSARI1/admin/kategori_artikel/index.php">Kategori Artikel</a>
                        <a class="dropdown-item" href="/SDNANDONOSARI1/admin/artikel/index.php">Data Artikel</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= $active == 'master' ? 'active' : '' ?>" href="#" id="masterDropdown" data-toggle="dropdown">Data Master</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/SDNANDONOSARI1/admin/guru/index.php">Data Guru</a>
                        <a class="dropdown-item" href="/SDNANDONOSARI1/admin/jurusan/index.php">Data Program Unggulan</a>
                        <a class="dropdown-item" href="/SDNANDONOSARI1/admin/siswa/index.php">Data Siswa</a>
                        <a class="dropdown-item" href="/SDNANDONOSARI1/admin/ekskul/index.php">Data Ekskul</a>
                        <a class="dropdown-item" href="/SDNANDONOSARI1/admin/pengguna/index.php">Data Pengguna</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $active == 'galeri' ? 'active' : '' ?>" href="/SDNANDONOSARI1/admin/galeri.php">Manajemen Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $active == 'tentang_website' ? 'active' : '' ?>" href="/SDNANDONOSARI1/admin/tentang_website.php">Tentang Website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/SDNANDONOSARI1/admin/logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>