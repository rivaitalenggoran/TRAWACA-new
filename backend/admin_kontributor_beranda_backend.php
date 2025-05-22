<?php
include(__DIR__ . '../../config/database.php');


// Kontributor Beranda-------------------------------------------------------------------------------------------------------
$queryKontributor = "
    SELECT 
        id_kontributor,
        nama_kontributor,
        semester_kontributor 
    FROM 
        kontributor";
$stmtKontributor = $pdo->prepare($queryKontributor);
$stmtKontributor->execute();
$Kontributor = $stmtKontributor->fetchAll(PDO::FETCH_ASSOC);

// Create, Update Kontributor Beranda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_kontributor'] ?? '';
    $nama_kontributor = $_POST['nama_kontributor'];
    $semester_kontributor = $_POST['semester_kontributor'];

    if ($id) {
        // Update existing record
        $stmt = $pdo->prepare("UPDATE kontributor SET nama_kontributor=?, semester_kontributor=? WHERE id_kontributor=?");
        $stmt->execute([$nama_kontributor, $semester_kontributor,  $id]);
    } else {
        // Create new record
        $stmt = $pdo->prepare("INSERT INTO kontributor (nama_kontributor, semester_kontributor) VALUES (?, ?)");
        $stmt->execute([$nama_kontributor, $semester_kontributor]);
    }
    header("Location: ../beranda_dashboard.php");
    exit;
}

// Query untuk tampilkan data update kontributor
if (isset($_GET['edit'])) {
    $id_kontributor = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM kontributor WHERE id_kontributor= ?");
    $stmt->execute([$id_kontributor]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}



// Delete kontributor Beranda
if (isset($_GET['deletekontributor'])) {
    $id_kontributor = $_GET['deletekontributor'];
    $stmt = $pdo->prepare("DELETE FROM kontributor WHERE id_kontributor = ?");
    $stmt->execute([$id_kontributor]);
    header("Location: ../Adminn/beranda_dashboard.php");
    exit;
}

// Kontributor Beranda-------------------------------------------------------------------------------------------------------
