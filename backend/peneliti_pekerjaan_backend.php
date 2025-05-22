<?php
include(__DIR__ . '../../config/database.php');

session_start();
if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;
}

// Ambil ID untuk update pekerjaan_bahasa
$id = isset($_GET['edit']) ? $_GET['edit'] : null;

// Ambil ID pekerjaan untuk tambah bahasa baru pada pekerjaan yang sudah ada
$id_pekerjaan_bahasa = isset($_GET['id_pekerjaan']) ? $_GET['id_pekerjaan'] : null;

// Ambil semua data pekerjaan milik peneliti
$queryPekerjaan = "
    SELECT 
        pp.id_pekerjaan,
        pp.id_peneliti,
        ppb.id_bahasa,
        ppb.kode_bahasa,
        ppb.nama_instansi,
        ppb.pekerjaan,
        ppb.waktu_pekerjaan,
        ppb.keterangan_tambahan
    FROM pekerjaan_peneliti pp
    JOIN pekerjaan_peneliti_bahasa ppb ON pp.id_pekerjaan = ppb.id_pekerjaan
    WHERE pp.id_peneliti = :id_peneliti";

$stmtPekerjaan = $pdo->prepare($queryPekerjaan);
$stmtPekerjaan->bindParam(':id_peneliti', $id_peneliti, PDO::PARAM_INT);
$stmtPekerjaan->execute();
$selected_pekerjaan = $stmtPekerjaan->fetchAll(PDO::FETCH_ASSOC);

// Tambah atau Update Pekerjaan Peneliti
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bahasa = $_POST['id_bahasa'] ?? '';
    $id_pekerjaan = $_POST['id_pekerjaan'] ?? $id_pekerjaan_bahasa;
    $kode_bahasa = $_POST['kode_bahasa'];
    $nama_instansi = $_POST['nama_instansi'];
    $pekerjaan = $_POST['pekerjaan'];
    $waktu_pekerjaan = $_POST['waktu_pekerjaan'];
    $keterangan_tambahan = $_POST['keterangan_tambahan'];

    // Update data bahasa pekerjaan
    if ($id) {
        $stmt = $pdo->prepare("
            UPDATE pekerjaan_peneliti_bahasa
            SET nama_instansi = ?, pekerjaan = ?, waktu_pekerjaan = ?, keterangan_tambahan = ?
            WHERE id_bahasa = ?");
        $stmt->execute([$nama_instansi, $pekerjaan, $waktu_pekerjaan, $keterangan_tambahan, $id]);

    // Tambah bahasa baru dari pekerjaan yang sudah ada
    } elseif ($id_pekerjaan_bahasa) {
        $stmt = $pdo->prepare("
            INSERT INTO pekerjaan_peneliti_bahasa (id_pekerjaan, kode_bahasa, nama_instansi, pekerjaan, waktu_pekerjaan, keterangan_tambahan)
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_pekerjaan_bahasa, $kode_bahasa, $nama_instansi, $pekerjaan, $waktu_pekerjaan, $keterangan_tambahan]);

    // Tambah data pekerjaan baru beserta bahasa utamanya
    } else {
        $stmt = $pdo->prepare("INSERT INTO pekerjaan_peneliti (id_peneliti) VALUES (?)");
        $stmt->execute([$id_peneliti]);
        $id_pekerjaan_baru = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO pekerjaan_peneliti_bahasa (id_pekerjaan, kode_bahasa, nama_instansi, pekerjaan, waktu_pekerjaan, keterangan_tambahan)
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_pekerjaan_baru, $kode_bahasa, $nama_instansi, $pekerjaan, $waktu_pekerjaan, $keterangan_tambahan]);
    }

    header("Location: ../pekerjaan_dashboard.php");
    exit;
}

// Ambil data pekerjaan untuk form update
if ($id) {
    $stmt = $pdo->prepare("
        SELECT pp.*, ppb.id_bahasa, ppb.kode_bahasa, ppb.nama_instansi, ppb.pekerjaan, ppb.waktu_pekerjaan, ppb.keterangan_tambahan
        FROM pekerjaan_peneliti pp
        JOIN pekerjaan_peneliti_bahasa ppb ON pp.id_pekerjaan = ppb.id_pekerjaan
        WHERE ppb.id_bahasa = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data pekerjaan (bahasa)
if (isset($_GET['deletepekerjaan'])) {
    $id_bahasa = $_GET['deletepekerjaan'];
    $stmt = $pdo->prepare("SELECT id_pekerjaan FROM pekerjaan_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_pekerjaan = $result['id_pekerjaan'];

        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM pekerjaan_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain untuk id_pekerjaan tersebut
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM pekerjaan_peneliti_bahasa WHERE id_pekerjaan = :id_pekerjaan");
        $stmt_check->execute([':id_pekerjaan' => $id_pekerjaan]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($data_check['total'] == 0) {
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM pekerjaan_peneliti WHERE id_pekerjaan = :id_pekerjaan");
            $stmt_parent->execute([':id_pekerjaan' => $id_pekerjaan]);
        }}

    header("Location: ../peneliti/pekerjaan_dashboard.php");
    exit;} 
?>
