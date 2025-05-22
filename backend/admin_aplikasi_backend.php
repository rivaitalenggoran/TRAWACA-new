<?php

include(__DIR__ . '../../config/database.php');

// cek username admin
// if (!isset($_SESSION['username'])) {
//     header('Location: ../login.php');
//     exit;
// }

// Aplikasi-------------------------------------------------------------------------------------------------------------
$queryAplikasi = "
    SELECT
        id_aplikasi,
        nama_aplikasi,
        link_aplikasi,
        disable
    FROM 
        aplikasi";
$stmtAplikasi = $pdo->prepare($queryAplikasi);
$stmtAplikasi->execute();
$Aplikasi = $stmtAplikasi->fetchAll(PDO::FETCH_ASSOC);

// Create, Update Aplikasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aplikasi_submit'])) {
    $id_aplikasi = $_POST['id_aplikasi'] ?? '';
    $nama_aplikasi = $_POST['nama_aplikasi'];
    $link_aplikasi = $_POST['link_aplikasi'];
    $disable = $_POST['disable'] ?? 0;

    if ($id_aplikasi) {
        $stmt = $pdo->prepare("UPDATE aplikasi SET nama_aplikasi = ?, link_aplikasi = ?, disable = ? WHERE id_aplikasi = ?");
        $stmt->execute([$nama_aplikasi, $link_aplikasi, $disable, $id_aplikasi]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO aplikasi (nama_aplikasi, link_aplikasi, disable) VALUES (?, ?, ?)");
        $stmt->execute([$nama_aplikasi, $link_aplikasi, $disable]);
    }
    header("Location: ../aplikasi_dashboard.php");
    exit;
}



// Query untuk tampilkan data update sahabat
if (isset($_GET['edit'])) {
    $id_aplikasi = $_GET['edit'];  // Ambil ID \aplikasi
    $stmt = $pdo->prepare("SELECT * FROM aplikasi WHERE id_aplikasi=?");
    $stmt->execute([$id_aplikasi]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}


// Delete Aplikasi
if (isset($_GET['deleteaplikasi'])) {
    $id_aplikasi = $_GET['deleteaplikasi'];
    $stmt = $pdo->prepare("DELETE FROM aplikasi WHERE id_aplikasi=?");
    $stmt->execute([$id_aplikasi]);
    header("Location: ../Adminn/aplikasi_dashboard.php");
    exit;
}

?>
