<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config.php";

$title = "pasien-medis";

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
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA PASIEN</h1>
    </div>
    <a href="<?= $main_url ?>pasien/tambah-pasien.php" class="btn btn-success btn-sm ms-2" title="tambah Pasien Baru"><i
            class="bi bi-plus-lg"></i> Tambah Data</a>
    <div class="card-body col-md-12">
        <table class="table table-bordered table-striped table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">ID </th>
                    <th class="text-center">NAMA PASIEN</th>
                      <th class="text-center">NIK</th>
                    <th class="text-center">TANGGAL LAHIR</th>
                    <th class="text-center">JENIS KELAMIN</th>
                    <th class="text-center">NO HP</th>
                    <th class="text-center">ALAMAT</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien");
            while ($pasien = mysqli_fetch_assoc($queryPasien)) {

            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td class="text-center"><?php echo $pasien['id'] ?></td>
                <td><?php echo $pasien['nama'] ?></td>
                 <td><?php echo $pasien['nik'] ?></td>
                <td class="text-center"><?php echo in_date($pasien['tgl_lahir']) ?></td>

                <td>
                    <?php

                        if ($pasien['gender'] == 'p') {
                            echo 'Laki-Laki';
                        } else
                            echo 'Perempuan';


                        ?>
                </td>
                <td class="text-center"><?php echo $pasien['telepon'] ?></td>
                <td><?php echo $pasien['alamat'] ?></td>
                <td class="text-center">
                    <a href="edit-pasien.php?id=<?php echo $pasien['id'] ?>" class="btn btn-sm py-1 px-1
                btn-secondary" title="edit pasien"> <i class="bi bi-pencil-square align-top"></i>Ubah</a>

                    <a href="hapus-pasien.php?id=<?php echo $pasien['id'] ?>&aksi=hapus-pasien"
                        onclick="return konfirmasiHapus(event, this.href, '<?php echo $pasien['id'] ?>', '<?php echo addslashes($pasien['nama']) ?>')"
                        class="btn btn-sm py-1 px-1 btn-danger" title="hapus pasien">
                        <i class="bi bi-trash3 align-top"></i> Hapus
                    </a>
                </td>
            </tr>

            <?php } ?>

        </table>
    </div>
</main>
<script>
function konfirmasiHapus(event, url, idPasien, namaPasien) {
    event.preventDefault();

    Swal.fire({
        title: "Apakah Anda yakin?",
        html: `Menghapus Data :<br><b>ID ${idPasien} <br> Nama-${namaPasien}</br><br><br>Data tidak dapat dikembalikan!`,
        icon: "warning",
        width: "440px",
        showCancelButton: true,
        confirmButtonColor: "#464593",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- footer -->
<?php require "../template/footer.php"; ?>