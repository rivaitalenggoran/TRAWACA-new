<?php
include(__DIR__ . '../../config/database.php');



// ambil id (untuk edit bahasa)
$id = isset($_GET['edit']) ? $_GET['edit'] : null;



//ambil id (untuk tambah bahasa dari id yang sudah ada)
$id_header_bahasa = isset($_GET['id_header']) ? $_GET['id_header'] : null;



// Query SELECT beranda_header dan beranda_header_bahasa (Join)
$query = "
    SELECT 
        bh.id_header,
        bh.nama_header,
        bhb.id_bahasa,
        bhb.id_header,
        bhb.kode_bahasa,
        bhb.header,
        bhb.sub_header
    FROM 
        beranda_header bh
    JOIN 
        beranda_header_bahasa bhb ON bh.id_header = bhb.id_header";
$stmt = $pdo->prepare($query);
$stmt->execute();
$HeaderBeranda = $stmt->fetchAll(PDO::FETCH_ASSOC);


$listidheaderberanda = [];
foreach ($HeaderBeranda as $headerberanda) {
    $listidheaderberanda [] = $headerberanda["id_header"]; 
};



// Create atau Update Header Beranda Bahasa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_header = $_POST['nama_header'] ?? '';
    $id_bahasa = $_POST['id_bahasa'] ?? ''; // id_bahasa sebagai primary key di tabel beranda_header_bahasa
    $id_header = $_POST['id_header'] ?? null; // id_header yang dipilih
    $kode_bahasa = $_POST['kode_bahasa'];
    $header = $_POST['header'];
    $sub_header = $_POST['sub_header'];
    if ($id) {
        // Update record beranda_header_bahasa(header_beranda_edit.php)
        $stmt = $pdo->prepare("UPDATE beranda_header_bahasa SET header=?, sub_header=? WHERE id_bahasa=?");
        $stmt->execute([$header, $sub_header, $id]);
    }
    elseif ($id_header_bahasa) {
        // tambah bahasa dari id_header yang sudah ada(header_beranda_tambah_bahasa.php)
        $stmtBahasa = $pdo->prepare("INSERT INTO beranda_header_bahasa (id_header,kode_bahasa, header,sub_header)
        VALUES (?,?,?,?)");
        $stmtBahasa->execute([$id_header_bahasa, $kode_bahasa, $header,$sub_header]);
    }
    else {
        // Insert baru ke beranda_header_bahasa(header_beranda_tambah.php)
        $stmt = $pdo->prepare("INSERT INTO beranda_header (nama_header) VALUES (?)");
        $stmt->execute([$nama_header]);

        //ambil id terakhir yang di insert
        $id_header = $pdo->lastInsertId();
        $stmtBahasa = $pdo->prepare("INSERT INTO beranda_header_bahasa (id_header,kode_bahasa, header,sub_header)
        VALUES (?,?,?,?)");
        $stmtBahasa->execute([$id_header, $kode_bahasa, $header,$sub_header]);
    }
    header("Location: ../beranda_dashboard.php");
    exit;}


    
// Query untuk tampilkan data update (edit)
if ($id) {
    $stmt = $pdo->prepare(" SELECT id_bahasa,kode_bahasa,header,sub_header FROM beranda_header_bahasa WHERE id_bahasa = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);}



// Delete Header Beranda Bahasa
if (isset($_GET['deleteheaderberanda'])) {
    $id_bahasa = $_GET['deleteheaderberanda'];
    $stmt = $pdo->prepare("SELECT id_header FROM beranda_header_bahasa WHERE id_bahasa = :id_bahasa");
    $stmt->execute([':id_bahasa' => $id_bahasa]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_header = $result['id_header'];
        // Hapus data bahasa
        $stmt_delete = $pdo->prepare("DELETE FROM beranda_header_bahasa WHERE id_bahasa = :id_bahasa");
        $stmt_delete->execute([':id_bahasa' => $id_bahasa]);

        // Cek apakah masih ada bahasa lain untuk id_header tersebut
        $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM beranda_header_bahasa WHERE id_header = :id_header");
        $stmt_check->execute([':id_header' => $id_header]);
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($data_check['total'] == 0) {
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM beranda_header WHERE id_header = :id_header");
            $stmt_parent->execute([':id_header' => $id_header]);}}

    header("Location: ../Adminn/beranda_dashboard.php");
    exit;}  
    
?>
