<?php
session_start();
include "../config.php";

if (@$_GET['aksi'] == 'hapus-pasien') {
      $id = $_GET['id'];
      mysqli_query($koneksi, "DELETE FROM tbl_pasien WHERE id = '$id'");
      $_SESSION['info_hapus'] = 'sukses';
      header("location: data-pasien.php");
      exit();
}
?>