<?php
include(__DIR__ . '../../config/database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    // Tangani jika session id_peneliti tidak ditemukan
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;
}

$id_publikasi = isset($_GET['edit']) ? $_GET['edit'] : null;

//Publikasi Peneliti ----------------------------------------------------------
$queryPublikasi = "
    SELECT 
        id_peneliti,
        id_publikasi,
        tahun_publikasi,
        nama_publikasi,
        nama_peneliti,
        hari_tanggal_publikasi,
        tempat_publikasi,
        tautan_publikasi 
    FROM 
        publikasi_peneliti_individu 
    WHERE 
        id_peneliti = $id_peneliti
";
$stmtPublikasi = $pdo->query($queryPublikasi);
$selected_publikasi = $stmtPublikasi->fetchAll(PDO::FETCH_ASSOC);

// Tambah atau Update Publikasi Peneliti
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_publikasi = $_POST['id_publikasi'] ?? '';
    $tahun_publikasi = $_POST['tahun_publikasi'];
    $nama_publikasi = $_POST['nama_publikasi'];
    $nama_peneliti = $_POST['nama_peneliti'];
    $hari_tanggal_publikasi = $_POST['hari_tanggal_publikasi'];
    $tempat_publikasi = $_POST['tempat_publikasi'];
    $tautan_publikasi = $_POST['tautan_publikasi'];

    if ($id_publikasi) {
        // Update data publikasi
        $stmt = $pdo->prepare("UPDATE publikasi_peneliti_individu
            SET tahun_publikasi = ?, nama_publikasi = ?, nama_peneliti = ?, hari_tanggal_publikasi = ?, tempat_publikasi = ?, tautan_publikasi = ?
            WHERE id_publikasi = ?");
        $stmt->execute([$tahun_publikasi, $nama_publikasi, $nama_peneliti, $hari_tanggal_publikasi, $tempat_publikasi, $tautan_publikasi, $id_publikasi]);
    } else {
        // Insert data publikasi baru
        $stmt = $pdo->prepare("INSERT INTO publikasi_peneliti_individu (id_peneliti, tahun_publikasi, nama_publikasi, nama_peneliti, hari_tanggal_publikasi, tempat_publikasi, tautan_publikasi)
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_peneliti, $tahun_publikasi, $nama_publikasi, $nama_peneliti, $hari_tanggal_publikasi, $tempat_publikasi, $tautan_publikasi]);
    }
    header("Location: ../publikasi_dashboard.php"); // Redirect setelah berhasil
    exit;
}

// Ambil Data Publikasi untuk Update
if (isset($_GET['edit'])) {
    $id_publikasi = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM publikasi_peneliti_individu WHERE id_publikasi = ?");
    $stmt->execute([$id_publikasi]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus Data Publikasi Peneliti
if (isset($_GET['deletepublikasi'])) {
    $id_publikasi = $_GET['deletepublikasi'];
    $stmt = $pdo->prepare("DELETE FROM publikasi_peneliti_individu WHERE id_publikasi = ?");
    $stmt->execute([$id_publikasi]);
    
    header("Location: ../peneliti/publikasi_dashboard.php"); // Redirect setelah berhasil
    exit;
}

