<?php

session_start();
if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config.php";

$title = "Tambah User-medis";

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
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2">User Baru</h1>
        <a href="<?php echo $main_url ?>user"
            style="display:inline-flex; align-items:center; gap:10px; padding:10px 13px; background:#0d6efd; color:#fff; border-radius:10px; text-decoration:none; font-size:14px; font-weight:500; transition:all 0.2s;">
            <i class="bi bi-arrow-bar-left"></i> Kembali
        </a>
    </div>
    <form action="proses-user.php" method="post" enctype="multipart/form-data">
        <div class="card"></div>
        <div class="row">
            <div class="col-lg-4 mb-4 text-center">
                <div class="px-4 mb-4">
                    <img src="<?php echo $main_url ?>asset/image/user (1).png" alt="user"
                        class="img-thumbnail rounded-circle tampil" width="120px">
                    <input type="file" class="form-control form-control-sm" name="gambar" onchange="imgView()"
                        id="gambar">


                </div class="">
                <button type="reset" class="btn btn-outline-danger btn-sm"><i class="bi bi-arrow-clockwise"></i>
                    Reset</button>
                <button type="submit" name="simpan" class="btn btn-outline-primary bnt-sm"
                    style="padding:6px 7px; font-size:12px;">
                    <i class="bi bi-save" style="font-size:12px;"></i> Simpan</button>
            </div>
            <div class="col-lg-5 bor">
                <div class="form-grup mb-3">
                    <label for="userame" class="form-label mb-1 ">Nama</label>
                    <input type="text" name="username" class="form-control rounded-0" id="userame" placeholder="Username"
                        autocomplete="off" autofocus required>
                </div>

                <div class="form-grup mb-3">
                    <label for="fullname" class="form-label mb-1">Nama Lengkap</label>
                    <input type="text" name="fullname" class="form-control rounded-3" id="fullname"
                        placeholder="Nama Lengkap" autocomplete="off" autofocus required>
                </div>
                <div class="form-grup mb-3">
                    <label for="password" class="form-label mb-1">Password</label>
                    <input type="password" name="password" class="form-control rounded-3" id="password"
                        placeholder="Password" autocomplete="off" autofocus required>
                </div>
                <div class="form-grup mb-3">
                    <label for="password2" class="form-label mb-1">Konfirmasi Password</label>
                    <input type="password" name="password2" class="form-control rounded-3" id="password2"
                        placeholder="Konfirmasi Password" autocomplete="off" autofocus required>
                </div>
                <div class="form-grup mb-3">
                    <label for="jabatan" class="form-label mb-1">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-select rounded-0" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="1">Administrator</option>
                        <option value="2">Petugas</option>
                        <option value="3">Dokter</option>
                    </select>
                </div>
                <div class="form-grup mb-0 ">
                    <label for="alamat" class="form-label ">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="" rows="3" class="form-control rounded-0"
                        placeholder="masukan alamat user"></textarea>
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