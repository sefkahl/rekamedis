<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config.php";

$title = "User-medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";


if ($dataUser['jabatan'] != 1) {
    echo "<script> 
                alert('halaman tidak di temukan..');
                window.location = '../index.php';
              </script>";
    exit();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA USER</h1>
    </div>
    <a href="<?= $main_url ?>user/tambah-user.php" class="btn btn-success btn-sm mb-3"
        title="tambah user baru"><i class="bi bi-plus-lg align-top"></i>Tambah Data</a>
    <div class="card-body col-md-11">
        <table class="table table-bordered table-striped table-hover">
            <thead class="text-center">
                <tr>
                    <th>NO</th>
                    <th>FOTO</th>
                    <th>USERNAME</th>
                    <th>NAMA LENGKAP</th>
                    <th>JABATAN</th>
                    <th>ALAMAT</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $queryuser = mysqli_query($koneksi, "SELECT * FROM tbl_user");
            while ($user = mysqli_fetch_assoc($queryuser)) {
                $jabatan = $user['jabatan'];
            ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="col-1 text-center"><img src="../asset/image/<?php echo $user['gambar'] ?>" alt="user"
                            class="img-thumbnail rounded-circle img-fluid"></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['fullname']; ?></td>

                    <td>
                        <?php

                        if ($jabatan == 1) {
                            echo 'ADMINISTRATOR';
                        } else if ($jabatan == 2) {
                            echo 'PETUGAS';
                        } else {
                            echo 'DOKTER';
                        }
                        ?>
                    </td>
                    <td><?php echo $user['alamat']; ?></td>
                    <td class="text-center">
                        <a href="edit-user.php?id=<?php echo $user['userid'] ?>&gambar=<?php echo $user['gambar'] ?>" class="btn btn-sm
                btn-success" title="edit user"><i class="bi bi-pencil-square align-top"></i></a>

                        <a href="proses-user.php?id=<?php echo $user['userid'] ?>&gambar=<?php echo $user['gambar'] ?>&aksi=hapus-user"
                            onclick="return confirm('apakah anda yakin menghapus user ini?')" class="btn btn-sm
                btn-danger" title="hapus user"><i class="bi bi-trash3 align-top"></i></a>
                    </td>
                </tr>

            <?php } ?>

        </table>
    </div>
</main>

<!-- footer -->
<?php require "../template/footer.php"; ?>