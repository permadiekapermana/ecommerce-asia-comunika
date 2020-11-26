<?php
error_reporting(0);
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumb.php";

$page=$_GET[page];
$act=$_GET[act];

// Input users
if ($page=='DataAdmin' AND $act=='input'){

$username     = $_POST['username'];
$password     = md5($_POST['password']);
$nama_lengkap = $_POST['nama_lengkap'];
$no_telp      = $_POST['no_telp'];
$email        = $_POST['email'];
$blokir       = 'N';

$Q=mysql_query("INSERT INTO admin (username, password, nama_lengkap, email, no_telp, blokir) VALUES ('$username', '$password',  '$nama_lengkap', '$email', '$no_telp', '$blokir')");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

  
}

// Update perangkatdesa
elseif ($page=='DataAdmin' AND $act=='update'){

  if (empty($_POST[password]) ){

  $username     = $_POST['username'];
  $nama_lengkap = $_POST['nama_lengkap'];
  $no_telp      = $_POST['no_telp'];
  $email        = $_POST['email'];
  $blokir       = $_POST['blokir'];
  
  $Q=mysql_query("UPDATE admin SET nama_lengkap = '$nama_lengkap', email = '$email', no_telp ='$no_telp',  blokir='$blokir' WHERE username='$username'");

  }
  else {

  $username     = $_POST['username'];
  $password     = md5($_POST['password']);
  $nama_lengkap = $_POST['nama_lengkap'];
  $no_telp      = $_POST['no_telp'];
  $email        = $_POST['email'];
  $user_aktif   = $_POST['blokir'];
  
  $Q=mysql_query("UPDATE admin SET password='$password', nama_lengkap = '$nama_lengkap', email = '$email', no_telp ='$no_telp',  blokir='$blokir' WHERE username='$username'");

  }

  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  
}

}

?>
