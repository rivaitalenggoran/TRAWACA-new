<?php
include '../backend/peneliti_pekerjaan_backend.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}


// UNTUK DATA MULTILINGUAL --------------------------
// Query untuk mengambil semua id_header dan nama_header
$query = "SELECT id_pekerjaan FROM pekerjaan_peneliti";
$stmt = $pdo->prepare($query);
$stmt->execute();
$ID_pekerjaan = $stmt->fetchAll(PDO::FETCH_ASSOC);
// UNTUK DATA MULTILINGUAL --------------------------
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TRAWACA - Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="../trawaca_bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Base Styles */
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #3E2C1C;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #914b34;
            padding-top: 120px;
            position: fixed;
            left: 0;
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
            overflow: hidden;
        }

        .sidebar a {
            padding: 10px 15px;
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            white-space: nowrap;
            transition: background-color 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #575d63;
        }

        /* Active Menu */
        .sidebar a.active {
            background-color: #575d63;
            font-weight: bold;
        }

        /* Minimized Sidebar */
        .sidebar.minimized {
            width: 70px;
        }

        .sidebar.minimized a {
            justify-content: center;
        }

        .sidebar.minimized a i {
            margin-right: 0;
        }

        .sidebar.minimized a .menu-text {
            display: none;
        }

        /* Admin Content */
        .peneliti-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 20px;
            width: calc(100% - 260px);
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        /* Content Adjusts on Minimize */
        .sidebar.minimized ~ .peneliti-content {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        /* Sidebar Toggle */
        .sidebar-toggle {
            position: absolute;
            top: 65px;
            left: 15px;
            font-size: 24px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            z-index: 1100;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
                position: fixed;
            }

            .sidebar.active {
                width: 250px;
                transform: translateX(0);
            }

            .peneliti-content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-toggle{
                color: black;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">TRAWACA</a>
            <div class="ml-auto">
                <a href="profil.php" class="btn">
                    <i class="fa fa-user" style="font-size: 25px; color: white;"></i>
                </a>
                <a href="../logout.php" class="btn btn-danger">Logout</a>
                <a href="../beranda.php" class="btn" style="background-color: #8B4513; color: white;">Beranda</a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
    <?php $id_peneliti = $_SESSION['id_peneliti'] ?? ''; ?>
    <a href="peneliti_dashboard.php?id_peneliti=<?= $id_peneliti; ?>">
        <i class="fa fa-tachometer"></i> <span class="menu-text">Dashboard</span>
    </a>
    <a href="karya_dashboard.php?id_peneliti=<?= $id_peneliti; ?>">
        <i class="fa fa-paint-brush"></i> <span class="menu-text">Karya</span>
    </a>
    <a href="minat_dashboard.php?id_peneliti=<?= $id_peneliti; ?>">
        <i class="fa fa-heart"></i> <span class="menu-text">Minat</span>
    </a>
    <a href="pekerjaan_dashboard.php?id_peneliti=<?= $id_peneliti; ?>" class="active">
        <i class="fa fa-briefcase"></i> <span class="menu-text">Pekerjaan</span>
    </a>
    <a href="pendidikan_dashboard.php?id_peneliti=<?= $id_peneliti; ?>">
        <i class="fa fa-graduation-cap"></i> <span class="menu-text">Pendidikan</span>
    </a>
    <a href="profil_dashboard.php?id_peneliti=<?= $id_peneliti; ?>">
        <i class="fa fa-user"></i> <span class="menu-text">Profil</span>
    </a>
    <a href="publikasi_dashboard.php?id_peneliti=<?= $id_peneliti; ?>">
        <i class="fa fa-book"></i> <span class="menu-text">Publikasi</span>
    </a>
    <a href="tautan_dashboard.php?id_peneliti=<?= $id_peneliti; ?>">
        <i class="fa fa-link"></i> <span class="menu-text">Tautan</span>
    </a>
</div>

    <!-- Pekerjaan Content -->
    <div class="peneliti-content" id="content">
    
        <div class="container mt-4">
            <!-- Header dengan Judul dan Breadcrumb -->
            <div class="header p-3 mb-4" style="background-color: #DCD1B8; border-radius: 5px;">
                <h2 class="mb-1">Hai <?= $_SESSION['username'] ?></h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="peneliti_dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pekerjaan</li>
                    </ol>
                </nav>
            </div>

            <!----------------------- Pekerjaan Content --------------------------------------------------------------------->
            <h3 class="mb-1">Tabel Pekerjaan</h3>
            <a href="CRU/pekerjaan_tambah.php" class="btn btn-primary mb-3">Tambah Pekerjaan</a>

    
            <select onchange="window.location.href=this.value;">
                <option value="">PILIH ID PEKERJAAN UNTUK TAMBAH BAHASA PEKERJAAN</option>
                <?php foreach ($ID_pekerjaan as $pekerjaan): ?>
                    <option value="CRU/pekerjaan_tambah_bahasa.php?id_pekerjaan=<?php echo $pekerjaan['id_pekerjaan']; ?>">
                    <?php echo $pekerjaan['id_pekerjaan']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pekerjaan</th>
                        <th>ID Bahasa</th>
                        <th>Kode Bahasa</th>
                        <th>Nama Instansi</th>
                        <th>Pekerjaan</th>
                        <th>Waktu Pekerjaan</th>
                        <th>Keterangan Tambahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
    <?php if ($selected_pekerjaan): ?>
                <tbody>
                <?php foreach ($selected_pekerjaan as $row) : ?>  
                    <tr>                 
                        <td><?= $row['id_pekerjaan']; ?></td>
                        <td><?= $row['id_bahasa']; ?></td>
                        <td><?= $row['kode_bahasa']; ?></td>
                        <td><?= $row['nama_instansi']; ?></td>
                        <td><?= $row['pekerjaan']; ?></td>
                        <td><?= $row['waktu_pekerjaan']; ?></td>
                        <td><?= $row['keterangan_tambahan']; ?></td>
                        <td>
                            <a href="CRU/pekerjaan_edit.php?edit=<?= urlencode($row['id_bahasa']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?deletepekerjaan=<?= $row['id_bahasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!----------------------- Pekerjaan Content ---------------------------------------------------------------------->

        </div>
    <?php endif; ?>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var content = document.getElementById("content");

            if (window.innerWidth <= 768) {
                sidebar.classList.toggle("active");
            } else {
                sidebar.classList.toggle("minimized");
            }
        }
    </script>

</body>
</html>
