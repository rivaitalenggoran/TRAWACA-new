<?php

include(__DIR__ . '../../config/database.php');

// User-------------------------------------------------------------------------------------------------------------
// Query untuk menampilkan semua user (biasanya untuk list di dashboard)
$queryUser = "
    SELECT
        id_user,
        username,
        password, -- Sebaiknya tidak menampilkan password hash di list, tapi untuk contoh ini kita biarkan
        role
    FROM 
        users";
$stmtUser = $pdo->prepare($queryUser);
$stmtUser->execute();
$User = $stmtUser->fetchAll(PDO::FETCH_ASSOC);

// Create, Update User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_submit'])) {
    $id_user = $_POST['id_user'] ?? null; // Gunakan null jika tidak ada untuk kemudahan pengecekan
    $username = trim($_POST['username']);
    $passwordPlain = trim($_POST['password']); // Ambil password dari form
    $role = $_POST['role'];

    // Opsi untuk hashing password
    $options = ['cost' => 12];

    if ($id_user) {
        // Update existing user
        $params = [$username, $role];
        $sql = "UPDATE users SET username = ?, role = ?";

        // Hanya update password jika field password diisi
        if (!empty($passwordPlain)) {
            $hashedPassword = password_hash($passwordPlain, PASSWORD_DEFAULT, $options); // PASSWORD_DEFAULT direkomendasikan
            $sql .= ", password = ?";
            $params[] = $hashedPassword;
        }

        $sql .= " WHERE id_user = ?";
        $params[] = $id_user;

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

    } else {
        // Insert new user
        // Pastikan password tidak kosong saat membuat user baru
        if (empty($passwordPlain)) {
            // Handle error: password tidak boleh kosong untuk user baru
            // Misalnya, redirect kembali ke form dengan pesan error
            // header("Location: ../user_form.php?error=password_required");
            // exit;
            die("Password tidak boleh kosong untuk user baru."); // Simplifikasi untuk contoh
        }

        $hashedPassword = password_hash($passwordPlain, PASSWORD_DEFAULT, $options);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, $role]);
    }
    // Redirect setelah operasi selesai
    // Pastikan path redirect benar. Jika file ini ada di dalam folder 'backend' misalnya,
    // dan user_dashboard.php ada di root atau folder lain, sesuaikan pathnya.
    // Contoh: jika file ini di 'backend/user_logic.php' dan dashboard di 'Adminn/user_dashboard.php'
    // maka pathnya bisa jadi "../Adminn/user_dashboard.php" (jika Adminn sejajar dengan backend)
    // atau "/proyek_anda/Adminn/user_dashboard.php" (path absolut dari root web)
    header("Location: ../user_dashboard.php"); // Sesuaikan path ini jika perlu
    exit;
}

// Query untuk tampilkan data update user (ketika form edit dimuat)
$row = null; // Inisialisasi $row
if (isset($_GET['edit'])) {
    $id_user_edit = $_GET['edit'];  // Ambil ID user
    $stmt = $pdo->prepare("SELECT id_user, username, role FROM users WHERE id_user = ?"); // Jangan ambil password hash untuk form
    $stmt->execute([$id_user_edit]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // Jika $row tidak ditemukan (misal ID tidak valid), $row akan tetap null
    // Anda mungkin ingin menangani kasus jika user tidak ditemukan
}

// Delete User
if (isset($_GET['deleteuser'])) {
    $id_user_delete = $_GET['deleteuser'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id_user = ?");
    $stmt->execute([$id_user_delete]);
    header("Location: ../Adminn/user_dashboard.php"); // Sesuaikan path ini jika perlu
    exit;
}

?>