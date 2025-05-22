<?php
include '../../backend/admin_bahasa_backend.php';
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
<h2 class="text-center mb-4"> Manajemen bahasa</h2>
<!-- Form untuk Edit atau Tambah -->
    <form method="POST" class="mb-3">
        <input type="hidden" name="id_bahasa" id="id_bahasa" value="<?php echo isset($row['id_bahasa']) ? $row['id_bahasa'] : ''; ?>">

        <div class="mb-3">
            <label for="nama_bahasa" class="form-label">Nama Bahasa</label>
            <input type="text" name="nama_bahasa" class="form-control" placeholder="Nama bahasa" value="<?php echo isset($row['nama_bahasa']) ? $row['nama_bahasa'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="link_bahasa" class="form-label">Link Bahasa</label>
            <input type="text" name="link_bahasa" class="form-control" placeholder="Link bahasa" value="<?php echo isset($row['link_bahasa']) ? $row['link_bahasa'] : ''; ?>" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="disable" value="1" class="form-check-input" 
            <?php echo isset($row['disable']) && $row['disable'] == 1 ? 'checked' : ''; ?>>
            <label class="form-check-label">Nonaktifkan</label>
        </div>

        <button type="submit" name="bahasa_submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>

