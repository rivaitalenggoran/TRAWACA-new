<?php
session_start();
include '../backend/admin_header_profil_backend.php';

// UNTUK DATA MULTILINGUAL --------------------------
// Query untuk mengambil semua id_header dan nama_header
$query = "SELECT id_header FROM profil_peneliti_header";
$stmt = $pdo->prepare($query);
$stmt->execute();
$ID_header = $stmt->fetchAll(PDO::FETCH_ASSOC);
// UNTUK DATA MULTILINGUAL --------------------------
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TRAWACA Beranda - Dashboard</title>

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
        .admin-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 20px;
            width: calc(100% - 260px);
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        /* Content Adjusts on Minimize */
        .sidebar.minimized~.admin-content {
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

            .admin-content {
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
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="dashboard.php"><i class="fa fa-tachometer"></i> <span class="menu-text">Dashboard</span></a>
        <a href="beranda_dashboard.php" ><i class="fa fa-home"></i> <span class="menu-text">Beranda</span></a>
        <a href="publikasi_dashboard.php"><i class="fa fa-cube"></i> <span class="menu-text">Publikasi</span></a>
        <a href="profil_dashboard.php" class="active"><i class="fa fa-language"></i> <span class="menu-text">Profil</span></a>
        <a href="aplikasi_dashboard.php"><i class="fa fa-language"></i> <span class="menu-text">Aplikasi</span></a>
        <a href="bahasa_dashboard.php"><i class="fa fa-calendar"></i> <span class="menu-text">Bahasa</span></a>
        <a href="user_dashboard.php"><i class="fa fa-users"></i> <span class="menu-text">User</span></a>
    </div>

    <!-- Admin Content -->
    <div class="admin-content" id="content">
        <div class="container mt-4">
            <!-- Header dengan Judul dan Breadcrumb -->
            <div class="header p-3 mb-4" style="background-color: #DCD1B8; border-radius: 5px;">
                <h2 class="mb-1">Hai <?= $_SESSION['username']?></h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>

<!----------------------- Profil Content --------------------------------------------------------------------->     
            <h3 class="mb-1">Tabel  Profil</h3>        

            <a href="CRU/header_profil_tambah.php" class="btn btn-primary mb-3">Tambah Profil</a>
       
            <!-- Dropdown untuk memilih id_header -->
            <select onchange="window.location.href=this.value;">
                <option value="">PILIH ID HEADER UNTUK TAMBAH BAHASA HEADER</option>
                <?php foreach ($ID_header as $header): ?>
                    <option value="CRU/header_profil_tambah_bahasa.php?id_header=<?php echo $header['id_header']; ?>">
                    <?php echo $header['id_header']; ?>
                    </option>
                <?php endforeach; ?>
            </select>


            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Header</th>
                        <th>ID Bahasa</th>
                        <th>Nama Header</th>
                        <th>Kode Bahasa</th>
                        <th>Header</th>
                        <th>Sub Header</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($HeaderProfil as $rowHeader) : ?>
                        <tr>
                            <td><?= $rowHeader['id_header']; ?></td>
                            <td><?= $rowHeader['id_bahasa']; ?></td>
                            <td><?= $rowHeader['nama_header']; ?></td>
                            <td><?= $rowHeader['kode_bahasa']; ?></td>
                            <td><?= $rowHeader['header']; ?></td>
                            <td><?= $rowHeader['sub_header']; ?></td>
                            <td>
                                <!-- Edit, pastikan link mengarah ke edit dengan id_bahasa -->
                                <a href="CRU/header_profil_edit.php?edit=<?= $rowHeader['id_bahasa']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Hapus, pastikan link mengarah ke hapus berdasarkan id_bahasa -->
                                <a href="?deleteheaderprofil=<?= $rowHeader['id_bahasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<!----------------------- Header Content ----------------------------------------------------------------------> 

        </div>
    </div>



    <!-- JS Sidebar -->
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
