  <?php
    session_start();
    if (!isset($_SESSION['ssLoginRM'])) {
        header("location: ../auth/login.php");
        exit();
    }
    require "../config.php";

    $title = "Riwayat Perekaman| SISTEM MEDIS";

    require  "../template/header.php";
    require  "../template/navbar.php";
    require  "../template/sidebar.php";

    ?>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
          <H2>Riwayat Perekaman</H2>
          <br>
      </div>
      <div class="col-md-12">
      </div>
      <div class="card-body col-md-12">
          <table class="table table-bordered table-striped table-hover" id="myTable">
              <thead class="table-dark">
                  <tr>
                      <th class="text-center">NO</th>
                      <th class="text-center">ID PASIEN</th>
                      <th class="text-center">NAMA</th>
                      <th class="text-center">NIK</th>
                      <th class="text-center">UMUR</th>
                      <th>JENIS KELAMIN</th>
                      <th class="text-center">TELEPON</th>
                      <th class="text-center">ALAMAT</th>
                      <th class="text-center">ACTION</th>
                  </tr>

              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien");
                    while ($pasien = mysqli_fetch_array($queryPasien)) {
                    ?>
                      <tr>
                          <td class="text-center"><?php echo $no++ ?></td>
                          <td class="text-center"><?php echo $pasien['id'] ?></td>
                          <td><?php echo $pasien['nama'] ?></td>
                          <td class="text-center"><?php echo $pasien['nik'] ?></td>
                          <td><?= htgUmur($pasien['tgl_lahir']); ?></td>

                          <td>
                              <?php
                                if ($pasien['gender'] == 'p') {
                                    echo 'pria';
                                } else {
                                    echo 'wanita';
                                }
                                ?>
                          </td>
                          <td class="text-center"><?php echo $pasien['telepon'] ?></td>
                          <td><?php echo $pasien['alamat'] ?></td>

                          <td class="text-center">
                              <a href="laporan.php?id=<?php echo $pasien['id'] ?>" class="btn btn-sm btn-secondary py-1 px-2 rounded-0"
                                  title="cetak pdf" target="_balnk"><i class="bi bi-printer fs-6"></i> Cetak</a>
                          </td>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
      </div>
      </div>
  </main>
  <?php require "../template/footer.php"; ?>