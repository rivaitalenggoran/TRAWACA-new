<?php
include(__DIR__ . '../../config/database.php');

session_start();
if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;
}

// Ambil ID untuk update pendidikan_bahasa
$id = isset($_GET['edit']) ? $_GET['edit'] : null;

// Ambil ID pendidikan untuk tambah bahasa baru pada pendidikan yang sudah ada
$id_pendidikan_bahasa = isset($_GET['id_pendidikan']) ? $_GET['id_pendidikan'] : null;

// Ambil semua data pendidikan milik peneliti
$queryPendidikan = "
    SELECT 
        p.id_pendidikan,
        p.id_peneliti,
        pb.id_bahasa,
        pb.kode_bahasa,
        pb.nama_instansi,
        pb.gelar,
        pb.fakultas,
        pb.tugas_akhir
    FROM pendidikan_peneliti p
    JOIN pendidikan_peneliti_bahasa pb ON p.id_pendidikan = pb.id_pendidikan
    WHERE p.id_peneliti = :id_peneliti";

$stmtPendidikan = $pdo->prepare($queryPendidikan);
$stmtPendidikan->bindParam(':id_peneliti', $id_peneliti, PDO::PARAM_INT);
$stmtPendidikan->execute();
$selected_pendidikan = $stmtPendidikan->fetchAll(PDO::FETCH_ASSOC);

// Tambah atau Update Pendidikan Peneliti
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bahasa = $_POST['id_bahasa'] ?? '';
    $id_pendidikan = $_POST['id_pendidikan'] ?? $id_pendidikan_bahasa;
    $kode_bahasa = $_POST['kode_bahasa'];
    $nama_instansi = $_POST['nama_instansi'];
    $gelar = $_POST['gelar'];
    $fakultas = $_POST['fakultas'];
    $tugas_akhir = $_POST['tugas_akhir'];

    // Update data bahasa pendidikan
    if ($id) {
        $stmt = $pdo->prepare("
            UPDATE pendidikan_peneliti_bahasa 
            SET nama_instansi = ?, gelar = ?, fakultas = ?, tugas_akhir = ?
            WHERE id_bahasa = ?");
        $stmt->execute([$nama_instansi, $gelar, $fakultas, $tugas_akhir, $id]);

    // Tambah bahasa baru dari pendidikan yang sudah ada
    } elseif ($id_pendidikan_bahasa) {
        $stmt = $pdo->prepare("
            INSERT INTO pendidikan_peneliti_bahasa (id_pendidikan, kode_bahasa, nama_instansi, gelar, fakultas, tugas_akhir)
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_pendidikan_bahasa, $kode_bahasa, $nama_instansi, $gelar, $fakultas, $tugas_akhir]);

    // Tambah data pendidikan baru beserta bahasa utamanya
    } else {
        $stmt = $pdo->prepare("INSERT INTO pendidikan_peneliti (id_peneliti) VALUES (?)");
        $stmt->execute([$id_peneliti]);
        $id_pendidikan_baru = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO pendidikan_peneliti_bahasa (id_pendidikan, kode_bahasa, nama_instansi, gelar, fakultas, tugas_akhir)
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_pendidikan_baru, $kode_bahasa, $nama_instansi, $gelar, $fakultas, $tugas_akhir]);
    }

    header("Location: ../pendidikan_dashboard.php");
    exit;
}

// Ambil data pendidikan untuk form update
if ($id) {
    $stmt = $pdo->prepare("
        SELECT p.*, pb.id_bahasa, pb.kode_bahasa, pb.nama_instansi, pb.gelar, pb.fakultas, pb.tugas_akhir
        FROM pendidikan_peneliti p
        JOIN pendidikan_peneliti_bahasa pb ON p.id_pendidikan = pb.id_pendidikan
        WHERE pb.id_bahasa = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus data pendidikan (bahasa)
if (isset($_GET['deletependidikan'])) {
    $id_bahasa = $_GET['deletependidikan'];
    $stmt = $pdo->prepare("SELECT id_pendidikan FROM pendidikan_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_pendidikan = $result['id_pendidikan'];

        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM pendidikan_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain untuk id_pendidikan tersebut
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM pendidikan_peneliti_bahasa WHERE id_pendidikan = :id_pendidikan");
        $stmt_check->execute([':id_pendidikan' => $id_pendidikan]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($data_check['total'] == 0) {
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM pendidikan_peneliti WHERE id_pendidikan = :id_pendidikan");
            $stmt_parent->execute([':id_pendidikan' => $id_pendidikan]);
        }}

    header("Location: ../peneliti/pendidikan_dashboard.php");
    exit;} 
?>
