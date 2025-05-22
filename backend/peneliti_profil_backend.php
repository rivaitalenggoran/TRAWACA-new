<?php
include(__DIR__ . '../../config/database.php');

session_start();
if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;
}

// Ambil ID untuk update profil_peneliti_bahasa
$id = isset($_GET['edit']) ? $_GET['edit'] : null;

// Ambil ID profil_peneliti untuk tambah bahasa baru
$id_profil_bahasa = isset($_GET['id_peneliti']) ? $_GET['id_peneliti'] : null;

// Ambil semua data profil milik peneliti
$queryProfil = "
    SELECT 
        pp.id_peneliti,
        pp.nama_peneliti,
        pp.email_peneliti,
        pp.keterangan_tambahan,
        ppb.id_bahasa,
        ppb.kode_bahasa,
        ppb.bidang_minat,
        ppb.institusi_peneliti
    FROM profil_peneliti pp
    JOIN profil_peneliti_bahasa ppb ON pp.id_peneliti = ppb.id_peneliti
    WHERE pp.id_peneliti = :id_peneliti";

$stmtProfil = $pdo->prepare($queryProfil);
$stmtProfil->bindParam(':id_peneliti', $id_peneliti, PDO::PARAM_INT);
$stmtProfil->execute();
$selected_profil = $stmtProfil->fetchAll(PDO::FETCH_ASSOC);

// Tambah atau Update Profil Peneliti
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bahasa = $_POST['id_bahasa'] ?? '';
    $id_profil = $_POST['id_peneliti'] ?? $id_profil_bahasa;
    $nama_peneliti = $_POST['nama_peneliti'];
    $email_peneliti = $_POST['email_peneliti'];
    $keterangan_tambahan = $_POST['keterangan_tambahan'];
    $kode_bahasa = $_POST['kode_bahasa'];
    $bidang_minat = $_POST['bidang_minat'];
    $institusi_peneliti = $_POST['institusi_peneliti'];

    // Update data bahasa profil
    if ($id) {
        $stmt = $pdo->prepare("
            UPDATE profil_peneliti_bahasa 
            SET kode_bahasa = ?, bidang_minat = ?, institusi_peneliti = ?
            WHERE id_bahasa = ?");
        $stmt->execute([$kode_bahasa, $bidang_minat, $institusi_peneliti, $id]);

    // Tambah bahasa baru untuk profil yang sudah ada
    } elseif ($id_profil_bahasa) {
        $stmt = $pdo->prepare("
            INSERT INTO profil_peneliti_bahasa (id_peneliti, kode_bahasa, bidang_minat, institusi_peneliti)
            VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_profil_bahasa, $kode_bahasa, $bidang_minat, $institusi_peneliti]);

    // Tambah data profil baru beserta bahasa utama
    } else {
        $stmt = $pdo->prepare("INSERT INTO profil_peneliti (nama_peneliti, email_peneliti, keterangan_tambahan) VALUES (?, ?, ?)");
        $stmt->execute([$nama_peneliti, $email_peneliti, $keterangan_tambahan]);
        $id_profil_baru = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO profil_peneliti_bahasa (id_peneliti, kode_bahasa, bidang_minat, institusi_peneliti)
            VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_profil_baru, $kode_bahasa, $bidang_minat, $institusi_peneliti]);
    }

    header("Location: ../profil_dashboard.php");
    exit;
}

// Ambil data profil untuk form update
if ($id) {
    $stmt = $pdo->prepare("
        SELECT pp.*, ppb.id_bahasa, ppb.kode_bahasa, ppb.bidang_minat, ppb.institusi_peneliti
        FROM profil_peneliti pp
        JOIN profil_peneliti_bahasa ppb ON pp.id_peneliti = ppb.id_peneliti
        WHERE ppb.id_bahasa = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data profil (semua bahasa + header)
if (isset($_GET['deletepeneliti'])) {
    $id_bahasa = $_GET['deletepeneliti'];
    $stmt = $pdo->prepare("SELECT id_peneliti FROM profil_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_peneliti = $result['id_peneliti'];

        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM profil_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain untuk id_peneliti tersebut
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM profil_peneliti_bahasa WHERE id_peneliti = :id_peneliti");
        $stmt_check->execute([':id_peneliti' => $id_peneliti]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($data_check['total'] == 0) {
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM profil_peneliti WHERE id_peneliti = :id_peneliti");
            $stmt_parent->execute([':id_peneliti' => $id_peneliti]);
        }}

    header("Location: ../peneliti/profil_dashboard.php");
    exit;} 
?>
