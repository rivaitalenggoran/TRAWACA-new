<?php
include '../../backend/admin_kegiatan_beranda_backend.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Tambah Kegiatan Beranda</h2>
    
    <!-- Form harus pakai enctype agar bisa upload file -->
    <form method="POST" enctype="multipart/form-data" class="mb-3">
        <input type="hidden" name="id_kegiatan" value="<?= isset($row['id_kegiatan']) ? $row['id_kegiatan'] : ''; ?>">
        <input type="hidden" name="id_bahasa" value="<?= isset($row['id_bahasa']) ? $row['id_bahasa'] : ''; ?>">

        <div class="mb-3">
            <label for="nama_kegiatan_luaran" class="form-label">Nama Kegiatan Luaran</label>
            <input type="text" name="nama_kegiatan_luaran" class="form-control" placeholder="Nama Kegiatan" 
                value="<?= $row['nama_kegiatan_luaran'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_kegiatan_luaran" class="form-label">Deskripsi Kegiatan Luaran</label>
            <textarea name="deskripsi_kegiatan_luaran" class="form-control" placeholder="Deskripsi Kegiatan" rows="4" required><?= $row['deskripsi_kegiatan_luaran'] ?? ''; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="nama_link" class="form-label">Nama Link</label>
            <input type="text" name="nama_link" class="form-control" placeholder="Nama Link Kegiatan" 
                value="<?= $row['nama_link'] ?? ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
