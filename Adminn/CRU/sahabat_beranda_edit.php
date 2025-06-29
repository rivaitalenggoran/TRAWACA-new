<?php
include '../../backend/admin_sahabat_beranda_backend.php';  // Pastikan file backend sudah sesuai dengan nama dan path yang benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sahabat</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Edit Sahabat</h2>
    <!-- Form untuk Edit atau Tambah Sahabat -->
    <form method="POST" class="mb-3">
    <input type="hidden" name="id_bahasa" id="id_bahasa" value="<?php echo isset($row['id_bahasa']) ? $row['id_bahasa'] : ''; ?>">
    
        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" placeholder="Kode Bahasa" 
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_sahabat" class="form-label">Nama Sahabat</label>
            <input type="text" name="nama_sahabat" class="form-control" placeholder="Nama Sahabat" 
                value="<?php echo isset($row['nama_sahabat']) ? $row['nama_sahabat'] : ''; ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="nama_waktu_kerjasama" class="form-label">Nama Waktu Kerjasama</label>
            <input type="text" name="nama_waktu_kerjasama" class="form-control" placeholder="Nama Waktu Kerjasama" 
                value="<?php echo isset($row['nama_waktu_kerjasama']) ? $row['nama_waktu_kerjasama'] : ''; ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
