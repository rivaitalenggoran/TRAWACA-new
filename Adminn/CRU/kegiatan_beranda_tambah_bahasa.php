<?php
include '../../backend/admin_kegiatan_beranda_backend.php';  // Pastikan file backend sudah sesuai dengan nama dan path yang benar

// Ambil id_kegiatan dari URL jika ada
$id_kegiatan_bahasa = isset($_GET['id_kegiatan']) ? $_GET['id_kegiatan'] : null;


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

    <h4> ID KEGIATAN: <?php echo $id_kegiatan_bahasa; ?></h4>
    <!-- Form untuk Tambah Bahasa Kegiatan -->
    <form method="POST" class="mb-3">

        <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="<?= isset($row['id_kegiatan']) ? $row['id_kegiatan'] : ''; ?>">
        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" placeholder="Kode Bahasa" 
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_kegiatan_luaran" class="form-label">Nama Kegiatan Luaran</label>
            <input type="text" name="nama_kegiatan_luaran" class="form-control" placeholder="Nama Kegiatan" 
                value="<?php echo isset($row['nama_kegiatan_luaran']) ? $row['nama_kegiatan_luaran'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
            <textarea name="deskripsi_kegiatan_luaran" class="form-control" 
            placeholder="Deskripsi Kegiatan" rows="4" required><?php echo isset($row['deskripsi_kegiatan_luaran']) ? $row['deskripsi_kegiatan_luaran'] : ''; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="nama_link" class="form-label">Nama Link</label>
            <input type="text" name="nama_link" class="form-control" placeholder="Nama Link Kegiatan" 
                value="<?php echo isset($row['nama_link']) ? $row['nama_link'] : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
