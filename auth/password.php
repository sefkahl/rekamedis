<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: login.php");
    exit();
}

require "../config.php";

$title = "password-medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 text">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ganti password</h1>
    </div>
    <form action="../user/proses-user.php" method="post">

        <div class="col-md-3">
            <div class="input-group mb-3">
                <span class="input-group-text" style="min-width: 170px;">Password Lama</span>
                <input type="password" aria-label="First name" name="oldpass" id="oldpass" class="form-control">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" style="min-width: 170px;">Password Baru</span>
                <input type="password" aria-label="First name" name="newpass" id="newpass" class="form-control">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" style="min-width: 170px;">Confir Password</span>
                <input type="password" aria-label="First name" name="confpass" id="confpass" class="form-control">
            </div>
        </div>
        <button type="reset" class="btn btn-outline-danger btn-sm">Reset</button>
        <button type="submit" name="ganti-password" class="btn btn-outline-primary btn-sm">Simpan</button>
    </form>
</main>

<!-- footer -->
<?php require "../template/footer.php"; ?>