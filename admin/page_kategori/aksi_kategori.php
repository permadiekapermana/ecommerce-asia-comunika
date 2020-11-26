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
if ($page=='Kategori' AND $act=='input'){

$id_kategori  = $_POST['id_kategori'];
$kategori     = $_POST['kategori'];

$Q=mysql_query("INSERT INTO kategori (id_kategori, kategori) VALUES ('$id_kategori', '$kategori')");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

  
}

// Update perangkatdesa
elseif ($page=='Kategori' AND $act=='update'){

$id_kategori  = $_POST['id_kategori'];
$kategori     = $_POST['kategori'];
  
  $Q=mysql_query("UPDATE kategori SET kategori = '$kategori' WHERE id_kategori='$id_kategori'");

  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  
}

elseif ($page=='Kategori' AND $act=='hapus'){

  $Q=mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");

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
