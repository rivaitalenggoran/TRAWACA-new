<?php
include '../../backend/peneliti_minat_backend.php';  // Sesuaikan dengan path backend yang benar

$id_minat_bahasa = isset($_GET['id_minat']) ? $_GET['id_minat'] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Minat Peneliti</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard Minat Peneliti</h2>
    <h4> ID MINAT: <?php echo $id_minat_bahasa; ?></h4>
    <form method="POST" class="mb-3">
        <input type="hidden" name="id_minat" id="id_minat" value="<?php echo isset($row['id_minat']) ? $row['id_minat'] : ''; ?>">
 
        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" id="kode_bahasa"
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_minat" class="form-label">Nama Minat</label>
            <input type="text" name="nama_minat" class="form-control" id="nama_minat" 
            value="<?php echo isset($row['nama_minat']) ? $row['nama_minat'] : ''; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="subtopik_minat" class="form-label">Subtopik Minat</label>
            <input type="text" name="subtopik_minat" class="form-control" id="subtopik_minat" 
            value="<?php echo isset($row['subtopik_minat']) ? $row['subtopik_minat'] : ''; ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
