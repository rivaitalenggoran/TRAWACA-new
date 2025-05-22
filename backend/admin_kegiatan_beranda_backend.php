<?php
include(__DIR__ . '../../config/database.php');

// Cek apakah folder uploads tersedia
$uploadDir = __DIR__ . '../../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$id = $_GET['edit'] ?? null;
$id_kegiatan_bahasa = $_GET['id_kegiatan'] ?? null;

// Ambil data kegiatan
$queryKegiatan = "
    SELECT
        kl.id_kegiatan,
        kl.gambar_kegiatan_luaran,
        kl.waktu_kegiatan_luaran,
        kl.link_kegiatan_luaran,
        klt.id_bahasa,
        klt.nama_kegiatan_luaran,
        klt.deskripsi_kegiatan_luaran,
        klt.kode_bahasa,
        klt.nama_link
    FROM kegiatan_luaran kl
    JOIN kegiatan_luaran_bahasa klt ON kl.id_kegiatan = klt.id_kegiatan";
$stmtKegiatan = $pdo->prepare($queryKegiatan);
$stmtKegiatan->execute();
$Kegiatan = $stmtKegiatan->fetchAll(PDO::FETCH_ASSOC);

// Proses simpan/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kegiatan = $_POST['id_kegiatan'] ?? null;
    $waktu_kegiatan = $_POST['waktu_kegiatan_luaran'];
    $link_kegiatan = $_POST['link_kegiatan_luaran'];
    $id_bahasa = $_POST['id_bahasa'] ?? '';
    $kode_bahasa = $_POST['kode_bahasa'];
    $nama_kegiatan = $_POST['nama_kegiatan_luaran'];
    $deskripsi_kegiatan = $_POST['deskripsi_kegiatan_luaran'];
    $nama_link = $_POST['nama_link'];

    // Handle upload gambar
    $gambar_kegiatan = null;
    if (isset($_FILES['gambar_kegiatan_luaran']) && $_FILES['gambar_kegiatan_luaran']['error'] === UPLOAD_ERR_OK) {
        $namaFile = basename($_FILES['gambar_kegiatan_luaran']['name']);
        $targetFile = $uploadDir . $namaFile;

        if (move_uploaded_file($_FILES['gambar_kegiatan_luaran']['tmp_name'], $targetFile)) {
            $gambar_kegiatan = 'uploads/' . $namaFile;
        }
    }

    // Edit bahasa
    if ($id) {
        $stmt = $pdo->prepare("
            UPDATE kegiatan_luaran_bahasa
            SET nama_kegiatan_luaran = ?, deskripsi_kegiatan_luaran = ?, nama_link = ?
            WHERE id_bahasa = ?");
        $stmt->execute([$nama_kegiatan, $deskripsi_kegiatan, $nama_link, $id]);
    }

    // Tambah bahasa untuk kegiatan yang sudah ada
    elseif ($id_kegiatan_bahasa) {
        $stmt = $pdo->prepare("
            INSERT INTO kegiatan_luaran_bahasa (id_kegiatan, nama_kegiatan_luaran, deskripsi_kegiatan_luaran, kode_bahasa, nama_link)
            VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id_kegiatan_bahasa, $nama_kegiatan, $deskripsi_kegiatan, $kode_bahasa, $nama_link]);
    }

    // Tambah kegiatan baru + bahasa
    else {
        $stmt = $pdo->prepare("
            INSERT INTO kegiatan_luaran (gambar_kegiatan_luaran, waktu_kegiatan_luaran, link_kegiatan_luaran)
            VALUES (?, ?, ?)");
        $stmt->execute([$gambar_kegiatan, $waktu_kegiatan, $link_kegiatan]);
        $id_kegiatan_baru = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO kegiatan_luaran_bahasa (id_kegiatan, nama_kegiatan_luaran, deskripsi_kegiatan_luaran, kode_bahasa, nama_link)
            VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id_kegiatan_baru, $nama_kegiatan, $deskripsi_kegiatan, $kode_bahasa, $nama_link]);
    }

    header("Location: ../beranda_dashboard.php");
    exit;
}

// Ambil data untuk edit
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("
        SELECT kl.*, klt.*
        FROM kegiatan_luaran kl
        JOIN kegiatan_luaran_bahasa klt ON kl.id_kegiatan = klt.id_kegiatan
        WHERE klt.id_bahasa = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Delete
// Delete Header Publikasi Bahasa
if (isset($_GET['deletekegiatan'])) {
    $id_bahasa = $_GET['deletekegiatan'];
    
    // Dapatkan id_kegiatan dari id_bahasa
    $stmt = $pdo->prepare("SELECT id_kegiatan FROM kegiatan_luaran_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_kegiatan = $result['id_kegiatan'];

        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM kegiatan_luaran_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM kegiatan_luaran_bahasa WHERE id_kegiatan = :id_kegiatan");
        $stmt_check->execute([':id_kegiatan' => $id_kegiatan]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        // Jika tidak ada, hapus kegiatan utama dan gambar
        if ($data_check['total'] == 0) {
            // Ambil nama gambar
            $stmt_gambar = $pdo->prepare("SELECT gambar_kegiatan_luaran FROM kegiatan_luaran WHERE id_kegiatan = :id_kegiatan");
            $stmt_gambar->execute([':id_kegiatan' => $id_kegiatan]);
            $data_gambar = $stmt_gambar->fetch(PDO::FETCH_ASSOC);

            // Hapus file gambar jika ada
            if ($data_gambar && !empty($data_gambar['gambar_kegiatan_luaran'])) {
                $fileName = basename($data_gambar['gambar_kegiatan_luaran']); // Pastikan hanya nama file
                $file_path = __DIR__ . '../../uploads/' . $fileName;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            // Hapus kegiatan
            $stmt_parent = $pdo->prepare("DELETE FROM kegiatan_luaran WHERE id_kegiatan = :id_kegiatan");
            $stmt_parent->execute([':id_kegiatan' => $id_kegiatan]);
        }
    }

    header("Location: ../Adminn/beranda_dashboard.php");
    exit;
}

?>
