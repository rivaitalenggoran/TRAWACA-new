<?php
include(__DIR__ . '../../config/database.php');



// Ambil ID Peneliti dari session
session_start();
if (isset($_SESSION['id_peneliti'])) {
    $id_peneliti = $_SESSION['id_peneliti'];
} else {
    // Tangani jika session id_peneliti tidak ditemukan
    echo "ID Peneliti tidak ditemukan dalam sesi.";
    exit;}



// ambil id (untuk edit  kegiatan bahasa)
$id = isset($_GET['edit']) ? $_GET['edit'] : null;



//ambil id (untuk tambah bahasa dari id yang sudah ada)
$id_karya_bahasa = isset($_GET['id_karya']) ? $_GET['id_karya'] : null;



// Query untuk mengambil data karya berdasarkan id_peneliti dari session
$queryKarya = "
    SELECT 
        ky.id_karya,
        ky.id_peneliti,
        ky.tahun_pengerjaan_karya, 
        ky.tautan_karya,
        kyt.id_bahasa,
        kyt.nama_karya,
        kyt.deskripsi_karya,
        kyt.kode_bahasa,
        kyt.nama_tautan_karya
    FROM 
        karya_peneliti ky
    JOIN 
        karya_peneliti_bahasa kyt ON ky.id_karya = kyt.id_karya
    WHERE 
        ky.id_peneliti = :id_peneliti";  // Menambahkan kondisi untuk ID Peneliti



// Menyiapkan dan mengeksekusi query
$stmtKarya = $pdo->prepare($queryKarya);
$stmtKarya->bindParam(':id_peneliti', $id_peneliti, PDO::PARAM_INT);  // Mengikat parameter id_peneliti
$stmtKarya->execute();
$selected_karya = $stmtKarya->fetchAll(PDO::FETCH_ASSOC);



// Tambah atau Update Karya Peneliti
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_bahasa = $_POST['id_bahasa'] ?? '';
    $id_karya = $_POST['id_karya'] ?? null;
    $id_penelitii = $_POST['id_peneliti'] ?? $id_peneliti;
    $tahun_pengerjaan = $_POST['tahun_pengerjaan_karya'];
    $tautan_karya = $_POST['tautan_karya'];
    $nama_karya = $_POST['nama_karya'];
    $deskripsi_karya = $_POST['deskripsi_karya'];
    $nama_tautan_karya = $_POST['nama_tautan_karya'];
    $kode_bahasa = $_POST['kode_bahasa'];  
    // Menambahkan kode_bahasa dari form
        // Update karya bahasa yang sudah ada
        if ($id) {
            $stmt = $pdo->prepare("
                UPDATE karya_peneliti_bahasa
                SET nama_karya = ?, deskripsi_karya = ?, nama_tautan_karya = ?
                WHERE id_bahasa = ?");
            $stmt->execute([$nama_karya, $deskripsi_karya, $nama_tautan_karya, $id]);}

        // Tambah bahasa dari karya yang sudah ada
        elseif ($id_karya_bahasa) {
            $stmt = $pdo->prepare("
                INSERT INTO karya_peneliti_bahasa (id_karya, nama_karya, deskripsi_karya, kode_bahasa, nama_tautan_karya)
                VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$id_karya_bahasa, $nama_karya, $deskripsi_karya, $kode_bahasa, $nama_tautan_karya]);}

        // Buat data karya baru dan bahasa utamanya
        else {
            $stmt = $pdo->prepare("
                INSERT INTO karya_peneliti (id_peneliti, tahun_pengerjaan_karya, tautan_karya)
                VALUES (?, ?, ?)");
            $stmt->execute([$id_peneliti, $tahun_pengerjaan, $tautan_karya]);
            $id_karya_baru = $pdo->lastInsertId();
    
            $stmt = $pdo->prepare("
                INSERT INTO karya_peneliti_bahasa (id_karya, nama_karya, deskripsi_karya, kode_bahasa, nama_tautan_karya)
                VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$id_karya_baru, $nama_karya, $deskripsi_karya, $kode_bahasa, $nama_tautan_karya]);
        }
        header("Location: ../karya_dashboard.php");
        exit;  }



// Ambil Data Karya untuk Update
if ($id) {
    $id_bahasa = $_GET['edit'];
    // Query untuk mengambil data berdasarkan id_bahasa
    $stmt = $pdo->prepare("
        SELECT ky.*, kyt.id_bahasa, kyt.nama_karya, kyt.deskripsi_karya, kyt.nama_tautan_karya, kyt.kode_bahasa
        FROM karya_peneliti ky 
        JOIN karya_peneliti_bahasa kyt ON ky.id_karya = kyt.id_karya 
        WHERE kyt.id_bahasa = ?");
    $stmt->execute([$id_bahasa]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);}



// Hapus Data Karya Peneliti
if (isset($_GET['deletekarya'])) {
    $id_bahasa = $_GET['deletekarya'];
    $stmt = $pdo->prepare("SELECT id_karya FROM karya_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_karya = $result['id_karya'];

        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM karya_peneliti_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain untuk id_karya tersebut
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM karya_peneliti_bahasa WHERE id_karya = :id_karya");
        $stmt_check->execute([':id_karya' => $id_karya]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($data_check['total'] == 0) {
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM karya_peneliti WHERE id_karya = :id_karya");
            $stmt_parent->execute([':id_karya' => $id_karya]);
        }}

    header("Location: ../peneliti/karya_dashboard.php");
    exit;} 
?>
