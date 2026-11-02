    <?php

    session_start();
    if (!isset($_SESSION['ssLoginRM'])) {
        header("location: ../auth/login.php");
        exit();
    }
    require "../config.php";

    $title = "Edit Data | SISTEM MEDIS";

    require  "../template/header.php";
    require  "../template/navbar.php";
    require  "../template/sidebar.php";

  $id = $_GET['id'];

$sqlrm = "SELECT *, tbl_pasien.alamat AS alamatpasien FROM tbl_rekamedis
INNER JOIN tbl_pasien ON tbl_rekamedis.id_pasien = tbl_pasien.id 
INNER JOIN tbl_user ON tbl_rekamedis.id_dokter = tbl_user.userid
WHERE no_rm = '$id'";

$queryrm = mysqli_query($koneksi, $sqlrm);
$rm = mysqli_fetch_array($queryrm); 

    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
            <h2>EDIT DATA PEREKEMAN</h2>
            <br>
            <a href="<?php echo $main_url ?>rekamedis/tambah-data.php" style="display:inline-flex; align-items:center; gap:7px; padding: 8px 8px; background:#0d6efd; color:aliceblue; 
                border-radius:0; text-decoration:none; font-size:12px; font-weight:400; transition:all 0.2s;">
                <i class="bi bi-arrow-bar-left"></i>Kembali
            </a>
        </div>
        <div class="mt-3">
            <button type="button" class="btn btn-success py-1 px-2 rounded-0" data-bs-toggle="modal"
                data-bs-target="#modaltambah">
                + Tambah Data
            </button>

            <div class="card mt-4">
                <form action="proses-data.php" method="POST">
                    <div class="row">
                        <div class="col-sm-6 rounded">
                            <div class="card rounded-0 border-0">
                                <div class="card-body py-4">
                                    <div class="col-md-10">
                                        <label for="noRm" class="mt-3">No.Rekam Medis</label>
                                        <input type="text" class="form-control rounded-0" name="no_rm" id="noRm"
                                            value="<?= $rm['no_rm']; ?>" readonly>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="tgl" class="mt-3">Tanggal Perekaman</label>
                                        <input type="date" class="form-control rounded-0" name="tgl" id="tgl"
                                            value="<?php echo $rm['tgl_rm'] ?>" required>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="pasien" class="mt-3">Data Pasien</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control rounded-0" name="pasien"
                                                id="pasien_id" aria-describedby="button-addon2"
                                                value="<?php echo $rm['id_pasien'] ?>">
                                            <button class="btn btn-success rounded-0" type="button" id="caripasien"
                                                data-bs-toggle="modal" data-bs-target="#modalPasien">Cari<i
                                                    class="bi bi-search px-3"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-mb-3">
                                        <input type="text" class="form-control border-0" name="namaPasien"
                                            id="namaPasien" value="<?php echo $rm['nama'] ?>" readonly>
                                    </div>
                                    <div class="mb-3 col-md-10">
                                        <label for="alamatPasien" class="form-label">Alamat Pasien</label>
                                        <textarea class="form-control rounded-0" id="alamatPasien" rows="3"
                                            readonly><?php echo $rm['alamatpasien'] ?></textarea>
                                    </div>
                                    <div class="mb-3 col-md-10">
                                        <label for="label" class="form-label">Keluhan Pasien</label>
                                        <textarea class="form-control rounded-0" name="keluhanpasien" id="keluhanpasien"
                                            placeholder="Masukan Keluhan Pasien"
                                            rows="3"><?php echo $rm['keluhan'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <div class="card rounded-0 border-0">
                                <div class="card-body">
                                    <label for="dokter" class="form-label mt-3">Dokter</label>

                                    <div class="col-md-10 mb-3">
                                        <select name="dokter" id="dokter" class="form-select rounded-0" required>

                                            <?php
                                            $queryDokter    = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE jabatan = 3");
                                            while ($data = mysqli_fetch_array($queryDokter)) { ?>
                                            <option value="<?php echo $data['userid'] ?>"
                                                <?php echo $data['userid'] == $rm['id_dokter'] ? 'selected' : '' ?>>
                                                <?php echo $data['fullname'] ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="mb-3 col-md-10">
                                            <label for="diagnosa" class="form-label">Diagnosa</label>
                                            <textarea class="form-control rounded-0" id="diagnosa" name="diagnosa"
                                                rows="3" placeholder="..."
                                                required><?php echo $rm['diagnosa'] ?></textarea>
                                        </div>

                                        <div class="form-group mb-3 col-md-10">
                                            <label for="obat" class="form-label">Obat</label>
                                            <input type="text" name="obat" class="form-control rounded-0" id="obat"
                                                placeholder="Pilih Obat" value="<?php echo $rm['obat'] ?>">
                                        </div>
                                        <div class="mt-3">
                                            <button type="reset"
                                                class="btn btn-danger rounded-0 px-2 py-1 me-2">Reset</button>
                                            <button type="submit" name="update"
                                                class="btn btn-secondary rounded-0 px-2 py-1">update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Modal tambha pasien -->
                <div class="modal fade" id="modalPasien" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width:700px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cari Pasien</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h3>PASIEN</h3>
                                <table class="table table-bordered" id="myTable">
                                    <thead class="table-info">
                                        <tr>
                                            <th>NO</th>
                                            <th>ID PASIEN</th>
                                            <th>NAMA</th>
                                            <th>ALAMAT</th>
                                            <th>PILIH</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?= $no = 1;
                                        $queryPasien   = mysqli_query($koneksi, "SELECT * FROM tbl_pasien");
                                        while ($pasien = mysqli_fetch_assoc($queryPasien)) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $pasien['id'] ?></td>
                                            <td><?= $pasien['nama'] ?></td>
                                            <td><?= $pasien['alamat'] ?></td>

                                            <td class="text-center">
                                                <button type="button" title="pilih pasien"
                                                    data-id="<?= $pasien['id'] ?>"
                                                    data-namapasien="<?php echo $pasien['nama'] ?>"
                                                    data-address="<?= $pasien['alamat'] ?>"
                                                    class="btn btn-sm btn-outline-primary cekPasien"><i
                                                        class="bi bi-check2"></i></i></button>
                                            </td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary py-1 px-2  rounded-0"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <style>
html[data-bs-theme="dark"] .tagify {
    --tags-border-color: #495057;
    --tags-bg: #212529;
    --tag-bg: #1fc3b0;
    --tag-text-color: #17181a;
    --tag-remove-btn-color: #191a1b;
}

html[data-bs-theme="dark"] .tagify__dropdown__wrapper {
    background: #212529;
    border-color: #495057;
}

html[data-bs-theme="dark"] .tagify__dropdown__item {
    color: #f8f9fa;
}

html[data-bs-theme="dark"] .tagify__dropdown__item--active {
    background: #343a40;
}
    </style>

    <script>
$(document).ready(function() {
    $(document).on('click', '.cekPasien', function() {
        let pasienID = $(this).data('id');
        let pasienName = $(this).data('namapasien');
        let pasienAddress = $(this).data('address');
        $('#pasien_id').val(pasienID);
        $('#namaPasien').val(pasienName);
        $('#alamatPasien').val(pasienAddress);
        $('#modalPasien').modal('hide');
    });

    <?php
            $queryObat = mysqli_query($koneksi, "SELECT * FROM tbl_obat");
            $nmObat = [];
            while ($data = mysqli_fetch_array($queryObat)) {
                $nmObat[] = $data['nama'];
            }
            ?>

    var inputObat = document.querySelector('#obat');
    new Tagify(inputObat, {
        whitelist: <?php echo json_encode($nmObat); ?>,
        maxTags: 20,
        dropdown: {
            maxItems: 15,
            enabled: 0,
            closeOnSelect: false
        }
    });
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php require "../template/footer.php"; ?>