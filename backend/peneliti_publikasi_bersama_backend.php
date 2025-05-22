<?php
include(__DIR__ . '../../config/database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;
}

$id_publikasi_bersama_parent = $_GET['edit'] ?? null;

// Ambil semua publikasi bersama milik peneliti ini
$queryPublikasi = "
    SELECT 
        pbp.id_publikasi_bersama_parent,
        pbp.tahun_publikasi,
        pbp.nama_publikasi,
        pbp.hari_tanggal_publikasi,
        pbp.tempat_publikasi,
        pbp.tautan_publikasi,
        pbc.id_publikasi_bersama_child,
        pbc.nama_peneliti
    FROM 
        publikasi_bersama_parent pbp
    JOIN 
        publikasi_bersama_child pbc ON pbp.id_publikasi_bersama_parent = pbc.id_publikasi_bersama_parent
    WHERE 
        pbc.id_peneliti = ?
";
$stmtPublikasi = $pdo->prepare($queryPublikasi);
$stmtPublikasi->execute([$id_peneliti]);
$selected_publikasi_bersama = $stmtPublikasi->fetchAll(PDO::FETCH_ASSOC);

// Tambah atau Update Publikasi Bersama
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_publikasi_bersama_parent = $_POST['id_publikasi_bersama_parent'] ?? '';
    $tahun_publikasi = $_POST['tahun_publikasi'];
    $nama_publikasi = $_POST['nama_publikasi'];
    $nama_peneliti = $_POST['nama_peneliti'];
    $hari_tanggal_publikasi = $_POST['hari_tanggal_publikasi'];
    $tempat_publikasi = $_POST['tempat_publikasi'];
    $tautan_publikasi = $_POST['tautan_publikasi'];
    $id_peneliti_array = $_POST['id_peneliti'];


    if ($id_publikasi_bersama_parent) {
        // Update parent
        $stmt = $pdo->prepare("UPDATE publikasi_bersama_parent
            SET tahun_publikasi = ?, nama_publikasi = ?, hari_tanggal_publikasi = ?, tempat_publikasi = ?, tautan_publikasi = ?
            WHERE id_publikasi_bersama_parent = ?");
        $stmt->execute([$tahun_publikasi, $nama_publikasi, $hari_tanggal_publikasi, $tempat_publikasi, $tautan_publikasi, $id_publikasi_bersama_parent]);

        // Update child
        $stmt = $pdo->prepare("UPDATE publikasi_bersama_child
            SET nama_peneliti = ?
            WHERE id_publikasi_bersama_parent = ?");
        $stmt->execute([$nama_peneliti, $id_publikasi_bersama_parent]);

    } else {
        // Insert ke parent
        $stmt = $pdo->prepare("INSERT INTO publikasi_bersama_parent (tahun_publikasi, nama_publikasi, hari_tanggal_publikasi, tempat_publikasi, tautan_publikasi)
            VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$tahun_publikasi, $nama_publikasi, $hari_tanggal_publikasi, $tempat_publikasi, $tautan_publikasi]);

        $last_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO publikasi_bersama_child (id_publikasi_bersama_parent, id_peneliti, nama_peneliti)
            VALUES (?, ?, ?)");

        foreach ($id_peneliti_array as $id_peneliti_item) {
            $stmt->execute([$last_id, $id_peneliti_item, $nama_peneliti]);
}
    }

    header("Location: ../publikasi_dashboard.php");
    exit;
}

// Ambil data untuk edit
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("
        SELECT 
            pbp.*, pbc.nama_peneliti 
        FROM 
            publikasi_bersama_parent pbp
        JOIN 
            publikasi_bersama_child pbc ON pbp.id_publikasi_bersama_parent = pbc.id_publikasi_bersama_parent
        WHERE 
            pbp.id_publikasi_bersama_parent = ? AND pbc.id_peneliti = ?
    ");
    $stmt->execute([$id_publikasi_bersama_parent, $id_peneliti]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus publikasi
if (isset($_GET['deletepublikasibersama'])) {
    $id_publikasi_bersama_parent = $_GET['deletepublikasibersama'];
    $stmt = $pdo->prepare("DELETE FROM publikasi_bersama_parent WHERE id_publikasi_bersama_parent = ?");
    $stmt->execute([$id_publikasi_bersama_parent]);
    header("Location: ../peneliti/publikasi_dashboard.php");
    exit;
}
