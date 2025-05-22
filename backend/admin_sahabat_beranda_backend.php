<?php

include(__DIR__ . '../../config/database.php');


// ambil id (untuk edit  kegiatan bahasa)
$id = isset($_GET['edit']) ? $_GET['edit'] : null;


//ambil id (untuk tambah bahasa dari id yang sudah ada)
$id_sahabat_bahasa = isset($_GET['id_sahabat']) ? $_GET['id_sahabat'] : null;


// Sahabat Beranda-------------------------------------------------------------------------------------------------------
$querySahabat = "
    SELECT
        sh.id_sahabat,
        sh.nama_sahabat, 
        sht.id_bahasa, 
        sht.nama_waktu_kerjasama,
        sht.kode_bahasa
    FROM 
        sahabat_trawaca sh
    JOIN 
        sahabat_trawaca_bahasa sht ON sh.id_sahabat = sht.id_sahabat";
$stmtSahabat = $pdo->prepare($querySahabat);
$stmtSahabat->execute();
$Sahabat = $stmtSahabat->fetchAll(PDO::FETCH_ASSOC);

// Create, Update Sahabat Beranda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sahabat = $_POST['id_sahabat'] ?? '';  // ID sahabat jika ada
    $nama_sahabat = $_POST['nama_sahabat'];
    $nama_waktu_kerjasama = $_POST['nama_waktu_kerjasama'];
    $kode_bahasa = $_POST['kode_bahasa'];

    if ($id) {
        // Update data sahabat menggunakan id_bahasa
        $stmt = $pdo->prepare("
            UPDATE sahabat_trawaca_bahasa
            SET nama_waktu_kerjasama = ?
            WHERE id_bahasa = ?");
        $stmt->execute([$nama_waktu_kerjasama, $id]);
    } 

    elseif ($id_sahabat_bahasa) {
        // masukkan bahasa baru dari id_sahabat yang sudah ada
        $stmt = $pdo->prepare("
        INSERT INTO sahabat_trawaca_bahasa (id_sahabat, nama_waktu_kerjasama, kode_bahasa) 
        VALUES (?, ?, ?)");
        $stmt->execute([$id_sahabat_bahasa, $nama_waktu_kerjasama, $kode_bahasa]);
    }

    else {
        // Create new record
        $stmt = $pdo->prepare("
            INSERT INTO sahabat_trawaca (nama_sahabat) 
            VALUES (?)");
        $stmt->execute([$nama_sahabat]);

        // Get the last inserted id_sahabat
        $id_sahabat = $pdo->lastInsertId();

        // Insert into sahabat_trawaca_translate
        $stmt = $pdo->prepare("
            INSERT INTO sahabat_trawaca_bahasa (id_sahabat, nama_waktu_kerjasama, kode_bahasa) 
            VALUES (?, ?, ?)");
        $stmt->execute([$id_sahabat, $nama_waktu_kerjasama, $kode_bahasa]);
    }

    header("Location: ../beranda_dashboard.php");  // Redirect after create or update
    exit;
}

// Query untuk tampilkan data update sahabat menggunakan id_bahasa
if ($id) {
    $id_bahasa= $id;  // Ambil ID sahabat dari URL
    $stmt = $pdo->prepare("
        SELECT sh.*, sht.* 
        FROM sahabat_trawaca sh
        JOIN sahabat_trawaca_bahasa sht ON sh.id_sahabat = sht.id_sahabat 
        WHERE sht.id_bahasa = ?");
    $stmt->execute([$id_bahasa]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}


// Delete Sahabat Beranda
if (isset($_GET['deletesahabat'])) {
    $id_bahasa = $_GET['deletesahabat'];
    $stmt = $pdo->prepare("SELECT id_sahabat FROM sahabat_trawaca_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_sahabat = $result['id_sahabat'];

        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM sahabat_trawaca_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain untuk id_sahabat tersebut
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM sahabat_trawaca_bahasa WHERE id_sahabat = :id_sahabat");
        $stmt_check->execute([':id_sahabat' => $id_sahabat]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($data_check['total'] == 0) {
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM sahabat_trawaca WHERE id_sahabat = :id_sahabat");
            $stmt_parent->execute([':id_sahabat' => $id_sahabat]);
        }}

    header("Location: ../Adminn/beranda_dashboard.php");
    exit;} 


// Sahabat Beranda-------------------------------------------------------------------------------------------------------
?>
