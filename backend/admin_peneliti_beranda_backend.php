<?php


include(__DIR__ . '../../config/database.php');

// cek username admin
// if (!isset($_SESSION['username'])) {
//     header('Location: ../login.php');
//     exit;
// }

// Peneliti Utama Beranda--------------------------------------------------------------------------------------------------------------------------
// Query SELECT Data profil_peneliti, profil_peneliti_bahasa dan Filter Kode Bahasa
$queryPeneliti = "
    SELECT
        pp.id_peneliti, 
        pp.nama_peneliti,
        pp.email_peneliti,
        pp.keterangan_tambahan,
        ppb.id_bahasa,
        ppb.kode_bahasa, 
        ppb.bidang_minat,
        ppb.institusi_peneliti
    FROM 
        profil_peneliti pp
    JOIN 
        profil_peneliti_bahasa ppb ON pp.id_peneliti = ppb.id_peneliti";
$stmtPeneliti = $pdo->prepare($queryPeneliti);
$stmtPeneliti->execute();
$Peneliti = $stmtPeneliti->fetchAll(PDO::FETCH_ASSOC);





// Create, Update Peneliti Utama Beranda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_peneliti = $_POST['id_peneliti'] ?? '';  // ID peneliti jika ada
    $nama_peneliti = $_POST['nama_peneliti'];
    $email_peneliti = $_POST['email_peneliti'];
    $keterangan_tambahan = $_POST['keterangan_tambahan'];
    $kode_bahasa = $_POST['kode_bahasa'];
    $bidang_minat = $_POST['bidang_minat'];
    $institusi_peneliti = $_POST['institusi_peneliti'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($id_peneliti) {
        // Update existing record
        $stmt = $pdo->prepare("
            UPDATE profil_peneliti 
            SET nama_peneliti = ?, email_peneliti = ?, keterangan_tambahan = ? 
            WHERE id_peneliti = ?");
        $stmt->execute([$nama_peneliti, $email_peneliti, $keterangan_tambahan, $id_peneliti]);

        // Update profil_peneliti_bahasa
        $stmtBahasa = $pdo->prepare("
            UPDATE profil_peneliti_bahasa 
            SET kode_bahasa = ?, bidang_minat = ?, institusi_peneliti = ? 
            WHERE id_peneliti = ?");
        $stmtBahasa->execute([$kode_bahasa, $bidang_minat, $institusi_peneliti, $id_peneliti]);
    } else {
        // Create new record
        $stmt = $pdo->prepare("
            INSERT INTO profil_peneliti (nama_peneliti, email_peneliti, keterangan_tambahan) 
            VALUES (?, ?, ?)");
        $stmt->execute([$nama_peneliti, $email_peneliti, $keterangan_tambahan]);

        // Get the last inserted id_peneliti
        $id_peneliti = $pdo->lastInsertId();

        // Insert into profil_peneliti_bahasa
        $stmtBahasa = $pdo->prepare("
            INSERT INTO profil_peneliti_bahasa (id_peneliti, kode_bahasa, bidang_minat, institusi_peneliti) 
            VALUES (?, ?, ?, ?)");
        $stmtBahasa->execute([$id_peneliti, $kode_bahasa, $bidang_minat, $institusi_peneliti]);

        // Insert new user
        $stmtuser = $pdo->prepare("INSERT INTO users (username, password, role,id_peneliti) VALUES (?, ?, ?,?)");
        $stmtuser->execute([$username, $password, $role, $id_peneliti]);
    }

    header("Location: ../user_dashboard.php");  // Redirect after create or update
    exit;
}

// Query untuk tampilkan data update peneliti
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];  // Ambil ID peneliti dari UR
    $stmt = $pdo->prepare("
        SELECT pp.*, ppb.* 
        FROM profil_peneliti pp
        JOIN profil_peneliti_bahasa ppb 
        ON pp.id_peneliti = ppb.id_peneliti 
        WHERE ppb.id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}


// Delete Peneliti Utama Beranda
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
            // hapus akun
            $stmt_user =  $pdo->prepare("DELETE FROM users WHERE id_peneliti = :id_peneliti");
            $stmt_user->execute([':id_peneliti' => $id_peneliti]);
            // Jika tidak ada bahasa lagi, hapus header
            $stmt_parent = $pdo->prepare("DELETE FROM profil_peneliti WHERE id_peneliti = :id_peneliti");
            $stmt_parent->execute([':id_peneliti' => $id_peneliti]);
        }}

    header("Location: ../Adminn/user_dashboard.php");
    exit;} 
// Peneliti Utama Beranda--------------------------------------------------------------------------------------------------------------------------
?>
