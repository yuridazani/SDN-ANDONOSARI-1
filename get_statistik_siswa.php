<?php 
require_once 'koneksi.php';

// Prevent any output before JSON
header('Content-Type: application/json');

// Get statistics data
$query = mysqli_query($koneksi, "SELECT tahun, kelas, jumlah_laki, jumlah_perempuan, total_siswa FROM statistik_siswa ORDER BY tahun DESC, kelas ASC");
if (!$query) {
    echo json_encode(['error' => mysqli_error($koneksi)]);
    exit;
}

$data = [
    'kelas' => [],
    'tahun' => [],
    'gender' => [
        'laki' => 0,
        'perempuan' => 0
    ],
    'total_siswa' => 0
];

$kelas_summary = [];
$tahun_summary = [];

while ($row = mysqli_fetch_assoc($query)) {
    // Accumulate totals by class
    if (!isset($kelas_summary[$row['kelas']])) {
        $kelas_summary[$row['kelas']] = 0;
    }
    $kelas_summary[$row['kelas']] += $row['total_siswa'];
    
    // Accumulate totals by year
    if (!isset($tahun_summary[$row['tahun']])) {
        $tahun_summary[$row['tahun']] = 0;
    }
    $tahun_summary[$row['tahun']] += $row['total_siswa'];
    
    // Add to gender totals
    $data['gender']['laki'] += $row['jumlah_laki'];
    $data['gender']['perempuan'] += $row['jumlah_perempuan'];
    
    // Add to total students
    $data['total_siswa'] += $row['total_siswa'];
}

// Convert summaries to arrays for the response
foreach ($kelas_summary as $kelas => $total) {
    $data['kelas'][] = [
        'kelas' => $kelas,
        'jumlah' => $total
    ];
}

foreach ($tahun_summary as $tahun => $total) {
    $data['tahun'][] = [
        'tahun' => $tahun,
        'total' => $total
    ];
}

// Sort arrays
usort($data['kelas'], function($a, $b) {
    return strcmp($a['kelas'], $b['kelas']);
});

usort($data['tahun'], function($a, $b) {
    return $a['tahun'] - $b['tahun'];
});

echo json_encode($data);
exit;