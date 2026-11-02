<?php

session_start();
if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../auth/login.php");
  exit();
}
require "../config.php";

$title = "Laporan| SISTEM MEDIS";

require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$id = $_GET['id'];

$queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien WHERE id = '$id'");
$pasien = mysqli_fetch_array($queryPasien);

if ($pasien['gender'] == 'p') {
  $gender = 'pria';
} else {
  $gender = 'wanita';
}
$content = '

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        
 <style>
            /* KOP SURAT KLASIK STANDAR INSTANSI */
      .kop-surat {
          text-align: center;
          margin-bottom: 2px;
      }
      .kop-surat .nama-instansi {
          font-family: "Times New Roman", Times, serif;
          font-size: 20px;
          font-weight: bold;
          margin: 0;
          text-transform: uppercase;
          color: #000000;
      }
      .kop-surat .alamat-instansi {
          font-family: "Times New Roman", Times, serif;
          margin: 4px 0 0 0;
          font-size: 12px;
          color: #000000;
      }
      .garis-tebal-kembar {
          border: 0;
          border-top: 3px solid #000000;  
          height: 2px;
          margin-top: 5px;
          margin-bottom: 20px;
      }

      /* JUDUL LAPORAN UTAMA */
      .head { 
          font-family: "Times New Roman", Times, serif;
          text-align: center;
          margin-bottom: 25px;
          font-size: 16px;
          font-weight: bold;
          text-transform: uppercase;
          color: #000000;
      }


       .label-head{

                width: 120px;
                padding-left: 1px;
                padding-bottom: 5px;
                text-align: left;
            }
        .data-left{
                width: 300px;
                padding-left: 1px;
                padding-bottom: 5px;
                text-align: left;
        }        

        .data-right{
                width: 130px;
                padding-left: 1px;
                padding-bottom: 5px;
                text-align: left;
        }  
        .hr{
                margin-bottom: 2px;
                margin-left: -5px;
                width: 700px;
        }   

        .table-head{
                width: 130px;
                padding-left: 1px;
                padding-bottom: 5px;
                text-align: left;
        }                    
        
        .data{
        vertikal-align: top;
        }

    </style>


      </head>
                <body>
        
          <div class="kop-surat">
              <div class="nama-instansi">RS Sentra Medika Jaya</div>
              <div class="alamat-instansi">Jl. Bilal Pulo Brayan No. 52, Kecamatan Medan Timur </div>
          </div>
          <div class="garis-tebal-kembar"></div>

          <!-- JUDUL LAPORAN -->
          <div class="head">Laporan Hasil Rekam Medis Pasien</div>

    <table>
        <tr>
            <th class="label-head">Nama Pasien</th>        
            <td class="data-left">: ' . $pasien['nama'] . '</td>
            <th class="label-head">Jenis Kelamin</th>
            <td class="data-right">: ' . $gender . '</td>
            <tr>
            <th class="label-head">NIK Pasien</th>
            <td class="data-left" colspan="3">: ' . $pasien['nik'] . '</td>
        </tr>
        </tr>
          <tr>
            <th class="label-head">Umur</th>        
            <td class="data-left">: ' . htgUmur($pasien['tgl_lahir']) . '</td>
            <th class="label-head">Telepon/HP</th>
            <td class="data-right">: ' . $pasien['telepon'] . '</td>
        </tr>
         <tr>
            <th class="label-head">Alamat</th>        
            <td class="data-left" colspan="3">: ' . $pasien['alamat'] . '</td>
        </tr>
     </table>

      <table>

        <thead>
              <tr>
                <th colspan="5">
                    <hr size="3" class="hr">
                </th>
            </tr>
            <tr>
            <th class="table-head" style="widht: 900px">Tanggal</th>
            <th class="table-head" style="widht: 200px">Keluhan</th>
            <th class="table-head" style="widht: 120px">Diagnosa</th>
            <th class="table-head" style="widht: 200px">Obat</th>
            <th class="table-head" style="widht: 70px">Dokter</th>
            </tr>

            <tr>
            <th colspan="5">
                    <hr size="3" class="hr">
                </th>
            </tr>
        </thead>

          <tbody>';

$sqlrm = "SELECT * FROM tbl_rekamedis INNER JOIN tbl_user ON
tbl_rekamedis.id_dokter = tbl_user.userid WHERE id_pasien = '$id'";



$queryrm = mysqli_query($koneksi, $sqlrm);
while ($rm = mysqli_fetch_array($queryrm)) {
  $content .= '<tr>
         <td class="data">' . in_date($rm['tgl_rm']) . '</td>
         <td class="data">' . $rm['keluhan'] . '</td>
         <td class="data">' . $rm['diagnosa'] . '</td>
         <td class="data">' . $rm['obat'] . '</td>
         <td class="data">' . $rm['fullname'] . '</td>
        </tr>';
}
$content .=
  '</tbody>

        <tfoot>
            <tr>
            <th colspan="5">
            <hr size="3" class="hr">
            </th>
            </tr>        
        </tfoot>       

      </table>
</body>
</html>';

$dompdf->loadHtml($content);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Laporan-Rekam-Medis.pdf', array('Attachment' => 0));
exit();
