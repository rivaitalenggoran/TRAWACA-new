<?php

include(__DIR__ . '../../config/database.php');

// cek username admin
// if (!isset($_SESSION['username'])) {
//     header('Location: ../login.php');
//     exit;
// }

// Kontak Beranda-------------------------------------------------------------------------------------------------------
$queryKontak = "
    SELECT 
        id_kontak,
        nama_kontak,
        link_kontak 
    FROM 
        kontak_trawaca";
$stmtKontak = $pdo->prepare($queryKontak);
$stmtKontak->execute();
$Kontak = $stmtKontak->fetchAll(PDO::FETCH_ASSOC);

// Create, Update Kontak Beranda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kontak = $_POST['id_kontak'] ?? '';  // ID kontak (jika ada)
    $nama_kontak = $_POST['nama_kontak'];    // Nama kontak
    $link_kontak = $_POST['link_kontak'];    // Link kontak

    // Jika ID kontak ada, kita lakukan update
    if ($id_kontak) {
        $stmt = $pdo->prepare("
            UPDATE kontak_trawaca 
            SET nama_kontak = ?, link_kontak = ? 
            WHERE id_kontak = ?");
        $stmt->execute([$nama_kontak, $link_kontak, $id_kontak]);
    } else {
        // Jika tidak ada ID kontak, kita buat data baru
        $stmt = $pdo->prepare("
            INSERT INTO kontak_trawaca (nama_kontak, link_kontak)
            VALUES (?, ?)");
        $stmt->execute([$nama_kontak, $link_kontak]);
    }

    // Redirect ke halaman kontak setelah melakukan create atau update
    header("Location: ../beranda_dashboard.php");
    exit;
}

// Query untuk tampilkan data update
if (isset($_GET['edit'])) {
    $id_kontak = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM kontak_trawaca WHERE id_kontak = ?");
    $stmt->execute([$id_kontak]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}


// Delete Kontak Beranda
if (isset($_GET['deletekontak'])) {
    $id_kontak = $_GET['deletekontak'];
    $stmt = $pdo->prepare("DELETE FROM kontak_trawaca WHERE id_kontak = ?");
    $stmt->execute([$id_kontak]);
    header("Location: ../Adminn/beranda_dashboard.php");
    exit;
}

// Kontak Beranda-------------------------------------------------------------------------------------------------------
?>
