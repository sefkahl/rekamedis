<?php
session_start();

if (isset($_SESSION['ssLoginRM'])) {
    header("location: ../index.php");
    exit();
}

require "../config.php";
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-rekam medis</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="wrap">
        <div class="card">
            <div class="left">
                <div class="left-content">
                    <img src="../asset/image/logo.jpeg" alt="Logo RS" width="100%">
                    <div class="hospital-name">SISTEM REKAM MEDIS</div>
                </div>
            </div>
            <div class="right">
                <div class="login-title">Selamat Datang</div>
                <form action="proses-login.php" method="post">
                    <div class="ig">
                        <label class="mt-5">Username</label>
                        <input type="text" name="username" placeholder="Masukkan username" autocomplete="off" required>
                        <i class="bi bi-person-circle ico"></i>
                    </div>
                    <div class="ig">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Masukkan password" autocomplete="off"
                            required>
                        <i class="bi bi-lock ico"></i>
                    </div>
                    <div class="row-opt">
                        <label class="remember">
                            <input type="checkbox"> Ingat saya
                        </label>
                        <span class="forgot">Lupa password?</span>
                    </div>
                    <button type="submit" name="login" class="login-btn">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>