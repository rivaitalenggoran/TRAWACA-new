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

        <!-- Simpan nama gambar lama jika tidak upload baru -->
        <input type="hidden" name="gambar_lama" value="<?= isset($row['gambar_kegiatan_luaran']) ? $row['gambar_kegiatan_luaran'] : ''; ?>">

        <div class="mb-3">
            <label for="gambar_kegiatan_luaran" class="form-label">Gambar Kegiatan</label>
            <input type="file" name="gambar_kegiatan_luaran" class="form-control" id="gambar_kegiatan_luaran">
            <?php if (!empty($row['gambar_kegiatan_luaran'])): ?>
                <img src="../../uploads/<?= $row['gambar_kegiatan_luaran']; ?>" alt="Gambar Kegiatan" class="img-fluid mt-2" width="200">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="waktu_kegiatan_luaran" class="form-label">Waktu Kegiatan Luaran</label>
            <input type="text" name="waktu_kegiatan_luaran" class="form-control" placeholder="Waktu Kegiatan" 
                value="<?= $row['waktu_kegiatan_luaran'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="link_kegiatan_luaran" class="form-label">Link Kegiatan Luaran</label>
            <input type="text" name="link_kegiatan_luaran" class="form-control" placeholder="Link Kegiatan" 
                value="<?= $row['link_kegiatan_luaran'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" placeholder="Kode Bahasa" 
                value="<?= $row['kode_bahasa'] ?? ''; ?>" required>
        </div>

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
