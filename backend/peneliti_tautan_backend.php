<?php
include(__DIR__ . '../../config/database.php');

session_start();
if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    // Tangani jika session id_peneliti tidak ditemukan
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;
}

// Tautan Peneliti -------------------------------------------------------------
$queryTautan = "SELECT id_tautan, id_peneliti, nama_tautan, link_tautan FROM tautan_peneliti WHERE id_peneliti = $id_peneliti";
$stmtTautan = $pdo->query($queryTautan);
$selected_tautan = $stmtTautan->fetchAll(PDO::FETCH_ASSOC);

// Tambah atau Update Tautan Peneliti
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tautan_submit'])) {
    $id_tautan = $_POST['id_tautan'] ?? '';
    $nama_tautan = $_POST['nama_tautan'];
    $link_tautan = $_POST['link_tautan'];

    if ($id_tautan) {
        // Update data tautan
        $stmt = $pdo->prepare("UPDATE tautan_peneliti SET nama_tautan = ?, link_tautan = ? WHERE id_tautan = ?");
        $stmt->execute([$nama_tautan, $link_tautan, $id_tautan]);
    } else {
        // Insert data tautan baru
        $stmt = $pdo->prepare("INSERT INTO tautan_peneliti (id_peneliti, nama_tautan, link_tautan) VALUES (?, ?, ?)");
        $stmt->execute([$id_peneliti, $nama_tautan, $link_tautan]);
    }
    header("Location: ../tautan_dashboard.php"); // Redirect setelah berhasil
    exit;
}

// Ambil Data Tautan untuk Update
if (isset($_GET['edit'])) {
    $id_tautan = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT id_tautan, nama_tautan, link_tautan FROM tautan_peneliti WHERE id_tautan = ?");
    $stmt->execute([$id_tautan]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hapus Data Tautan Peneliti
if (isset($_GET['deletetautan'])) {
    $id_tautan = $_GET['deletetautan'];
    $stmt = $pdo->prepare("DELETE FROM tautan_peneliti WHERE id_tautan = ?");
    $stmt->execute([$id_tautan]);
    
    header("Location: ../peneliti/tautan_dashboard.php"); // Redirect setelah berhasil
    exit;
}
