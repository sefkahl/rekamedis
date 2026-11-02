<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
header("location: ../auth/login.php");
exit();
}
require "../config.php";

//Tambah Pasien Baru
if (isset($_POST['simpan'])) {
$nama       = trim(htmlspecialchars($_POST['nama']));
$nik       = trim(htmlspecialchars($_POST['nik']));
$tgl_lahir  = $_POST['tgl_lahir'];
$gender     = $_POST['gender'];
$telepon    = trim(htmlspecialchars($_POST['telepon']));
$alamat     = trim(htmlspecialchars($_POST['alamat']));
$id         = date('ymdhis');

mysqli_query($koneksi, "INSERT INTO tbl_pasien VALUES ('$id', '$nama', '$nik', '$tgl_lahir', '$gender', '$telepon', '$alamat')");

echo "<script>
        alert('Pasien Baru  berhasil di registrasi..');
        window.location = 'tambah-pasien.php';    
    </script>";
return;
}

//   update pasien baru
if (isset($_POST['update'])) {
$nama       = trim(htmlspecialchars($_POST['nama']));
$nik       = trim(htmlspecialchars($_POST['nik']));
$tgl_lahir  = $_POST['tgl_lahir'];
$gender     = $_POST['gender'];
$telepon    = trim(htmlspecialchars($_POST['telepon']));
$alamat     = trim(htmlspecialchars($_POST['alamat']));
$id         = trim(htmlspecialchars($_POST['id']));

mysqli_query($koneksi, "UPDATE tbl_pasien SET
                                                nama       = '$nama',
                                                nik        = '$nik',
                                                tgl_lahir  = '$tgl_lahir',
                                                gender     = '$gender',
                                                telepon    = '$telepon',
                                                alamat     = '$alamat'
                                          WHERE id         = '$id'");


echo "<script>
        alert('Pasien Baru  berhasil di update..');
        window.location = 'data-pasien.php';    
    </script>";
return;
}
?>