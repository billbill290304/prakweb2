<?php

session_start();

include 'config/app.php';

// Cek apakah tombol login ditekan
if (isset($_POST['login'])) {
    // Ambil input username dan password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Cek username
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    if (mysqli_num_rows($result) == 1) {
        // Ambil data user
        $hasil = mysqli_fetch_assoc($result);

        // Cek password
        if (password_verify($password, $hasil['password'])) {
            // Set session
            $_SESSION['login'] = true;
            $_SESSION['id_akun'] = $hasil['id_akun'];
            $_SESSION['nama'] = $hasil['nama'];
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['email'] = $hasil['email'];
            $_SESSION['level'] = $hasil['level'];

            // Pengaturan arahan setelah login
            if ($hasil['level'] == 1) {
                header("Location: akun.php");
            } elseif ($hasil['level'] == 2) {
                header("Location: menuproduct.php");
            } elseif ($hasil['level'] == 3) {
                header("Location: menutentang.php");
            }
            exit;
        }
    }

    // Jika login salah
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Log In</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .left-section {
            background-image: url('img/mesin-kiri.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .right-section {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        .btn-custom {
            background-color: #e0a837;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Bagian kiri untuk foto -->
            <div class="col-12 col-md-6 left-section">
                <!-- Foto akan tampil di sini -->
            </div>

            <!-- Bagian kanan untuk form login -->
            <div class="col-12 col-md-6 right-section">
                <div class="form-container">
                    <h2 class="mb-4 text-center">Log In</h2>
                    <form method="POST" action="">
                        <!-- Username Input -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">USERNAME</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        
                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">PASSWORD</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        
                        <!-- Sign In Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" name="login" class="btn btn-primary">Sign In</button>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="text-center text-muted">Not a member? <a href="coba-signup.php" class="text-primary">Sign Up</a></p>
                            <p><a href="#" class="text-decoration-none text-muted">Forgot Password</a></p>
                        </div>

                        <!-- Sign Up Link -->
                        <!-- <p class="text-center text-muted">Not a member? <a href="coba-signup.php" class="text-primary">Sign Up</a></p> -->
                    </form>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center mt-3">
                            Username atau password salah.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
