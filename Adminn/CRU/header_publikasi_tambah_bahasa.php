<?php
// Include backend untuk menghubungkan dengan database
include '../../backend/admin_header_publikasi_backend.php';

// Ambil id_header dari URL jika ada
$id_header_bahasa = isset($_GET['id_header']) ? $_GET['id_header'] : null;

// Query untuk mengambil nama_header berdasarkan id_header
$query = "SELECT nama_header FROM publikasi_peneliti_header WHERE id_header = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id_header_bahasa]);
$header = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika id_header tidak ditemukan, arahkan kembali ke halaman pilih header
if (!$header) {
    header("Location: pilih_header.php"); // Ganti sesuai dengan halaman pilih_header.php
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Header Bahasa</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Tambah Header Publikasi Bahasa</h2>

    <h4>Header: <?php echo htmlspecialchars($header['nama_header']); ?></h4>

    <!-- Form Tambah Bahasa -->
    <form method="POST" class="mb-3">

        <!-- Kode Bahasa -->
        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" placeholder="Masukkan Kode Bahasa (contoh: id, en, jw)" required>
        </div>

        <!-- Header -->
        <div class="mb-3">
            <label for="header" class="form-label">Header</label>
            <input type="text" name="header" class="form-control" placeholder="Isi Header" required>
        </div>

        <!-- Sub Header -->
        <div class="mb-3">
            <label for="sub_header" class="form-label">Sub Header</label>
            <input type="text" name="sub_header" class="form-control" placeholder="Isi Sub Header (opsional)">
        </div>

        <!-- Input Hidden untuk id_header -->
        <input type="hidden" name="id_header" value="<?= $id_header_bahasa ?>">

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>

</body>
</html>
