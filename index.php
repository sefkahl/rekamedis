<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
header("Location: auth/login.php");
exit;
}
require "config.php";
$title = "DASHBOARD-SISTEM-RM";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DASHBOARD</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">welcome</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button"
                class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi" aria-hidden="true">
                    <use xlink:href="#calendar3"></use>
                </svg>This week </button>
        </div>
    </div>
    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
</main>
<!-- footer -->
<?php require "template/footer.php"; ?>