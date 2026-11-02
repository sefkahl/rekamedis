<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config.php";
$title = "edit pasien-medis";

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

$id = $_GET['id'];

$queryPasien = mysqli_query($koneksi, "SELECT * FROM  tbl_pasien WHERE id='$id'");
$pasien  = mysqli_fetch_assoc($queryPasien);

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2">Edit Pasien </h1>
        <a href="<?php echo $main_url ?>pasien"
            style="display:inline-flex; align-items:center; gap:8px; padding: 8px 8px; background:#0d6efd; color:aliceblue; border-radius:5px; text-decoration:none; font-size:14px; font-weight:500; transition:all 0.2s;">
            <i class="bi bi-arrow-bar-left"></i>Kembali
        </a>
    </div>
    <form action="proses-pasien.php" method="post">
        <div class="row">
            <div class="col-lg-5">
                <input type="hidden" name="id" value="<?php echo $pasien['id'] ?>">
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama Pasien</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan nama"
                        value="<?php echo $pasien['nama'] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nik" class="form-label">NIK Pasien</label>
                    <input type="text" name="nik" class="form-control" id="nik" placeholder="Masukan NIK"
                        value="<?php echo $pasien['nik'] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tgl-lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                        value="<?php echo $pasien['tgl_lahir'] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="gender1">Jenis Kelamin</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="P" required
                                <?php echo ($pasien['gender'] == 'p') ? 'checked' : ''; ?>>

                            <label class="form-check-label" for="gender">Laki-Laki</label>
                        </div>
                        <span class="mx-2">/</span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="W" required
                                required <?php echo ($pasien['gender'] == 'w') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gender">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="telepon">Telepon/HP</label>
                        <input type="tel" name="telepon" placeholder="08xxxxxxxx" required
                            value="<?php echo $pasien['telepon'] ?>" pattern="[0-9]{12,}" title="minimal 12 angka"
                            class="form-control" id="telepon">
                    </div>
                    <div class="form-group mb-3 mt-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="" class="form-control" placeholder="Masukan Alamat"
                            required><?php echo $pasien['alamat'] ?></textarea>
                    </div>

                    <button type="submit" name="update" class="btn btn-outline-primary btn-sm"><i
                            class="bi bi-save2"></i>update</button>

                </div>
            </div>
        </div>
    </form>
</main>
<!-- footer -->
<?php require "../template/footer.php"; ?>