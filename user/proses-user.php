<?php

      session_start();

        if (!isset($_SESSION['ssLoginRM'])) {
            header("location: ../auth/login.php");
            exit();
        }
     require "../config.php";

    if (isset($_POST['simpan'])) {

      $username = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['username']));
        $nama        = trim(htmlspecialchars($_POST['fullname']));
        $jabatan     = $_POST['jabatan'];
        $alamat      = trim(htmlspecialchars($_POST['alamat']));
        $gambar      =trim(htmlspecialchars($_FILES['gambar']['name']));
        $password    = trim(htmlspecialchars($_POST['password']));
        $password2   = trim(htmlspecialchars($_POST['password2']));

        $cekUsername =mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
        if (mysqli_num_rows($cekUsername)) {
            echo "<script>
                    alert('username sedang terpakai, user baru gagal di registrasi !')            
            
            window.location = 'tambah-user.php';
            </script>";
            return;
        }
        if ($password !== $password2) {
             echo "<script>
                    alert('konfirnasi password tidak sesuai, user baru gagal di registrasi !')            
            
            window.location = 'tambah-user.php';
            </script>";
            return;
        }
        $pass = password_hash($password, PASSWORD_DEFAULT);

        if($gambar != null) {
            $url = 'tambah-user.php';
            $gambar = uploadgambar($url);
        } else {
            $gambar = 'user.png';
        }
        mysqli_query($koneksi, "INSERT INTO tbl_user VALUES (null, '$username',
        '$nama','$pass','$jabatan','$alamat','$gambar')");

         echo "<script>
                    alert('user baru berhasil di registrasi !')            
              window.location = 'tambah-user.php';
            </script>";
            return;
        }
        //  update use php

    if (isset($_POST['update'])) {
        $id        = $_POST['id'];
        $userLama  = trim(htmlspecialchars($_POST['usernameLama']));
        $username  = trim(htmlspecialchars($_POST['username']));
        $nama      = trim(htmlspecialchars($_POST['fullname']));
        $jabatan   = $_POST['jabatan'];
        $alamat    = trim(htmlspecialchars($_POST['alamat']));
        $gambar    =trim(htmlspecialchars($_FILES['gambar']['name']));
        $gambarLama    =trim(htmlspecialchars($_POST['gambarLama']));
        $cekUsername =mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

        if ($username !== $userLama) {
             if (mysqli_num_rows($cekUsername)) {   
          echo "<script>
               alert('Username sudah terpakai, user gagal disimpan!');
               window.location = 'index.php';
               </script>";
            return;
        }                                                                                                                                                       
            echo "<script>
                    alert('username sedang terpakai, user baru gagal di registrasi !')            
            
            window.location = 'tambah-user.php';
            </script>";
            return;
        }
        if($gambar != null) {
            $url = 'index.php';
            $gambarUser = uploadgambar($url);
            if ($gambarLama !== 'user.png') {
                @unlink('/../asset/image/' . $gambarLama);
            }
        } else {
            $gambarUser = $gambarLama;
        }
        mysqli_query($koneksi, "UPDATE tbl_user SET username = '$username',
                                                    fullname = '$nama',
                                                    jabatan  = '$jabatan',
                                                    alamat   = '$alamat',
                                                    gambar   = '$gambarUser'
                                              WHERE userid   = $id");

         echo "<script>
                    alert('data user berhasil di update !')            
            
            window.location = 'index.php';
            </script>";
            return;
        }
        // ganti password
        if(isset($_POST['ganti-password'])) {
            $curPass    = trim(htmlspecialchars($_POST['oldPass']));
            $newPass    = trim(htmlspecialchars($_POST['newPass']));
            $confPass   = trim(htmlspecialchars($_POST['confPass']));

            $userLogin = $_SESSION['ssLoginRM'];
            $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$userLogin'");
            $dataUser  = mysqli_fetch_assoc($queryUser);

            if ($newPass !== $confPass) {
            echo "<script>
                alert ('konfirmasi password tidak valid..!');
                window.location = '../auth/password.php';
                </script>";
                return false;
            }
            if(!password_verify($curPass, $dataUser['password'])) {
            echo "<script>
                alert ('password lama tidak valid..!');
                window.location = '../auth/password.php';
                </script>";
                return false;
            } else {
                $pass = password_hash($newPass, PASSWORD_DEFAULT);
                mysqli_query($koneksi, "UPDATE tbl_user SET password =
                '$pass' WHERE username = '$userLogin'");
                 if(!password_verify($curPass, $dataUser['password'])) {

            echo "<script>
                alert ('password berhasil di perbarui..!');
                window.location = '../auth/password.php';
                </script>";
                return true;
            }
            }
        }      
        if (@$_GET['aksi'] == 'hapus-user') {
            $id = $_GET['id'];
            $gambar = $_GET['gambar'];

            mysqli_query($koneksi, "DELETE FROM tbl_user WHERE userid = $id");
            if ($gambar != 'user.jpg'){
            unlink('../asset/image/' .$gambar);
        }
        echo "<script>
                    alert('data user berhasil di hapus!')            
             window.location = 'index.php';
            </script>";
            return; 
        }   
?>