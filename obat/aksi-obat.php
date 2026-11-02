<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config.php";

/* SIMPAN */
if (isset($_POST['bsimpan'])) {

    $nama       = $_POST['obat'];
    $kegunaan   = $_POST['kegunaan'];
    $jenis_obat = $_POST['jenisobat'];

    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_obat (nama, kegunaan, jenis_obat) VALUES ('$nama', '$kegunaan', '$jenis_obat')");

    if ($simpan) {
        echo "<script>
            alert('simpan data sukses..!');
            document.location='data-obat.php';
        </script>";
    } else {
        echo "<script>
            alert('gagal menyimpan data..!');
            document.location='data-obat.php';
        </script>";
    }
}
/* EDIT */
if (isset($_POST['edit'])) {

    $id         = $_POST['id'];
    $nama       = $_POST['obat'];
    $kegunaan   = $_POST['kegunaan'];
    $jenis_obat = $_POST['jenisobat'];

    $edit = mysqli_query($koneksi,"UPDATE tbl_obat SET
                                                        nama        = '$nama',
                                                        kegunaan    = '$kegunaan',
                                                        jenis_obat  = '$jenis_obat'
                                                  WHERE id          = '$id'");
    if ($edit) {
        echo "<script>
            alert('update data sukses..!');
            document.location='data-obat.php';
        </script>";
    } else {
        echo "<script>
            alert('gagal update data..!');          
            document.location='data-obat.php';
        </script>";
    }
}
if (isset($_POST['bhapus'])) {

    $hapus  = mysqli_query($koneksi, "DELETE  FROM  tbl_obat WHERE id = '$_POST[id]'");
    if ($hapus) {
        echo "<script>
            alert('hapus data sukses..!');
            document.location='data-obat.php';
        </script>";

    } else {
        echo "<script>
        alert('hapus data gagal');
        document.location='data-obat.php';
        </script>";

    }
}
?>