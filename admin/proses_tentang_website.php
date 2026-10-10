<?php
require_once '../koneksi.php';
require_once 'cek_session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

function debug_data($data, $label = '') {
    error_log($label . print_r($data, true));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    debug_data($_POST, 'POST Data: ');
    debug_data($_FILES, 'FILES Data: ');

    try {
        // Basic validation
        $required_fields = ['nama_sekolah', 'npsn', 'sk_pendirian', 'status_kepemilikan', 'sk_operasional', 'visi', 'misi'];
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                throw new Exception("Field $field harus diisi");
            }
        }

        // Get and sanitize basic fields
        $nama_sekolah = mysqli_real_escape_string($koneksi, $_POST['nama_sekolah']);
        $npsn = mysqli_real_escape_string($koneksi, $_POST['npsn']);
        $sk_pendirian = mysqli_real_escape_string($koneksi, $_POST['sk_pendirian']);
        $status_kepemilikan = mysqli_real_escape_string($koneksi, $_POST['status_kepemilikan']);
        $sk_operasional = mysqli_real_escape_string($koneksi, $_POST['sk_operasional']);
        $visi = mysqli_real_escape_string($koneksi, $_POST['visi']);
        $misi = mysqli_real_escape_string($koneksi, $_POST['misi']);

        // Process prasarana
        $prasarana = [];
        if (isset($_POST['prasarana_nama']) && isset($_POST['prasarana_detail'])) {
            $nama_prasarana = $_POST['prasarana_nama'];
            $detail_prasarana = $_POST['prasarana_detail'];
            
            for ($i = 0; $i < count($nama_prasarana); $i++) {
                if (!empty($nama_prasarana[$i]) && !empty($detail_prasarana[$i])) {
                    $prasarana[] = [
                        'nama' => $nama_prasarana[$i],
                        'detail' => $detail_prasarana[$i]
                    ];
                }
            }
        }
        $prasarana_json = json_encode($prasarana);

        // Process prestasi akademik
        $prestasi_akademik = '';
        if (isset($_POST['prestasi_akademik_caption'])) {
            $prestasi_akademik = '<div class="prestasi-list">';
            foreach ($_POST['prestasi_akademik_caption'] as $caption) {
                if (!empty(trim($caption))) {
                    $prestasi_akademik .= '<div class="prestasi-item">';
                    $prestasi_akademik .= '<p class="prestasi-caption">' . htmlspecialchars($caption) . '</p>';
                    $prestasi_akademik .= '</div>';
                }
            }
            $prestasi_akademik .= '</div>';
        }

        // Process prestasi non-akademik
        $prestasi_non_akademik = '';
        if (isset($_POST['prestasi_non_akademik_caption'])) {
            $prestasi_non_akademik = '<div class="prestasi-list">';
            foreach ($_POST['prestasi_non_akademik_caption'] as $caption) {
                if (!empty(trim($caption))) {
                    $prestasi_non_akademik .= '<div class="prestasi-item">';
                    $prestasi_non_akademik .= '<p class="prestasi-caption">' . htmlspecialchars($caption) . '</p>';
                    $prestasi_non_akademik .= '</div>';
                }
            }
            $prestasi_non_akademik .= '</div>';
        }

        // Check for file upload
        $has_new_image = isset($_FILES['struktur_organisasi']) && 
                        $_FILES['struktur_organisasi']['error'] === UPLOAD_ERR_OK && 
                        $_FILES['struktur_organisasi']['size'] > 0;

        if ($has_new_image) {
            $image_data = file_get_contents($_FILES['struktur_organisasi']['tmp_name']);
            
            $query = "UPDATE tbl_tentang_website SET 
                    nama_sekolah = ?,
                    npsn = ?,
                    sk_pendirian = ?,
                    status_kepemilikan = ?,
                    sk_operasional = ?,
                    visi = ?, 
                    misi = ?, 
                    struktur_organisasi = ?,
                    prasarana = ?,
                    prestasi_akademik = ?, 
                    prestasi_non_akademik = ? 
                    WHERE id = 1";
            
            $stmt = mysqli_prepare($koneksi, $query);
            if (!$stmt) {
                throw new Exception("Database prepare error: " . mysqli_error($koneksi));
            }
            
            mysqli_stmt_bind_param($stmt, "sssssssssss", 
                $nama_sekolah,
                $npsn,
                $sk_pendirian,
                $status_kepemilikan,
                $sk_operasional,
                $visi, 
                $misi, 
                $image_data,
                $prasarana_json,
                $prestasi_akademik, 
                $prestasi_non_akademik
            );
        } else {
            // Update without changing image
            $query = "UPDATE tbl_tentang_website SET 
                    nama_sekolah = ?,
                    npsn = ?,
                    sk_pendirian = ?,
                    status_kepemilikan = ?,
                    sk_operasional = ?,
                    visi = ?, 
                    misi = ?,
                    prasarana = ?,
                    prestasi_akademik = ?, 
                    prestasi_non_akademik = ? 
                    WHERE id = 1";
            
            $stmt = mysqli_prepare($koneksi, $query);
            if (!$stmt) {
                throw new Exception("Database prepare error: " . mysqli_error($koneksi));
            }
            
            mysqli_stmt_bind_param($stmt, "ssssssssss", 
                $nama_sekolah,
                $npsn,
                $sk_pendirian,
                $status_kepemilikan,
                $sk_operasional,
                $visi, 
                $misi,
                $prasarana_json,
                $prestasi_akademik, 
                $prestasi_non_akademik
            );
        }

        // Execute query
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Database execute error: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);

        // Return success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Data berhasil disimpan!'
        ]);
        exit;

    } catch (Exception $e) {
        // Log error for debugging
        error_log("Error in proses_tentang_website.php: " . $e->getMessage());
        
        // Return error response
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
} else {
    // Not a POST request
    echo json_encode([
        'status' => 'error',
        'message' => 'Method tidak diizinkan'
    ]);
    exit;
}
?>