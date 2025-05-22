<?php
include 'backend/login_backend.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TRAWACA - Login</title>
    <link
        rel="shortcut icon"
        href="https://trawaca.id/images/trawaca_small_8.png" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <style>
        body {
            background-color: #dcd1b8;
        }

        .card {
            background-color: #9a523a;
            color: white;
        }

        .btn-primary {
            background-color: #d3a281;
            border-color: #d3a281;
        }

        .btn-primary:hover {
            background-color: #b9896b;
            border-color: #b9896b;
        }

        .btn-primary:disabled {
            background-color: #a9a9a9; /* Warna abu-abu yang lebih umum untuk disabled */
            border-color: #a9a9a9;
            color: #6c757d; /* Warna teks untuk disabled agar kontras */
            cursor: not-allowed; /* Menunjukkan button tidak bisa diklik */
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 350px">
    <a href="beranda.php" class="btn mb-3" style="background-color: #8B4513; color: white;">Beranda</a>
        <h3 class="text-center mb-4">Login</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required />
            </div>
            <!-- Tambahkan atribut 'disabled' di sini -->
            <button type="submit" class="btn btn-primary w-100 mt-2" id="loginBtn" disabled>Login</button>
        </form>
        <?php
        if (isset($error)) {
            echo "<div class='alert alert-danger mt-3'>$error</div>";
        }
        ?>
    </div>

    <script>
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const loginButton = document.getElementById('loginBtn');

        function validateForm() {
            // .trim() digunakan untuk menghapus spasi di awal dan akhir
            // sehingga input yang hanya berisi spasi dianggap kosong
            const isUsernameFilled = usernameInput.value.trim() !== '';
            const isPasswordFilled = passwordInput.value.trim() !== '';

            if (isUsernameFilled && isPasswordFilled) {
                loginButton.disabled = false; // Aktifkan tombol
            } else {
                loginButton.disabled = true;  // Nonaktifkan tombol
            }
        }

        // Panggil validateForm setiap kali ada input di field username atau password
        usernameInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);

        // Panggil validateForm saat halaman pertama kali dimuat
        // (Meskipun tombol sudah disabled di HTML, ini untuk konsistensi jika ada kasus lain)
        // Sebenarnya tidak terlalu dibutuhkan jika sudah set 'disabled' di HTML untuk kondisi awal.
        // Namun, tidak ada salahnya.
        // document.addEventListener('DOMContentLoaded', validateForm); // Bisa juga begini
        validateForm(); // Panggil sekali untuk set state awal berdasarkan nilai (jika ada autocomplete)
    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>