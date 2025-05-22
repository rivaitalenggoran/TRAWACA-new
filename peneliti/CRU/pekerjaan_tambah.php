<?php
include '../../backend/peneliti_pekerjaan_backend.php';  // Sesuaikan dengan path backend yang benar
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
    <h2 class="text-center mb-4">Dashboard Tambah Pekerjaan Peneliti</h2>
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
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" 
            value="<?php echo isset($row['pekerjaan']) ? $row['pekerjaan'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="waktu_pekerjaan" class="form-label">Waktu Pekerjaan</label>
            <input type="text" name="waktu_pekerjaan" class="form-control" id="waktu_pekerjaan" 
            value="<?php echo isset($row['waktu_pekerjaan']) ? $row['waktu_pekerjaan'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="keterangan_tambahan" class="form-label">Keterangan Tambahan</label>
            <textarea name="keterangan_tambahan" class="form-control"  id="keterangan_tambahan" rows="4" 
            required><?php echo isset($row['keterangan_tambahan']) ? $row['keterangan_tambahan'] : ''; ?></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
