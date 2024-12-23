<?php
require 'config/app.php'; // File koneksi database

// Proses form saat tombol Sign Up ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $level    = $_POST['level'];

    // Proses penyimpanan data ke database
    $result = create_akun($_POST);

    if ($result > 0) {
        // Jika berhasil, arahkan ke halaman login
        header("Location: index.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        $error_message = "Sign Up gagal. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .left-section {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .right-section {
            background-image: url('img/mesin-kanan.jpg'); /* Ganti dengan URL foto Anda */
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Bagian kiri untuk form sign up -->
            <div class="col-12 col-md-6 left-section">
                <div class="form-container">
                    <h2 class="mb-4 text-center">Sign Up</h2>

                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger text-center">
                            <?= $error_message ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <!-- Full Name Input -->
                        <div class="mb-3">
                            <label for="fullname" class="form-label fw-bold">NAME</label>
                            <input type="text" name="nama" class="form-control" id="fullname" placeholder="Nama" required>
                        </div>

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">EMAIL</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>

                        <!-- Username Input -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">USERNAME</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">PASSWORD</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>

                        <!-- Level Input -->
                        <div class="mb-3">
                            <label for="level" class="form-label fw-bold">LEVEL</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="" class="text-reset">Pilih Level</option>
                                <option value="1">Admin</option>
                                <option value="2">Operator Barang</option>
                                <option value="3">User</option>
                            </select>
                        </div>

                        <!-- Sign Up Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success">Sign Up</button>
                        </div>

                        <!-- Log In Link -->
                        <p class="text-center text-muted">Already a member? <a href="index.php" class="text-success">Log In</a></p>
                    </form>
                </div>
            </div>

            <!-- Bagian kanan untuk foto -->
            <div class="col-12 col-md-6 right-section">
                <!-- Foto akan tampil di sini -->
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
