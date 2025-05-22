<?php
include '../../backend/peneliti_publikasi_bersama_backend.php';  // Pastikan file backend sudah sesuai dengan nama dan path yang benar
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

        <input type="hidden" name="id_publikasi_bersama_parent" id="id_publikasi_bersama_parent" value="<?php echo isset($row['id_publikasi_bersama_parent']) ? $row['id_publikasi_bersama_parent'] : ''; ?>">

        <div class="mb-3">
            <label for="tahun_publikasi" class="form-label">Tahun Publikasi</label>
            <input type="text" name="tahun_publikasi" class="form-control" placeholder="Tahun Publikasi" 
                value="<?php echo isset($row['tahun_publikasi']) ? $row['tahun_publikasi'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_publikasi" class="form-label">Nama Publikasi</label>
            <input type="text" name="nama_publikasi" class="form-control" placeholder="Nama Publikasi" 
                value="<?php echo isset($row['nama_publikasi']) ? $row['nama_publikasi'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_peneliti" class="form-label">Nama Peneliti</label>
            <input type="text" name="nama_peneliti" class="form-control" placeholder="Nama Peneliti" 
                value="<?php echo isset($row['nama_peneliti']) ? $row['nama_peneliti'] : ''; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="hari_tanggal_publikasi" class="form-label">Hari Tanggal Publikasi</label>
        <input type="date" name="hari_tanggal_publikasi" class="form-control" placeholder="Tanggal Publikasi" 
        value="<?php echo isset($row['hari_tanggal_publikasi']) ? $row['hari_tanggal_publikasi'] : ''; ?>" required>
        </div>


        <div class="mb-3">
            <label for="tempat_publikasi" class="form-label">Tempat Publikasi</label>
            <input type="text" name="tempat_publikasi" class="form-control" placeholder="Tempat Publikasi" 
                value="<?php echo isset($row['tempat_publikasi']) ? $row['tempat_publikasi'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="tautan_publikasi" class="form-label">Tautan Publikasi</label>
            <input type="text" name="tautan_publikasi" class="form-control" placeholder="Tautan Publikasi" 
                value="<?php echo isset($row['tautan_publikasi']) ? $row['tautan_publikasi'] : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
