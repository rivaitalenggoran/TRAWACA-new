<?php
include '../../backend/admin_header_profil_backend.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Header Profil</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<h2 class="text-center mb-4">Manajemen Tambah Header Profil</h2>

<!-- Form untuk Edit atau Tambah -->
<form method="POST" class="mb-3">
    <input type="hidden" name="id_header" id="id_header" value="<?= isset($row['id_header']) ? $row['id_header'] : ''; ?>">
    <input type="hidden" name="id_bahasa" id="id_bahasa" value="<?= isset($row['id_bahasa']) ? $row['id_bahasa'] : ''; ?>">

    <div class="mb-3">
        <label for="nama_header" class="form-label">Nama Header</label>
        <input type="text" name="nama_header" class="form-control" placeholder="nama header" value="<?= isset($row['nama_header']) ? $row['nama_header'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
        <input type="text" name="kode_bahasa" class="form-control" placeholder="Kode Bahasa" value="<?= isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="header" class="form-label">Header</label>
        <input type="text" name="header" class="form-control" placeholder="Header" value="<?= isset($row['header']) ? $row['header'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="sub_header" class="form-label">Sub Header</label>
        <input type="text" name="sub_header" class="form-control" placeholder="Sub Header" value="<?= isset($row['sub_header']) ? $row['sub_header'] : ''; ?>">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

</div>

</body>
</html>