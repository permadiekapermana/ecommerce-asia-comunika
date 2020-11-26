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
if ($page=='Merek' AND $act=='input'){

$id_merek  = $_POST['id_merek'];
$merek     = $_POST['merek'];

$Q=mysql_query("INSERT INTO merek (id_merek, merek) VALUES ('$id_merek', '$merek')");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

  
}

// Update perangkatdesa
elseif ($page=='Merek' AND $act=='update'){

$id_merek  = $_POST['id_merek'];
$merek     = $_POST['merek'];
  
  $Q=mysql_query("UPDATE merek SET merek = '$merek' WHERE id_merek='$id_merek'");

  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  
}

elseif ($page=='Merek' AND $act=='hapus'){

  $Q=mysql_query("DELETE FROM merek WHERE id_merek='$_GET[id]'");

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
