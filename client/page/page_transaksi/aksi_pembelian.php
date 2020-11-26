<?php
error_reporting(0);
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$page=$_GET[page];
$act=$_GET[act];

// Input users
if ($page=='pembelian' AND $act=='selesai'){

  $id = $_GET[id];
  $metode = $_GET[metode];
  $tampil = mysql_query("SELECT * FROM orders WHERE  no_invoice='$id' ");
  $r=mysql_fetch_array($tampil);
  

if($r['metode_bayar']=='Transfer'){

$Q  = mysql_query("UPDATE orders SET status_order = 'Selesai' WHERE no_invoice='$id'");

if($Q) {
  header('location:../../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../../menu.php?page=$page';</script>";
}
  
}elseif($r['metode_bayar']=='COD'){

$tgl_skrg = date("Ymd");

$Q  = mysql_query("UPDATE orders SET status_order = 'Selesai', tgl_bayar='$tgl_skrg' WHERE no_invoice='$id'");

if($Q) {
  header('location:../../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../../menu.php?page=$page';</script>";
}

}

}

elseif ($page=='pembelian' AND $act=='batal'){

  $id = $_GET[id];
  $metode = $_GET[metode];
  $tampil = mysql_query("SELECT * FROM orders WHERE  no_invoice='$id' ");
  $r=mysql_fetch_array($tampil);
  

$Q  = mysql_query("UPDATE orders SET status_order = 'Dibatalkan' WHERE no_invoice='$id'");

if($Q) {
  header('location:../../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../../menu.php?page=$page';</script>";
}

}

elseif ($page=='pembelian' AND $act=='selesaikomplain'){

  $id = $_GET[id];
  $metode = $_GET[metode];
  $tampil = mysql_query("SELECT * FROM komplain WHERE  no_invoice='$id' ");
  $r=mysql_fetch_array($tampil);
  

$Q  = mysql_query("UPDATE komplain SET status = 'Selesai' WHERE no_invoice='$id'");
mysql_query("UPDATE orders SET status_order = 'Selesai' WHERE no_invoice='$id'");

if($Q) {
  header('location:../../menu.php?page=riwayat_komplain');
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../../menu.php?page=$page';</script>";
}

}

}

?>
