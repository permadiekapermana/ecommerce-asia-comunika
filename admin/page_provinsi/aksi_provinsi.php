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
if ($page=='DataProvinsi' AND $act=='input'){

$id_provinsi  = $_POST['id_provinsi'];
$provinsi     = $_POST['provinsi'];

$Q=mysql_query("INSERT INTO provinsi (id_provinsi, provinsi) VALUES ('$id_provinsi', '$provinsi')");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

  
}

// Update perangkatdesa
elseif ($page=='DataProvinsi' AND $act=='update'){

$id_provinsi  = $_POST['id_provinsi'];
$provinsi     = $_POST['provinsi'];
  
  $Q=mysql_query("UPDATE provinsi SET provinsi = '$provinsi' WHERE id_provinsi='$id_provinsi'");

  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  
}

elseif ($page=='DataProvinsi' AND $act=='hapus'){

  $Q=mysql_query("DELETE FROM provinsi WHERE id_provinsi='$_GET[id]'");

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
