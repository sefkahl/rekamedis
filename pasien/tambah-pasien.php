<?php

session_start();
if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config.php";

$title = "Tambah pasien-medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if ($dataUser['jabatan'] == 3) {
    echo "<script>
        alert('halaman tidak di temukan..');
        window.location = '../index.php';
        </script>";
    exit();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2 mb-3">Tambah Pasien Baru</h1>
        <a href="<?php echo $main_url ?>pasien/data-pasien.php"
            style="display:inline-flex; align-items:center; gap:8px; padding: 8px 8px; background:#0d6efd; color:aliceblue; border-radius:5px; text-decoration:none; font-size:14px; font-weight:500; transition:all 0.2s;">
            <i class="bi bi-arrow-bar-left"></i>Kembali
        </a>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-lg-5 col-md-8">
            <form action="proses-pasien.php" method="post">
                <div class="card p-4 shadow-sm">

                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama Pasien</label>
                        <input type="text" name="nama" class="form-control rounded-0" id="nama" placeholder="Masukan nama" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control rounded-0" id="nik" maxlength="16" placeholder="Masukan 16 digit NIK" required>
                    </div>

                    <div class="form-group mb-5 mt-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control rounded-0" id="tgl_lahir" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="gender">Jenis Kelamin</label>
                        <div class="mt-3 mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderL" value="p" required>
                                <label class="form-check-label" for="genderL">Laki-Laki</label>
                            </div>
                            <span class="mx-3">/</span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderP" value="w">
                                <label class="form-check-label" for="genderP">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="telepon">Telepon/HP</label>
                        <input type="text" name="telepon" placeholder="08xxxxxxxx" pattern="[0-9]{10,}"
                            title="minimal 10 angka" class="form-control rounded-0" id="telepon">
                    </div>

                    <div class="form-group mb-5 mt-5">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control rounded-0" placeholder="Masukan Alamat" required></textarea>
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-outline-danger btn-sm px-3">Reset</button>
                        <button type="submit" name="simpan" class="btn btn-success btn-sm px-4">Simpan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</main>
<!-- footer -->
<?php require "../template/footer.php"; ?>