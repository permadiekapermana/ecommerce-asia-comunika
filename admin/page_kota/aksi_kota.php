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
if ($page=='DataKota' AND $act=='input'){

$id_kota      = $_POST['id_kota'];
$id_provinsi  = $_POST['id_provinsi'];
$kota         = $_POST['kota'];
$ongkir       = $_POST['ongkir'];

$Q=mysql_query("INSERT INTO kota (id_kota, id_provinsi, kota, ongkir) VALUES ('$id_kota', '$id_provinsi', '$kota', '$ongkir')");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

  
}

// Update perangkatdesa
elseif ($page=='DataKota' AND $act=='update'){

  $id_kota      = $_POST['id_kota'];
  $id_provinsi  = $_POST['id_provinsi'];
  $kota         = $_POST['kota'];
  $ongkir       = $_POST['ongkir'];
  
  $Q=mysql_query("UPDATE kota SET id_provinsi = '$id_provinsi', id_kota = '$id_kota', kota = '$kota', ongkir = '$ongkir' WHERE id_kota='$id_kota'");

  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  
}

elseif ($page=='DataKota' AND $act=='hapus'){

  $Q=mysql_query("DELETE FROM kota WHERE id_kota='$_GET[id]'");

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
