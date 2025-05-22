<?php
include '../../backend/admin_peneliti_beranda_backend.php';  // Pastikan path benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peneliti</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Peneliti</h2>
    <!-- Form untuk Edit atau Tambah Peneliti -->
    <form method="POST" class="mb-3">
        <input type="hidden" name="id" id="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="peneliti" <?php echo (isset($row['role']) && $row['role'] == 'peneliti') ? 'selected' : ''; ?>>Peneliti</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" 
                value="<?php echo isset($row['username']) ? $row['username'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" name="password" class="form-control" placeholder="Password" 
                value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>" required>
        </div>


        <div class="mb-3">
            <label for="nama_peneliti" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_peneliti" class="form-control" placeholder="Nama Peneliti" 
                value="<?php echo isset($row['nama_peneliti']) ? $row['nama_peneliti'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Peneliti</label>
            <input type="email" name="email_peneliti" class="form-control" placeholder="Email Peneliti" 
                value="<?php echo isset($row['email_peneliti']) ? $row['email_peneliti'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="keterangan_tambahan" class="form-label">Keterangan Tambahan</label>
            <input type="text" name="keterangan_tambahan" class="form-control" placeholder="Keterangan Tambahan" 
                value="<?php echo isset($row['keterangan_tambahan']) ? $row['keterangan_tambahan'] : ''; ?>">
        </div>

        <div class="mb-3">
            <label for="kode_bahasa" class="form-label">Kode Bahasa</label>
            <input type="text" name="kode_bahasa" class="form-control" placeholder="Kode Bahasa" 
                value="<?php echo isset($row['kode_bahasa']) ? $row['kode_bahasa'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="bidang_minat" class="form-label">Bidang Minat</label>
            <input type="text" name="bidang_minat" class="form-control" placeholder="Bidang Minat" 
                value="<?php echo isset($row['bidang_minat']) ? $row['bidang_minat'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="institusi_peneliti" class="form-label">Institusi Peneliti</label>
            <input type="text" name="institusi_peneliti" class="form-control" placeholder="Institusi Peneliti" 
                value="<?php echo isset($row['institusi_peneliti']) ? $row['institusi_peneliti'] : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>