<?php 
require_once 'cek_session.php';
$active = 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard - SDN Andonosari 1</title>
	<link rel="stylesheet" href="../resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
<?php
$active = 'dashboard'; 
require_once 'navbar.php';
?>
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow">
					<div class="card-header bg-primary text-white">Dashboard Admin</div>
					<div class="card-body">
						<h5 class="card-title">Selamat Datang, Admin!</h5>
						<p class="card-text">Gunakan menu di atas untuk mengelola konten website.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../resources/js/jquery.js"></script>
	<script src="../resources/js/bootstrap.bundle.min.js"></script>
</body>
</html>
