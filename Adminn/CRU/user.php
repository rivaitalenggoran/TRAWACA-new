<?php
include '../../backend/admin_user_backend.php';
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAWACA USER</title>
    <link rel="stylesheet" href="../../trawaca_bootstrap/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen User</h2>
    <!-- Form untuk Edit atau Tambah User -->
    <form method="POST" action="" class="mb-3">

    <div class="mb-3">
    <label for="roleSelect" class="form-label">Pilih Role</label>
    <select name="role" class="form-control" id="roleSelect" required onchange="redirectIfPeneliti(this)">
        <option value="admin" <?php echo (isset($row['role']) && $row['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="peneliti" <?php echo (isset($row['role']) && $row['role'] == 'peneliti') ? 'selected' : ''; ?>>Peneliti</option>
    </select>
</div>

        <input type="hidden" name="id_user" value="<?php echo isset($row['id_user']) ? $row['id_user'] : ''; ?>">

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


        <button type="submit" name="user_submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>



<script>
function redirectIfPeneliti(select) {
    if (select.value === 'peneliti') {
        window.location.href = 'profil_peneliti.php';
    }
}
</script>
</html>