<?php
session_start();
if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../auth/login.php");
    exit();
}
require "../config.php";

// ===================================
// ===   SIMPAN DATA REKAM MEDIS   ===
// ===================================

if (isset($_POST['simpan'])) {
    $no_rm      = $_POST['noRm'];
    $tgl        = $_POST['tgl'];
    $id_pasien  = $_POST['pasien'];
    $keluhan    = trim(htmlspecialchars($_POST['keluhanpasien']));
    $dokter     = $_POST['dokter'];
    $diagnosa   = trim(htmlentities($_POST['diagnosa']));
    $obat = trim(htmlspecialchars($_POST['obat']));

    $dataObat = json_decode($_POST['obat'], true);
    if (is_array($dataObat)) {
        $namaObat = [];
        foreach ($dataObat as $item) {
            $namaObat[] = $item['value'];
        }
        $obat = implode(', ', $namaObat);
    }
    $query  = "INSERT INTO tbl_rekamedis VALUES ('$no_rm', '$tgl', '$id_pasien', '$keluhan', '$dokter', '$diagnosa', '$obat')";
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        header("location: tambah-data.php?msg=added");
        exit();
    } else {
        echo "<script>
            alert('Gagal menyimpan data rekam medis: " . mysqli_error($koneksi) . "');
            window.location='tambah-data.php';
        </script>";
        exit();
    }
}

// ===================================
// ===   UPDATE DATA REKAM MEDIS   ===
// ===================================

if (isset($_POST['update'])) {
    $no_rm     = $_POST['no_rm'];
    $tgl       = $_POST['tgl'];
    $id_pasien = $_POST['pasien'];
    $keluhan   = trim(htmlspecialchars($_POST['keluhanpasien']));
    $dokter    = $_POST['dokter'];
    $diagnosa  = trim(htmlentities($_POST['diagnosa']));
    $obat      = trim(htmlspecialchars($_POST['obat']));

      $dataObat = json_decode($_POST['obat'], true);
    if (is_array($dataObat)) {
        $namaObat = [];
        foreach ($dataObat as $item) {
            $namaObat[] = $item['value'];
        }
        $obat = implode(', ', $namaObat);
    }


    $query = "UPDATE tbl_rekamedis SET
                                        tgl_rm      = '$tgl',
                                        id_pasien   = '$id_pasien',
                                        keluhan     = '$keluhan',
                                        id_dokter   = '$dokter',
                                        diagnosa    = '$diagnosa',
                                        obat        = '$obat'
                                  WHERE no_rm       = '$no_rm'";

    $update = mysqli_query($koneksi, $query);
    if ($update) {
        echo "<script>
            alert('Data berhasil diupdate!');
            window.location='index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal update');
            window.location='edit-data.php';
        </script>";

    }
}

// ===============================
// =    HAPUS DATA REKAM MEDIS   =
// ===============================    

if (@$_GET['aksi'] == 'hapus-data') {
    $id = $_GET['id'];

    mysqli_query($koneksi, "DELETE FROM tbl_rekamedis WHERE no_rm = '$id'");

     if ($hapus) {
        header("Location: index.php?status=hapus");
    } else {
        header("Location: index.php?status=gagal");
    }
    exit();
}
?>