<?php
session_start();
include '../backend/admin_header_beranda_backend.php';
include '../backend/admin_kegiatan_beranda_backend.php';
include '../backend/admin_kontak_beranda_backend.php';
include '../backend/admin_kontributor_beranda_backend.php';
include '../backend/admin_peneliti_beranda_backend.php';
include '../backend/admin_sahabat_beranda_backend.php';


// UNTUK DATA MULTILINGUAL --------------------------
// Query untuk mengambil semua id_header dan nama_header
$query = "SELECT id_header FROM beranda_header";
$stmt = $pdo->prepare($query);
$stmt->execute();
$ID_header = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk mengambil semua id_header dan nama_header
$query = "SELECT id_kegiatan FROM kegiatan_luaran";
$stmt = $pdo->prepare($query);
$stmt->execute();
$ID_kegiatan = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk mengambil semua id_header dan nama_header
$query = "SELECT id_sahabat FROM sahabat_trawaca";
$stmt = $pdo->prepare($query);
$stmt->execute();
$ID_sahabat = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="dashboard.php"><i class="fa fa-tachometer"></i> <span class="menu-text">Dashboard</span></a>
        <a href="beranda_dashboard.php" class="active"><i class="fa fa-home"></i> <span class="menu-text">Beranda</span></a>
        <a href="publikasi_dashboard.php"><i class="fa fa-cube"></i> <span class="menu-text">Publikasi</span></a>
        <a href="profil_dashboard.php"><i class="fa fa-language"></i> <span class="menu-text">Profil</span></a>
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
                        <li class="breadcrumb-item active" aria-current="page">Beranda</li>
                    </ol>
                </nav>
            </div>

<!----------------------- Beranda Content --------------------------------------------------------------------->     
            <h3 class="mb-1">Tabel Data Header Beranda</h3>        
            <a href="CRU/header_beranda_tambah.php" class="btn btn-primary mb-3">Tambah Header Beranda</a>

            <!-- Dropdown untuk memilih id_header -->
            <select onchange="window.location.href=this.value;">
                <option value="">PILIH ID HEADER UNTUK TAMBAH BAHASA HEADER</option>
                <?php foreach ($ID_header as $header): ?>
                    <option value="CRU/header_beranda_tambah_bahasa.php?id_header=<?php echo $header['id_header']; ?>">
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
                    <?php foreach ($HeaderBeranda as $rowHeader) : ?>
                        <tr>
                            <td><?= $rowHeader['id_header']; ?></td>
                            <td><?= $rowHeader['id_bahasa']; ?></td>
                            <td><?= $rowHeader['nama_header']; ?></td>
                            <td><?= $rowHeader['kode_bahasa']; ?></td>
                            <td><?= $rowHeader['header']; ?></td>
                            <td><?= $rowHeader['sub_header']; ?></td>
                            <td>
                                <!-- Edit, pastikan link mengarah ke edit dengan id_bahasa -->
                                <a href="CRU/header_beranda_edit.php?edit=<?= $rowHeader['id_bahasa']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Hapus, pastikan link mengarah ke hapus berdasarkan id_bahasa -->
                                <a href="?deleteheaderberanda=<?= $rowHeader['id_bahasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<!----------------------- Header Content -----------------------------------------------------------------> 


<!----------------------- Peneliti Utama Content --------------------------------------------------------------------->   
            <br>  
            <h4 class="mb-1">Notes : Untuk Mengubah Nama Peneliti dan Bidang Minat, harap pergi ke Halaman Peneliti</h4>
            <br>      
<!----------------------- Peneliti Utama Content ---------------------------------------------------------------------->


<!----------------------- Kontributor Content --------------------------------------------------------------------->     
            <h3 class="mb-1">Tabel Data Kontributor Beranda</h3>    
            <a href="CRU/kontributor.php" class="btn btn-primary mb-3">Tambah Kontributor Beranda</a>   
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Kontributor</th>
                        <th>Nama Kontributor</th>
                        <th>Semester Kontibutor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Kontributor as $rowKontributor) : ?>             
                        <tr>
                            <td><?= $rowKontributor['id_kontributor']; ?></td>
                            <td><?= $rowKontributor['nama_kontributor']; ?></td>
                            <td><?= $rowKontributor['semester_kontributor']; ?></td>
                            <td>
                                <a href="CRU/kontributor.php?edit=<?= $rowKontributor['id_kontributor']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?deletekontributor=<?= $rowKontributor['id_kontributor']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<!----------------------- KontributorContent ---------------------------------------------------------------------->



