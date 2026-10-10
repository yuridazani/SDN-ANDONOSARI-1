<?php 
require_once '../../koneksi.php';

// Query tanpa LEFT JOIN karena kolom 'koordinator' sudah dihapus
$query = mysqli_query($koneksi, "SELECT id, nama_program, deskripsi, icon FROM tbl_program_unggulan");

// Cek apakah query berhasil dijalankan
if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}

$no = 1;
$active = 'master';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Program Unggulan - SDN Andnosari 1</title>
    <link rel="stylesheet" href="../../resources/datatables/datatables.min.css">
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php
require_once '../navbar.php';
?>
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                                Daftar Program Unggulan
                            </div>
                            <div class="float-right">
                                <a href="tambah.php" class="btn btn-primary btn-sm">Tambah Program</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($_SESSION['sukses'])) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> <?= $_SESSION['sukses'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['sukses']) ?>
                        <?php elseif(isset($_SESSION['gagal'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> <?= $_SESSION['gagal'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php unset($_SESSION['gagal']) ?>
                        <?php endif; ?>
                        <table id="table_id" class="dataTable table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama Program</th>
                                    <th width="35%">Deskripsi</th>
                                    <th width="10%">Icon</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($query)) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_program'] ?></td>
                                        <td><?= substr($row['deskripsi'], 0, 100) ?>...</td>
                                        <td>
                                            <i class="fas <?= $row['icon'] ?> fa-2x"></i>
                                        </td>
                                        <td>
                                            <a href="ubah.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i> Ubah
                                            </a>
                                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Apakah anda yakin ingin menghapus program ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
    <script src="../../resources/datatables/datatables.min.js"></script>
    <script src="../../resources/datatables/datatable.js"></script>
</body>
</html>