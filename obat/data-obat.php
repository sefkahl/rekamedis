  <?php
  session_start();
  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
  }
  require "../config.php";

  $title = "tambah Obat | SISTEM MEDIS";

  require  "../template/header.php";
  require  "../template/navbar.php";
  require  "../template/sidebar.php";


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
          <H2>TABEL OBAT</H2>
          <br>

          <a href="<?php echo $main_url ?>index.php"
              style="display:inline-flex; align-items:center; gap:8px; padding: 8px 8px; background:#0d6efd; color:aliceblue; border-radius:5px; text-decoration:none; font-size:14px; font-weight:500; transition:all 0.2s;">
              <i class="bi bi-arrow-bar-left"></i>Kembali
          </a>
      </div>
      <div class="col-md-12">
          <div class="mb-1 mt-1 ms-1">
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modaltambah">
                  + Tambah Obat
              </button>
          </div>
      </div>
      <div class="card-body col-md-12">
          <table class="table table-bordered table-striped table-hover" id="myTable">
              <thead class="table-dark">
                  <tr>
                      <th class="text-center">NO</th>
                      <th>NAMA</th>
                      <th>KEGUNAAN</th>
                      <th>JENIS OBAT</th>
                      <th class="text-center">ACTION</th>
                  </tr>

              </thead>
              <tbody>
                  <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_obat ORDER BY id DESC");
          while ($data = mysqli_fetch_array($tampil)) {
          ?>
                  <tr>
                      <td class="text-center"><?php echo $no++ ?></td>
                      <td><?php echo $data['nama'] ?></td>
                      <td><?php echo $data['kegunaan'] ?></td>
                      <td><?php echo $data['jenis_obat'] ?></td>
                      <td class="text-center">

                          <a href="data-obat.php?id=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm"
                              data-bs-toggle="modal" data-bs-target="#modaledit<?= $no ?>"><i
                                  class="bi bi-pencil-square"></i></a>
                          <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                              data-bs-target="#modalhapus<?= $no ?>"><i class="bi bi-trash3"></i></a>

                      </td>
                  </tr>
                  <!-- awal modal edit -->
                  <div class="modal fade" id="modaledit<?php echo $no ?>" data-bs-backdrop="static"
                      data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tabel Obat</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                              </div>
                              <form action="aksi-obat.php" method="POST">
                                  <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                  <div class="modal-body">
                                      <div class="mb-3">
                                          <label class="form-label">Nama Obat</label>
                                          <input type="text" class="form-control" name="obat"
                                              value="<?= $data['nama'] ?>" placeholder="masukan nama obat">
                                      </div>
                                      <div class="mb-3">
                                          <label class="form-label">Kegunaan</label>
                                          <input type="text" class="form-control" name="kegunaan"
                                              value="<?= $data['kegunaan'] ?>" placeholder="...">
                                      </div>
                                      <div class="mb-3">
                                          <label class="form-label">Jenis Obat</label>
                                          <select class="form-select" name="jenisobat">
                                              <option value="<?= $data['jenis_obat'] ?>"><?= $data['jenis_obat'] ?>
                                              </option>
                                              <option value="tablet">tablet</option>
                                              <option value="kapsul">Kapsul</option>
                                              <option value="sirup">Sirup</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary"
                                          data-bs-dismiss="modal">Keluar</button>
                                      <button type="submit" class="btn btn-primary" name="edit"><i
                                              class="bi bi-save2"></i> Update</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!-- akhir modal edit -->

                  <!-- awal modal hapus -->
                  <div class="modal fade" id="modalhapus<?php echo $no ?>" data-bs-backdrop="static"
                      data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">HAPUS DATA</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                              </div>
                              <form action="aksi-obat.php" method="POST">
                                  <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                  <div class="modal-body">

                                      <h5 class="text-center"> Apakah Anda Yakin Menghapus Data Ini<br> <br>
                                          <span class="text-danger"><?php echo $no ?><i
                                                  class="bi bi-dash-lg"></i><?php echo $data['nama'] ?></span>
                                      </h5>

                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary"
                                          data-bs-dismiss="modal">Keluar</button>
                                      <button type="submit" class="btn btn-danger" name="bhapus">HAPUS</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!-- akhir modal hapus -->

                  <?php } ?>
              </tbody>

          </table>
          <!--awal  Modal data obat -->
          <div class="modal fade" id="modaltambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
              aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tabel Obat</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="aksi-obat.php" method="POST">
                          <div class="modal-body">

                              <div class="mb-3">
                                  <label class="form-label">Nama Obat</label>
                                  <input type="text" class="form-control" name="obat" placeholder="masukan nama obat">
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Kegunaan</label>
                                  <input type="text" class="form-control" name="kegunaan" placeholder="...">
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Jenis Obat</label>
                                  <select class="form-select" name="jenisobat">
                                      <option></option>
                                      <option value="tablet">tablet</option>
                                      <option value="kapsul">Kapsul</option>
                                      <option value="sirup">Sirup</option>
                                  </select>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                              <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <!-- akhir modal tambh obat -->
      </div>
      </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $main_url ?>asset/dist/js/bootstrap.bundle.min.js"></script>

  <?php require "../template/footer.php"; ?>