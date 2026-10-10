<!-- siswa.php -->
 
<?php 
require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Siswa - SDN Andonosari 1</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container bg-light px-0">
        <div class="logo clearfix">
            <div class="float-left mt-3 mb-3">
                <img src="resources/images/logo.png" alt="Logo Sekolah" width="70px" class="float-left mr-3">
                <div class="text float-right">
                    <span class="smk">SDN Andonosari 1</span><br>
                    <span class="visi">Jl. Tutur, Siwil, Andono Sari, Kec. Tutur, Pasuruan, Jawa Timur 67165</span>
                </div>
            </div>
        </div>
        
        <?php require_once 'navbar.php'; ?>
        
        <div class="row p-3">
            <div class="col-md-8">
                <div class="title mb-3">
                    <h2>Statistik Siswa</h2>
                </div>
                
                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Siswa</h5>
                                <h2 id="total_siswa">0</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Siswa Laki-laki</h5>
                                <h2 id="total_laki">0</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Siswa Perempuan</h5>
                                <h2 id="total_perempuan">0</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Class Distribution -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Distribusi Siswa per Kelas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Jumlah Siswa</th>
                                    </tr>
                                </thead>
                                <tbody id="kelas_table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Gender Distribution -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Perbandingan Siswa Laki-laki dan Perempuan</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>

                <!-- Yearly Trend -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Tren Jumlah Siswa per Tahun</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="trendChart"></canvas>
                    </div>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();

        document.addEventListener("DOMContentLoaded", function() {
            fetch("get_statistik_siswa.php")
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    
                    // Update summary cards
                    document.getElementById("total_siswa").textContent = data.total_siswa.toLocaleString();
                    document.getElementById("total_laki").textContent = data.gender.laki.toLocaleString();
                    document.getElementById("total_perempuan").textContent = data.gender.perempuan.toLocaleString();

                    // Update class table
                    let kelasTable = document.getElementById("kelas_table");
                    kelasTable.innerHTML = "";
                    data.kelas.forEach(kelas => {
                        let row = `<tr>
                            <td>${kelas.kelas}</td>
                            <td>${kelas.jumlah.toLocaleString()}</td>
                        </tr>`;
                        kelasTable.innerHTML += row;
                    });

                    // Create gender distribution chart
                    new Chart(document.getElementById("genderChart"), {
                        type: "pie",
                        data: {
                            labels: ["Laki-laki", "Perempuan"],
                            datasets: [{
                                data: [data.gender.laki, data.gender.perempuan],
                                backgroundColor: ["#007bff", "#17a2b8"]
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });

                    // Create yearly trend chart
                    new Chart(document.getElementById("trendChart"), {
                        type: "bar",
                        data: {
                            labels: data.tahun.map(t => t.tahun),
                            datasets: [{
                                label: "Jumlah Siswa",
                                data: data.tahun.map(t => t.total),
                                backgroundColor: "#28a745",
                                borderColor: "#28a745",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('Terjadi kesalahan saat mengambil data statistik: ' + error.message);
                });
        });
    </script>
</body>
</html>