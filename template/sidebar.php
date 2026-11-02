<div class="container-fluid">
    <div class="row">

        <?php

        $uri_path       = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments   = explode('/', $uri_path);
        $menu           = $uri_segments[2];

        $userLogin      = $_SESSION['ssUserRM'];
        $cekUser        = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$userLogin'");
        $dataUser       = mysqli_fetch_assoc($cekUser);


        ?>

        <div class="sidebar border-end col-md-3 col-lg-2 p-0 bg-dark">
            <div class="offcanvas-md offcanvas-end bg-dark" tabindex="-1" id="sidebarMenu"
                aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">
                        Company name
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 <?= ($menu == '' || $menu == 'index.php') ? 'active text-warning' : 'text-white' ?>"
                                href="<?= $main_url ?>">
                                <i class="bi bi-house-door"></i>
                                <div>Dashboard</div>
                            </a>
                        </li>
                        <?php
                        if ($dataUser['jabatan'] == 1) { ?>
                            <li class="nav-item ">
                                <a class="nav-link d-flex align-items-center gap-2 text-white<?php echo $menu == 'user' ? 'active text-warning' : '' ?>"
                                    href="<?= $main_url ?>user">
                                    <i class="bi bi-person-fill-check"></i>
                                    <div>User</div>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 <?= (strpos($uri_path, 'password.php') !== false) ? 'active text-warning' : 'text-white' ?>"
                                href="<?= $main_url ?>auth/password.php">
                                <i class="bi bi-shield-lock-fill"></i>
                                <div>Ganti Password</div>
                            </a>
                        </li>
                    </ul>
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                        <span class="text-white">Data</span>
                    </h6>
                    <ul class="nav flex-column mb-auto">
                        <?php if ($dataUser['jabatan'] != 3) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 <?= (strpos($uri_path, '/pasien/') !== false) ? 'active text-warning' : 'text-white' ?>"
                                    href="<?= $main_url ?>pasien/data-pasien.php">
                                    <i class="bi bi-people-fill"></i>
                                    <div>Pasien</div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 <?= (strpos($uri_path, 'obat') !== false) ? 'active text-warning' : 'text-white' ?>"
                                    href="<?= $main_url ?>obat/data-obat.php">
                                    <i class="bi bi-capsule-pill"></i>
                                    <div>Obat</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 <?= (strpos($uri_path, 'rekamedis') !== false) ? 'active text-warning' : 'text-white' ?>"
                                    href="<?php echo $main_url ?>rekamedis/index.php">
                                    <i class="bi bi-activity"></i>
                                    <div> Rekam Medis</div>
                                </a>
                            </li>

                        <?php } ?>
                    </ul>
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                        <span class="text-white">Laporan</span>
                    </h6>

                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 <?= (strpos($uri_path, 'riwayatperekaman') !== false) ? 'active text-warning' : 'text-white' ?>"
                                href="<?php echo $main_url ?>riwayatperekaman">
                                <i class="bi bi-clock-history"></i>
                                <div>Riwayat Perekaman</div>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>