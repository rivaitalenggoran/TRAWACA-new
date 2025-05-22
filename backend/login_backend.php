<?php
// Selalu letakkan session_start() di paling atas,
// dan pastikan hanya dipanggil sekali.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Sertakan file konfigurasi database
// Menggunakan __DIR__ untuk path yang lebih robust.
// __DIR__ adalah direktori file saat ini (yaitu 'backend'),
// jadi kita naik satu level ('../') lalu masuk ke 'config'.
include __DIR__ . '/../config/database.php';

// Variabel untuk menampung pesan error yang akan ditampilkan di login.php
$error = null; // Pastikan $error terdefinisi meskipun tidak ada POST request

// Periksa apakah $pdo terdefinisi setelah include database.php
if (!isset($pdo)) {
    // Jika $pdo tidak ada, berarti ada masalah di database.php
    // Log error ini di sisi server. Pengguna tidak perlu tahu detailnya.
    error_log("Koneksi PDO tidak terdefinisi. Periksa file config/database.php.");
    // Siapkan pesan error untuk ditampilkan di form, atau tangani sesuai kebutuhan
    // Untuk kasus ini, kita akan membiarkan $error di-set di bawah jika login gagal,
    // atau bisa juga set pesan error spesifik koneksi di sini jika diinginkan.
    // $error = "Terjadi kesalahan konfigurasi server. Silakan coba lagi nanti.";
    // exit; // Atau hentikan eksekusi jika koneksi DB adalah syarat mutlak untuk halaman ini
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan $pdo ada sebelum mencoba menggunakannya
    if (!isset($pdo)) {
        $error = "Koneksi ke database gagal. Silakan hubungi administrator.";
        // Hentikan eksekusi lebih lanjut jika tidak ada koneksi
    } else if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username dan password tidak boleh kosong!";
    } else {
        $username_input = trim($_POST['username']);
        $password_input = trim($_POST['password']); // Password yang diinput oleh pengguna

        try {
            // Query untuk mencari username
            // Mengambil kolom yang diperlukan: id_user, username, password (hash), role, id_peneliti
            $query = "SELECT id_user, username, password, role, id_peneliti FROM users WHERE username = :username LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $username_input, PDO::PARAM_STR);
            
            // Eksekusi query
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Username ditemukan, sekarang verifikasi password
                // $user['password'] berisi HASH Bcrypt dari database
                // $password_input adalah password plaintext dari form
                if (password_verify($password_input, $user['password'])) {
                    // Password cocok!
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['username'] = $user['username']; // Simpan username dari DB (konsistensi case)
                    $_SESSION['role'] = $user['role'];
                    
                    // Simpan id_peneliti jika ada dan tidak null
                    if (isset($user['id_peneliti']) && $user['id_peneliti'] !== null) {
                        $_SESSION['id_peneliti'] = $user['id_peneliti'];
                    } else {
                        $_SESSION['id_peneliti'] = null;
                    }
                    
                    error_log("Login berhasil untuk user: " . $user['username'] . " dengan role: " . $user['role']);

                    // Redirect berdasarkan role
                    if ($user['role'] == 'admin') {
                        header("Location: Adminn/dashboard.php"); // Pastikan path ini benar
                        exit();
                    } elseif ($user['role'] == 'peneliti') {
                        if (isset($_SESSION['id_peneliti'])) {
                            header("Location: peneliti/peneliti_dashboard.php?id_peneliti=" . $_SESSION['id_peneliti']); // Pastikan path ini benar
                        } else {
                            error_log("Role peneliti tapi id_peneliti tidak ada untuk user ID: " . $user['id_user']);
                            $error = "Konfigurasi akun peneliti tidak lengkap.";
                            // Anda bisa mengarahkan ke halaman error khusus atau dashboard default
                            // header("Location: some_error_page.php");
                            // exit();
                        }
                        exit();
                    } else {
                        // Role lain yang tidak terdefinisi (sebaiknya tidak ada jika enum 'admin','peneliti')
                        // Redirect ke halaman default atau tampilkan error
                        error_log("Role tidak dikenal: " . $user['role'] . " untuk user: " . $user['username']);
                        $error = "Role pengguna tidak valid.";
                        // header("Location: user/user_dashboard.php"); // Atau halaman default
                        // exit();
                    }
                } else {
                    // Password tidak cocok
                    error_log("Password salah untuk username: " . $username_input);
                    $error = "Username atau password salah!";
                }
            } else {
                // Username tidak ditemukan
                error_log("Username tidak ditemukan: " . $username_input);
                $error = "Username atau password salah!";
            }
        } catch (PDOException $e) {
            // Tangani kesalahan database
            error_log("PDOException di login_backend.php: " . $e->getMessage());
            $error = "Terjadi kesalahan saat memproses login. Silakan coba lagi nanti.";
        }
    }
}
// Jika $error di-set, maka login.php (yang meng-include file ini) akan menampilkannya.