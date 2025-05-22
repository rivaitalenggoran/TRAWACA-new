<?php
include '../../backend/admin_kontak_beranda_backend.php';  // Pastikan file backend sudah sesuai dengan nama dan path yang benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kontak</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Kontak</h2>
    <!-- Form untuk Edit atau Tambah Kontak -->
    <form method="POST" class="mb-3">
        <input type="hidden" name="id_kontak" id="id_kontak" value="<?php echo isset($row['id_kontak']) ? $row['id_kontak'] : ''; ?>">

        <div class="mb-3">
            <label for="nama_kontak" class="form-label">Nama Kontak</label>
            <input type="text" name="nama_kontak" class="form-control" placeholder="Nama Kontak" 
                value="<?php echo isset($row['nama_kontak']) ? $row['nama_kontak'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="link_kontak" class="form-label">Link Kontak</label>
            <input type="text" name="link_kontak" class="form-control" placeholder="Link Kontak" 
                value="<?php echo isset($row['link_kontak']) ? $row['link_kontak'] : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
