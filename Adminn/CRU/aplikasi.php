<?php
include '../../backend/admin_aplikasi_backend.php';
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
<h2 class="text-center mb-4"> Manajemen Aplikasi</h2>
<!-- Form untuk Edit atau Tambah -->
    <form method="POST" class="mb-3">
        <input type="hidden" name="id_aplikasi" id="id_aplikasi" value="<?php echo isset($row['id_aplikasi']) ? $row['id_aplikasi'] : ''; ?>">

        <div class="mb-3">
            <label for="nama_aplikasi" class="form-label">Nama Aplikasi</label>
            <input type="text" name="nama_aplikasi" class="form-control" placeholder="Nama Aplikasi" value="<?php echo isset($row['nama_aplikasi']) ? $row['nama_aplikasi'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="link_aplikasi" class="form-label">Link Aplikasi</label>
            <input type="text" name="link_aplikasi" class="form-control" placeholder="Link Aplikasi" value="<?php echo isset($row['link_aplikasi']) ? $row['link_aplikasi'] : ''; ?>" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="disable" value="1" class="form-check-input" 
            <?php echo isset($row['disable']) && $row['disable'] == 1 ? 'checked' : ''; ?>>
            <label class="form-check-label">Nonaktifkan</label>
        </div>
        <button type="submit" name="aplikasi_submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>

