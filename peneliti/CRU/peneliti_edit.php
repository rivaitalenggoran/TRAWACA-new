<?php
include '../../backend/peneliti_profil_backend.php';  // Sesuaikan dengan path backend yang benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pekerjaan Peneliti</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard Profil Peneliti</h2>
    <form method="POST" class="mb-3">
    <input type="hidden" name="id_bahasa" id="id_bahasa" value="<?php echo isset($row['id_bahasa']) ? $row['id_bahasa'] : ''; ?>">


    <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" id="kode_bahasa"
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>

    <div class="mb-3">
        <label for="bidang_minat" class="form-label">Bidang Minat</label>
        <input type="text" name="bidang_minat" class="form-control" id="bidang_minat" 
        value="<?php echo isset($row['bidang_minat']) ? $row['bidang_minat'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="institusi_peneliti" class="form-label">Institusi Peneliti</label>
        <input type="text" name="institusi_peneliti" class="form-control" id="institusi_peneliti" 
        value="<?php echo isset($row['institusi_peneliti']) ? $row['institusi_peneliti'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="keterangan_tambahan" class="form-label">Keterangan Tambahan</label>
        <textarea name="keterangan_tambahan" class="form-control" id="keterangan_tambahan" rows="4"><?php echo isset($row['keterangan_tambahan']) ? $row['keterangan_tambahan'] : ''; ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Profil</button>
</form>

</div>
</body>
</html>
