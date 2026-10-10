<nav class="navbar navbar-expand-lg nav-orange">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link text-white navlink <?= $aktif == 'home' ? 'active' : '' ?>" href="index.php">HOME</a>
            <a class="nav-item nav-link text-white navlink <?= $aktif == 'artikel' ? 'active' : '' ?>" href="artikel.php">ARTIKEL</a>
            <a class="nav-item nav-link text-white navlink <?= $aktif == 'siswa' ? 'active' : '' ?>" href="siswa.php">SISWA</a>
            <a class="nav-item nav-link text-white navlink <?= $aktif == 'guru' ? 'active' : '' ?>" href="guru.php">TENAGA PENDIDIK</a>
            
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white navlink <?= ($aktif == 'ekskul' || $aktif == 'jurusan') ? 'active' : '' ?>" href="#" id="programDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PROGRAM UNGGULAN
                </a>
                <div class="dropdown-menu" aria-labelledby="programDropdown">
                    <a class="dropdown-item <?= $aktif == 'ekskul' ? 'active' : '' ?>" href="ekskul.php">EKSTRAKURIKULER</a>
                    <a class="dropdown-item <?= $aktif == 'jurusan' ? 'active' : '' ?>" href="jurusan.php">PROGRAM UNGGULAN SEKOLAH</a>
                </div>
            </div>
            
            <a class="nav-item nav-link text-white navlink <?= $aktif == 'galeri' ? 'active' : '' ?>" href="galeri.php">GALERI</a>
            <a class="nav-item nav-link text-white navlink <?= $aktif == 'bukutamu' ? 'active' : '' ?>" href="bukutamu.php">KONTAK</a>
            <a class="nav-item nav-link text-white navlink <?= $aktif == 'tentang_website' ? 'active' : '' ?>" href="tentang_website.php">TENTANG KAMI</a>
        </div>
    </div>
</nav>