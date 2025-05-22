<?php
include(__DIR__ . '../../config/database.php');

session_start();
if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;
}

// Ambil ID untuk update minat_bahasa
$id = isset($_GET['edit']) ? $_GET['edit'] : null;

// Ambil ID minat untuk tambah bahasa baru pada minat yang sudah ada
$id_minat_bahasa = isset($_GET['id_minat']) ? $_GET['id_minat'] : null;

// Ambil semua data minat milik peneliti
$queryMinat = "
    SELECT 
        mp.id_minat,
        mp.id_peneliti,
        mpb.id_bahasa,
        mpb.kode_bahasa,
        mpb.nama_minat,
        mpb.subtopik_minat
    FROM minat_peneliti mp
    JOIN minat_peneliti_bahasa mpb ON mp.id_minat = mpb.id_minat
    WHERE mp.id_peneliti = :id_peneliti";

$stmtMinat = $pdo->prepare($queryMinat);
$stmtMinat->bindParam(':id_peneliti', $id_peneliti, PDO::PARAM_INT);
$stmtMinat->execute();
$selected_minat = $stmtMinat->fetchAll(PDO::FETCH_ASSOC);

// Tambah atau Update Minat Peneliti
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bahasa = $_POST['id_bahasa'] ?? '';
    $id_minat = $_POST['id_minat'] ?? $id_minat_bahasa;
    $kode_bahasa = $_POST['kode_bahasa'];
    $nama_minat = $_POST['nama_minat'];
    $subtopik_minat = $_POST['subtopik_minat'];

    // Update data bahasa minat
    if ($id) {
        $stmt = $pdo->prepare("
            UPDATE minat_peneliti_bahasa
            SET nama_minat = ?, subtopik_minat = ?
            WHERE id_bahasa = ?");
        $stmt->execute([$nama_minat, $subtopik_minat, $id]);

    // Tambah bahasa baru dari minat yang sudah ada
    } elseif ($id_minat_bahasa) {
        $stmt = $pdo->prepare("
            INSERT INTO minat_peneliti_bahasa (id_minat, kode_bahasa, nama_minat, subtopik_minat)
            VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_minat_bahasa, $kode_bahasa, $nama_minat, $subtopik_minat]);

    // Tambah data minat baru beserta bahasa utamanya
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO minat_peneliti (id_peneliti)
            VALUES (?)");
        $stmt->execute([$id_peneliti]);
        $id_minat_baru = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO minat_peneliti_bahasa (id_minat, kode_bahasa, nama_minat, subtopik_minat)
            VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_minat_baru, $kode_bahasa, $nama_minat, $subtopik_minat]);
    }

    header("Location: ../minat_dashboard.php");
    exit;
}

// Ambil data minat untuk form update
if ($id) {
    $stmt = $pdo->prepare("
        SELECT mp.*, mpb.id_bahasa, mpb.nama_minat, mpb.subtopik_minat, mpb.kode_bahasa
        FROM minat_peneliti mp
        JOIN minat_peneliti_bahasa mpb ON mp.id_minat = mpb.id_minat
        WHERE mpb.id_bahasa = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data minat (bahasa)
if (isset($_GET['deleteminat'])) {
    $id_bahasa = $_GET['deleteminat'];
    $stmt = $pdo->prepare("SELECT id_minat FROM minat_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_minat = $result['id_minat'];

        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM minat_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain untuk id_minat tersebut
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM minat_peneliti_bahasa WHERE id_minat = :id_minat");
        $stmt_check->execute([':id_minat' => $id_minat]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($data_check['total'] == 0) {
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM minat_peneliti WHERE id_minat = :id_minat");
            $stmt_parent->execute([':id_minat' => $id_minat]);
        }}

    header("Location: ../peneliti/minat_dashboard.php");
    exit;} 
?>
