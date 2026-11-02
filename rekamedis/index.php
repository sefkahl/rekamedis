<?php

session_start();
if (!isset($_SESSION['ssLoginRM'])) {
 header("location: ../auth/login.php");
 exit();
}
require "../config.php";

$title = "Data | SISTEM MEDIS";

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
  <H2>DATA PEREKEMAN</H2>
  <br>

  <a href="<?php echo $main_url ?>tambah-data.php"
   style="display:inline-flex; align-items:center; gap:8px; padding: 8px 8px; background:#0d6efd; color:aliceblue; border-radius:5px; text-decoration:none; font-size:14px; font-weight:500; transition:all 0.2s;">
   <i class="bi bi-arrow-bar-left"></i>Kembali
  </a>
 </div>
 <div class="col-md-12">
  <div class="mb-3 mt-3">
   <a href="<?= $main_url ?>rekamedis/tambah-data.php" class="btn btn-success py-1 px-2 rounded-0"
    title="tambah data"><i class="bi bi-plus-lg"></i> Tambah Data</a>
  </div>
 </div>
 <div class="card-body col-md-12">
  <table class="table table-bordered table-striped table-hover" id="myTable">
   <thead class="table-dark">
    <tr>
     <th class="text-center">NO</th>
     <th>TANGGAL</th>
     <th>PASIEN</th>
     <th>ALAMAT</th>
     <th>KELUHAN</th>
     <th>DOKTER</th>
     <th>DIAGNOSA</th>
     <th>OBAT</th>
     <th class="text-center">ACTION</th>
    </tr>

   </thead>
   <tbody>
    <?php
    $no = 1;
    $sqlrm    = "SELECT *, tbl_pasien.alamat AS alamatpasien FROM tbl_rekamedis INNER JOIN tbl_pasien ON tbl_rekamedis.id_pasien = tbl_pasien.id INNER JOIN tbl_user ON tbl_rekamedis.id_dokter =
tbl_user.userid order by tgl_rm desc";
    $queryrm  = mysqli_query($koneksi, $sqlrm);
    while ($rm = mysqli_fetch_array($queryrm)) { ?>

     <tr>
      <td class="text-center"><?php echo $no++ ?></td>
      <td><?php echo in_date($rm['tgl_rm']) ?></td>
      <td><?php echo $rm['nama'] ?></td>
      <td><?php echo $rm['alamatpasien'] ?></td>
      <td><?php echo $rm['keluhan'] ?></td>
      <td><?php echo $rm['fullname'] ?></td>
      <td><?php echo $rm['diagnosa'] ?></td>
      <td><?php echo $rm['obat'] ?></td>

      <td class="text-center">
       <div class="d-flex justify-content-center gap-1">
        <a href="edit-data.php?id=<?php echo $rm['no_rm'] ?>" class="btn btn-warning btn-sm"
         title="Edit Data"><i class="bi bi-pencil-square"></i></a>
        <a href="proses-data.php?id=<?php echo $rm['no_rm'] ?>&aksi=hapus-data"
         class="btn btn-danger btn-sm" onclick="hapus(event, this)"><i
          class="bi bi-trash3"></i></a>
      </td>
     </tr>

    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
     function hapus(e, el) {
      e.preventDefault();

      Swal.fire({
       title: "Apakah Anda yakin?",
       text: "Data yang dihapus tidak dapat dikembalikan!",
       icon: "warning",
       showCancelButton: true,
       confirmButtonColor: "#3085d6",
       cancelButtonColor: "#d33",
       confirmButtonText: "Ya, hapus!",
       cancelButtonText: "Batal"
      }).then((result) => {
       if (result.isConfirmed) {
        Swal.fire({
         title: "Deleted!",
         text: "Data berhasil dihapus.",
         icon: "success"
        }).then(() => {
         window.location.href = el.href;
        });
       }
      });

      return false;
     }
    </script>
    <?php require "../template/footer.php"; ?>