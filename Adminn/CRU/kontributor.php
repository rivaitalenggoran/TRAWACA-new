<?php
include '../../backend/admin_kontributor_beranda_backend.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paragraf</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<h2 class="text-center mb-4"> Manajemen Kontributor</h2>
<!-- Form untuk Edit atau Tambah -->
<form method="POST" class="mb-3">
    <input type="hidden" name="id_kontributor" id="id_kontributor" value="<?php echo isset($row['id_kontributor']) ? $row['id_kontributor'] : ''; ?>">

    <div class="mb-3">
        <label for="nama_kontributor" class="form-label">Nama Kontributor</label>
        <input type="text" name="nama_kontributor" class="form-control" placeholder="Nama Kontributor" value="<?php echo isset($row['nama_kontributor']) ? $row['nama_kontributor'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="semester_kontributor" class="form-label">Semester Kontributor</label>
        <input type="text" name="semester_kontributor" class="form-control" placeholder="Semester Kontributor" value="<?php echo isset($row['semester_kontributor']) ? $row['semester_kontributor'] : ''; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
</body>
</html>

