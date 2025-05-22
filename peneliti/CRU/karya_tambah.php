<?php
include '../../backend/peneliti_karya_backend.php';  // Sesuaikan dengan path backend yang benar

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karya Peneliti</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Karya Peneliti</h2>
    <!-- Form untuk Edit atau Tambah Karya -->
    <form method="POST" class="mb-3">
        <input type="hidden" name="id_karya" id="id_karya" value="<?php echo isset($row['id_karya']) ? $row['id_karya'] : ''; ?>">

        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" id="kode_bahasa"
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>


        <div class="mb-3">
            <label for="tahun_pengerjaan_karya" class="form-label">Tahun Pengerjaan</label>
            <input type="text" name="tahun_pengerjaan_karya" class="form-control" id="tahun_pengerjaan_karya"
                value="<?php echo isset($row['tahun_pengerjaan_karya']) ? $row['tahun_pengerjaan_karya'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="tautan_karya" class="form-label">Tautan Karya</label>
            <input type="text" name="tautan_karya" class="form-control" id="tautan_karya"
                value="<?php echo isset($row['tautan_karya']) ? $row['tautan_karya'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_karya" class="form-label">Nama Karya</label>
            <input type="text" name="nama_karya" class="form-control" id="nama_karya"
                value="<?php echo isset($row['nama_karya']) ? $row['nama_karya'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_karya" class="form-label">Deskripsi Karya</label>
            <textarea name="deskripsi_karya" class="form-control" id="deskripsi_karya" rows="4" required><?php echo isset($row['deskripsi_karya']) ? $row['deskripsi_karya'] : ''; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="nama_tautan_karya" class="form-label">Nama Tautan Karya</label>
            <input type="text" name="nama_tautan_karya" class="form-control" id="nama_tautan_karya"
                value="<?php echo isset($row['nama_tautan_karya']) ? $row['nama_tautan_karya'] : ''; ?>" required>
        </div>

        <button type="submit" name="karya_submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
