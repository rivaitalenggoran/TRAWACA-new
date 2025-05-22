<?php

include(__DIR__ . '../../config/database.php');

// cek username admin
// if (!isset($_SESSION['username'])) {
//     header('Location: ../login.php');
//     exit;
// }

// bahasa-------------------------------------------------------------------------------------------------------------
$queryBahasa = "
    SELECT
        id_bahasa,
        nama_bahasa,
        link_bahasa,
        disable
    FROM 
        bahasa";
$stmtBahasa = $pdo->prepare($queryBahasa);
$stmtBahasa->execute();
$Bahasa = $stmtBahasa->fetchAll(PDO::FETCH_ASSOC);

// Create, Update Bahasa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bahasa_submit'])) {
    $id_bahasa = $_POST['id_bahasa'] ?? '';
    $nama_bahasa = $_POST['nama_bahasa'];
    $link_bahasa = $_POST['link_bahasa'];
    $disable = $_POST['disable'] ?? 0;

    if ($id_bahasa) {
        $stmt = $pdo->prepare("UPDATE bahasa SET nama_bahasa = ?, link_bahasa = ?, disable = ? WHERE id_bahasa = ?");
        $stmt->execute([$nama_bahasa, $link_bahasa, $disable, $id_bahasa]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO bahasa (nama_bahasa, link_bahasa, disable) VALUES (?, ?, ?)");
        $stmt->execute([$nama_bahasa, $link_bahasa, $disable]);
    }
    header("Location: ../bahasa_dashboard.php");
    exit;
}

// Query untuk tampilkan data update bahasa
if (isset($_GET['edit'])) {
    $id_bahasa = $_GET['edit'];  // Ambil ID bahasa
    $stmt = $pdo->prepare("SELECT * FROM bahasa WHERE id_bahasa=?");
    $stmt->execute([$id_bahasa]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Delete Bahasa
if (isset($_GET['deletebahasa'])) {
    $id_bahasa = $_GET['deletebahasa'];
    $stmt = $pdo->prepare("DELETE FROM bahasa WHERE id_bahasa=?");
    $stmt->execute([$id_bahasa]);
    header("Location: ../Adminn/bahasa_dashboard.php");
    exit;
}

?>
