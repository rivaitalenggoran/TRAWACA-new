<?php
include '../../backend/peneliti_publikasi_bersama_backend.php';  // Backend sudah sesuai

// Ambil semua peneliti untuk isi dropdown
$stmt = $pdo->query("SELECT id_peneliti, nama_peneliti FROM profil_peneliti");
$penelitiList = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <h2 class="text-center mb-4">Manajemen Publikasi Bersama</h2>

    <!-- Form -->
    <form method="POST" class="mb-3">
        <!-- Container Select ID Peneliti -->
        <div id="id-peneliti-container">
            <label for="id_peneliti" class="form-label">ID Peneliti</label>
            <div class="mb-3">
                
                <select name="id_peneliti[]" class="form-control" required>
                    <option value="">-- Pilih ID Peneliti --</option>
                    <?php foreach ($penelitiList as $peneliti): ?>
                        <option value="<?= $peneliti['id_peneliti'] ?>" 
                            <?= (isset($row['id_peneliti']) && $row['id_peneliti'] == $peneliti['id_peneliti']) ? 'selected' : '' ?>>
                            <?= $peneliti['id_peneliti'] . ' - ' . $peneliti['nama_peneliti'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Tombol Tambah ID Peneliti -->
        <button type="button" class="btn btn-secondary mb-3" onclick="tambahIdPeneliti()">Tambah ID Peneliti</button>

        <div class="mb-3">
            <label for="tahun_publikasi" class="form-label">Tahun Publikasi</label>
            <input type="text" name="tahun_publikasi" class="form-control" placeholder="Tahun Publikasi"
                value="<?= isset($row['tahun_publikasi']) ? $row['tahun_publikasi'] : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_publikasi" class="form-label">Nama Publikasi</label>
            <input type="text" name="nama_publikasi" class="form-control" placeholder="Nama Publikasi"
                value="<?= isset($row['nama_publikasi']) ? $row['nama_publikasi'] : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_peneliti" class="form-label">Nama Peneliti</label>
            <input type="text" name="nama_peneliti" class="form-control" placeholder="Nama Peneliti"
                value="<?= isset($row['nama_peneliti']) ? $row['nama_peneliti'] : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="hari_tanggal_publikasi" class="form-label">Hari Tanggal Publikasi</label>
            <input type="date" name="hari_tanggal_publikasi" class="form-control" placeholder="Tanggal Publikasi"
                value="<?= isset($row['hari_tanggal_publikasi']) ? $row['hari_tanggal_publikasi'] : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="tempat_publikasi" class="form-label">Tempat Publikasi</label>
            <input type="text" name="tempat_publikasi" class="form-control" placeholder="Tempat Publikasi"
                value="<?= isset($row['tempat_publikasi']) ? $row['tempat_publikasi'] : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="tautan_publikasi" class="form-label">Tautan Publikasi</label>
            <input type="text" name="tautan_publikasi" class="form-control" placeholder="Tautan Publikasi"
                value="<?= isset($row['tautan_publikasi']) ? $row['tautan_publikasi'] : '' ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    function tambahIdPeneliti() {
        const container = document.getElementById('id-peneliti-container');

        const div = document.createElement('div');
        div.classList.add('mb-3');

        // Dropdown baru yang sama seperti di atas
        div.innerHTML = `
            <select name="id_peneliti[]" class="form-control" required>
                <option value="">-- Pilih ID Peneliti --</option>
                <?php foreach ($penelitiList as $peneliti): ?>
                    <option value="<?= $peneliti['id_peneliti'] ?>">
                        <?= $peneliti['id_peneliti'] . ' - ' . $peneliti['nama_peneliti'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        `;

        container.appendChild(div);
    }
</script>

</body>
</html>
