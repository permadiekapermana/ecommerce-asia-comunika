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
if ($page=='DataBank' AND $act=='input'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 

$id_bank        = $_POST['id_bank'];
$bank           = $_POST['bank'];
$no_rek         = $_POST['no_rek'];
$pemilik        = $_POST['pemilik'];

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadBank($nama_file_unik);
  $Q=mysql_query("INSERT INTO bank (id_bank, bank, no_rek, pemilik, gambar) VALUES ('$id_bank', '$bank', '$no_rek', '$pemilik', '$nama_file_unik')");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }

}
}
else{
  $Q=mysql_query("INSERT INTO bank (id_bank, bank, no_rek, pemilik) VALUES ('$id_bank', '$bank', '$no_rek', '$pemilik')");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
}

  
}

// Update perangkatdesa
elseif ($page=='DataBank' AND $act=='update'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 

$id_bank        = $_POST['id_bank'];
$bank           = $_POST['bank'];
$no_rek         = $_POST['no_rek'];
$pemilik        = $_POST['pemilik'];

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadBank($nama_file_unik);
  $cek  = mysql_fetch_array(mysql_query("SELECT * FROM bank where id_bank='$id_produk'"));
  unlink("../upload/bank/$cek[gambar]");
  $Q=mysql_query("UPDATE bank SET bank='$bank', no_rek='$no_rek', pemilik='$pemilik', gambar='$nama_file_unik' WHERE id_bank='$id_bank'");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }

}
}
else{
  $Q=mysql_query("UPDATE bank SET bank='$bank', no_rek='$no_rek', pemilik='$pemilik' WHERE id_bank='$id_bank'");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
}
  

  
}

elseif ($page=='DataBank' AND $act=='hapus'){
  
  $id = $_GET[id];
  $cek  = mysql_fetch_array(mysql_query("SELECT * FROM bank where id_bank='$id'"));
  unlink("../upload/bank/$cek[gambar]");

  $Q  = mysql_query("DELETE FROM bank WHERE id_bank='$id'");

if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}
  
}

}

?>
