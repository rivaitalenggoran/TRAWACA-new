<?php
include '../../backend/peneliti_pendidikan_backend.php';  // Sesuaikan dengan path backend yang benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penidikan Peneliti</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard Tambah Pendidikan Peneliti</h2>
    <form method="POST" class="mb-3">

    <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" id="kode_bahasa"
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>

    <div class="mb-3">
        <label for="nama_instansi" class="form-label">Nama Instansi</label>
        <input type="text" name="nama_instansi" class="form-control" id="nama_instansi" 
        value="<?php echo isset($row['nama_instansi']) ? $row['nama_instansi'] : ''; ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="gelar" class="form-label">Gelar</label>
        <input type="text" name="gelar" class="form-control" id="gelar" 
        value="<?php echo isset($row['gelar']) ? $row['gelar'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="fakultas" class="form-label">Fakultas</label>
        <input type="text" name="fakultas" class="form-control" id="fakultas" 
        value="<?php echo isset($row['fakultas']) ? $row['fakultas'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="tugas_akhir" class="form-label">Tugas Akhir</label>
        <textarea name="tugas_akhir" class="form-control" id="tugas_akhir" rows="4" required><?php echo isset($row['tugas_akhir']) ? $row['tugas_akhir'] : ''; ?></textarea>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
</form>

</div>
</body>
</html>
