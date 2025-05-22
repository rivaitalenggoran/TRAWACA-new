<?php
include '../../backend/peneliti_tautan_backend.php';  // Pastikan file backend sudah sesuai dengan nama dan path yang benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tautan</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Tambah Tautan</h2>
    <!-- Form untuk Edit atau Tambah Kontak -->
    <form method="POST" class="mb-3">

        <div class="mb-3">
            <label for="nama_tautan" class="form-label">Nama Tautan</label>
            <input type="text" name="nama_tautan" class="form-control" placeholder="Nama Tautan" 
                value="<?php echo isset($row['nama_tautan']) ? $row['nama_tautan'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="link_tautan" class="form-label">Link Tautan</label>
            <input type="text" name="link_tautan" class="form-control" placeholder="Link Tautan" 
                value="<?php echo isset($row['link_tautan']) ? $row['link_tautan'] : ''; ?>" required>
        </div>

        <button type="tautan_submit" name="tautan_submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
