<?php
date_default_timezone_set('Asia/Jakarta');

$server     =  'localhost';
$user       = 'root';
$password   = '';
$dbnama     = 'rm_datapasien';


$koneksi = mysqli_connect($server, $user, $password, $dbnama);
// if (!$koneksi){
//     die("Koneksi Gagal");
// }
// else{
//     echo "Koneksi Berhasil";
// }

$main_url = "http://localhost/rm_datapasien/";

function uploadgambar($url)
{
$namafile      = $_FILES['gambar']['name'];
$ukuran        = $_FILES['gambar']['size'];
$tmp           = $_FILES['gambar']['tmp_name'];
$ekstensiValid = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$ekstensiFile  = explode('.', $namafile);
$ekstensiFile  = strtolower(end($ekstensiFile));
if (!in_array($ekstensiFile, $ekstensiValid)) {
    echo "<script>
        alert(' input user gagal, file yang anda upload bukan gambar !')                       
        window.location = '$url';
        </script>";
    die();
}
if ($ukuran >  2097152) {
    echo "<script>
            alert('Ukuran file maksimal 2 MB!')            
            window.location = '$url';
        </script>";
    die();
}
$namafileBaru = time() . '-' . $namafile;
move_uploaded_file($tmp, '../asset/image/' . $namafileBaru);
return $namafileBaru;
}
function in_date($tgl)
{
$dd = substr($tgl, 8, 2);
$mm = substr($tgl, 5, 2);
$yy = substr($tgl, 0, 4);
return $dd . "-" . $mm . "-" . $yy;
}

function htgUmur($tgl_lahir)
{
    $tglLahir = new DateTime($tgl_lahir);
    $hariIni = new DateTime("today");

    $umur = $hariIni->diff($tglLahir)->y;

    return $umur . " tahun";
}
?>