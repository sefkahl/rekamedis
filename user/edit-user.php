<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config.php";

$title = "Edit User-medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];

$queryuser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE  userid = '$id'");
$user = mysqli_fetch_assoc($queryuser);


?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Edit User</h1>
        <a href="<?= $main_url ?>user"
            style="display:inline-flex; align-items:center; gap:10px; padding:10px 13px; background:#0d6efd; color:#fff; border-radius:10px; text-decoration:none; font-size:14px; font-weight:500; transition:all 0.2s;">
            <i class="bi bi-arrow-bar-left"></i> Kembali
        </a>
    </div>
    <form action="proses-user.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4 mb-4 text-center">
                <div class="px-4 mb-4">
                    <input type="hidden" name="gambarLama" value="<?php echo $user['gambar'] ?>">
                    <img src="<?= $main_url ?>asset/image/<?php echo $user['gambar'] ?>" alt="user"
                        class="img-thumbnail mb-3 rounded-circle tampil" width="120px">
                    <input type="file" class="form-control form-control-sm" name="gambar" onchange="imgView()"
                        id="gambar">
                    <span class="text-sm">type file gambar JPG | PNG | GIF</span><br>
                    <span>widht = height</span>
                    <span class="text-sm"></span>
                </div class="">
                <button type="submit" name="update" class="btn btn-outline-primary bnt-sm" style="padding:6px 7px; font-size:12px;">
                    <i class="bi bi-arrow-repeat"></i>update</button>
            </div>
            <div class="col-lg-5">
                <div class="form-grup mb-1">

                    <input type="hidden" name="id" value="<?php echo $user['userid'] ?>">
                    <input type="hidden" name="usernameLama" value="<?php echo $user['username'] ?>">
                    <label for="userame" class="form-label">username</label>
                    <input type="text" name="username" class="form-control" id="userame" placeholder="masukkan username"
                        value="<?php echo $user['username'] ?>" autocomplete="off" autofocus required>
                    </div>
                    <div class="form-grup mb-1">
                        <label for="fullname" class="form-label">fullname</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="masukkan fullname"
                            value="<?php echo $user['fullname'] ?>" autocomplete="off" autofocus required>
                    </div>
                    <div class="form-grup mb-1">
                        <label for="jabatan" class="form-label"><i class="bi bi-person-fill"></i>Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="1" <?php echo $user['jabatan']==1 ? 'selected' : '' ?>>Administrator</option>
                            <option value="2" <?php echo $user['jabatan']==2 ? 'selected' : '' ?>>Petugas</option>
                            <option value="3" <?php echo $user['jabatan']==3 ? 'selected' : '' ?>>Dokter</option>
                        </select>
                </div>
                <div class="form-grup mb-1">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="" rows="3" class="form-control" placeholder="masukan alamat user"><?php echo $user['alamat'] ?></textarea>
                </div>
            </div>
        </div>
    </form>
</main>
<script>
    function imgView() {
        let gambar = document.getElementById('gambar');
        let tampil = document.querySelector('.tampil');

        if (gambar.files && gambar.files[0]) {
            let fileReader = new FileReader();

            fileReader.onload = function(e) {
                tampil.src = e.target.result;
            };

            fileReader.readAsDataURL(gambar.files[0]);
        }
    }
</script>
<!-- footer -->
<?php require "../template/footer.php"; ?>