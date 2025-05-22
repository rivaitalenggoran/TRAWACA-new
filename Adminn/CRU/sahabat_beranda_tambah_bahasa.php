<?php
include '../../backend/admin_sahabat_beranda_backend.php';  // Pastikan file backend sudah sesuai dengan nama dan path yang benar

// Ambil id_kegiatan dari URL jika ada
$id_sahabat_bahasa = isset($_GET['id_sahabat']) ? $_GET['id_sahabat'] : null;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sahabat</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Tambah Bahasa Sahabat</h2>
    <h4> ID KEGIATAN: <?php echo $id_sahabat_bahasa; ?></h4>
    <!-- Form untuk Edit atau Tambah Sahabat -->
    <form method="POST" class="mb-3">
        <input type="hidden" name="id_sahabat" id="id_sahabat" value="<?php echo isset($row['id_sahabat']) ? $row['id_sahabat'] : ''; ?>">
        
        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" placeholder="Kode Bahasa" 
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_sahabat" class="form-label">Nama Sahabat</label>
            <input type="text" name="nama_sahabat" class="form-control" placeholder="Nama Sahabat" 
                value="<?php echo isset($row['nama_sahabat']) ? $row['nama_sahabat'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_waktu_kerjasama" class="form-label">Nama Waktu Kerjasama</label>
            <input type="text" name="nama_waktu_kerjasama" class="form-control" placeholder="Nama Waktu Kerjasama" 
                value="<?php echo isset($row['nama_waktu_kerjasama']) ? $row['nama_waktu_kerjasama'] : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>