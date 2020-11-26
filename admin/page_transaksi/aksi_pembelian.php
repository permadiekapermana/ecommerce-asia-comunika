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
if ($page=='Pembelian' AND $act=='confirm'){

$no_resi      = $_POST['no_resi'];
$status_order  = $_POST['status_order'];
$no_invoice  = $_POST['no_invoice'];

$Q=mysql_query("UPDATE orders SET status_order='$status_order', no_resi='$no_resi' WHERE no_invoice='$no_invoice'");


if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menyimpan data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

  
}

elseif ($page=='Pembelian' AND $act=='komplain'){

  $solusi      = $_POST['solusi'];
  $keterangan2  = $_POST['keterangan2'];
  $no_invoice  = $_POST['no_invoice'];
  
  $Q=mysql_query("UPDATE komplain SET status='Selesai', solusi='$solusi', keterangan2='$keterangan2' WHERE no_invoice='$no_invoice'");
  
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
  
    
  }

elseif ($page=='Pembelian' AND $act=='tolak'){
  
  $id = $_GET[id];

  $Q  = mysql_query("UPDATE orders SET status_order = 'Ditolak', u_toko = '$_SESSION[namauser]' WHERE no_invoice='$id'");

if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}
  
}

elseif ($page=='Pembelian' AND $act=='selesai'){
  
  $id = $_GET[id];
  $metode = $_GET[metode];
  $tampil = mysql_query("SELECT * FROM orders WHERE  no_invoice='$id' ");
  $r=mysql_fetch_array($tampil);
  

if($r['metode_bayar']=='Transfer'){

$Q  = mysql_query("UPDATE orders SET status_order = 'Selesai', u_toko = '$_SESSION[namauser]' WHERE no_invoice='$id'");

if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}
  
}elseif($r['metode_bayar']=='COD'){

$tgl_skrg = date("Ymd");

$Q  = mysql_query("UPDATE orders SET status_order = 'Selesai', tgl_bayar='$tgl_skrg', u_toko = '$_SESSION[namauser]' WHERE no_invoice='$id'");

if($Q) {
  header('location:../menu.php?page='.$page);
}
else{
  echo "<script>alert('Gagal menghapus data!')</script>";
  echo "<script>window.location = '../menu.php?page=$page';</script>";
}

}

}

}

?>