<!----------------------- Kontak Content --------------------------------------------------------------------->
     
            <h3 class="mb-1">Tabel Data Kontak Beranda</h3>    
            <br>  
            <h4 class="mb-1">Notes : Gunakan Email</h4>
            <br> 
            <a href="CRU/kontak.php" class="btn btn-primary mb-3">Tambah Kontak Beranda</a>   
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Kontak</th>
                        <th>Nama Kontak</th>
                        <th>Link Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Kontak as $row) : ?>             
                        <tr>
                            <td><?= $row['id_kontak']; ?></td>
                            <td><?= $row['nama_kontak']; ?></td>
                            <td><?= $row['link_kontak']; ?></td>
                            <td>
                                <a href="CRU/kontak.php?edit=<?= $row['id_kontak']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?deletekontak=<?= $row['id_kontak']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<!----------------------- Kontak Content ---------------------------------------------------------------------->


<!----------------------- Kegiatan Content --------------------------------------------------------------------->   
            <h3 class="mb-1">Tabel Data Kegiatan dan Luaran Beranda</h3>    
            <br>  
            <h4 class="mb-1">Notes : untuk link, gunakan https:// agar terbaca sebagai link, bukan path</h4>
            <br>
            <a href="CRU/kegiatan_beranda_tambah.php" class="btn btn-primary mb-3">Tambah Kegiatan dan Luaran Beranda</a>   

            <select onchange="window.location.href=this.value;">
                <option value="">PILIH ID KEGIATAN UNTUK TAMBAH BAHASA KEGIATAN</option>
                <?php foreach ($ID_kegiatan as $kegiatan): ?>
                    <option value="CRU/kegiatan_beranda_tambah_bahasa.php?id_kegiatan=<?php echo $kegiatan['id_kegiatan']; ?>">
                        <?php echo $kegiatan['id_kegiatan']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Kegiatan</th>
                        <th>ID Bahasa</th>
                        <th>Kode Bahasa</th>
                        <th>Nama Kegiatan / Luaran</th>
                        <th>Deskripsi Kegiatan / Luaran</th>
                        <th>Gambar Kegiatan / Luaran</th>
                        <th>Waktu Kegiatan / Luaran</th>
                        <th>Link Kegiatan / Luaran</th>
                        <th>Nama Link Kegiatan / Luaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Kegiatan as $rowKegiatan) : ?>             
                        <tr>
                            <td><?= $rowKegiatan['id_kegiatan']; ?></td>
                            <td><?= $rowKegiatan['id_bahasa']; ?></td>
                            <td><?= $rowKegiatan['kode_bahasa']; ?></td>
                            <td><?= $rowKegiatan['nama_kegiatan_luaran']; ?></td>
                            <td><?= $rowKegiatan['deskripsi_kegiatan_luaran']; ?></td>
                            <td><?= $rowKegiatan['gambar_kegiatan_luaran']; ?></td>
                            <td><?= $rowKegiatan['waktu_kegiatan_luaran']; ?></td>
                            <td><?= $rowKegiatan['link_kegiatan_luaran']; ?></td>
                            <td><?= $rowKegiatan['nama_link']; ?></td>
                            <td>
                                <a href="CRU/kegiatan_edit.php?edit=<?= $rowKegiatan['id_bahasa']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?deletekegiatan=<?= $rowKegiatan['id_bahasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<!----------------------- Kegiatan Content ---------------------------------------------------------------------->


<!----------------------- Sahabat Content --------------------------------------------------------------------->     
            <h3 class="mb-1">Tabel Data Sahabat TRAWACA Beranda</h3>    
            <a href="CRU/sahabat_beranda_tambah.php" class="btn btn-primary mb-3">Tambah Sahabat TRAWACA Beranda</a>   

            <select onchange="window.location.href=this.value;">
                <option value="">PILIH ID SAHABAT UNTUK TAMBAH BAHASA SAHABAT</option>
                <?php foreach ($ID_sahabat as $sahabat): ?>
                    <option value="CRU/sahabat_beranda_tambah_bahasa.php?id_sahabat=<?php echo $sahabat['id_sahabat']; ?>">
                        <?php echo $sahabat['id_sahabat']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Bahasa</th>
                        <th>ID Sahabat</th>
                        <th>Kode Bahasa</th>
                        <th>Nama Sahabat TRAWACA</th>
                        <th>Nama Kerjasama, Waktu Kerjasama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Sahabat as $rowSahabat) : ?>             
                        <tr>
                            <td><?= $rowSahabat['id_bahasa']; ?></td>
                            <td><?= $rowSahabat['id_sahabat']; ?></td>
                            <td><?= $rowSahabat['kode_bahasa']; ?></td>
                            <td><?= $rowSahabat['nama_sahabat']; ?></td>
                            <td><?= $rowSahabat['nama_waktu_kerjasama']; ?></td>
                            <td>
                                <a href="CRU/sahabat_beranda_edit.php?edit=<?= $rowSahabat['id_bahasa']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?deletesahabat=<?= $rowSahabat['id_bahasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<!----------------------- Sahabat Content ---------------------------------------------------------------------->
        </div>
    </div>



    <!-- JS Sidebar -->
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var content = document.getElementById("content");

            if (window.innerWidth <= 200) {
                sidebar.classList.toggle("active");
            } else {
                sidebar.classList.toggle("minimized");
            }
        }
    </script>

</body>

</html>
