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
if ($page=='pdetail' AND $act=='input'){

$id_produk    = $_POST['id_produk'];
$username     = $_POST['username'];
$id_keranjang = $_POST['id_keranjang'];
$jumlah       = $_POST['jumlah'];
$q1 = mysql_query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
$r = mysql_fetch_array($q1);

if ($r[stok]==0){
  echo "<script>window.alert('Maaf Stok Barang Habis!'); window.location=('../../menu.php?page=katalog')</script>";
} elseif ($r[stok] < $jumlah) {

  echo "<script>window.alert('Jumlah pembelian melebihi stok barang !'); window.location=('../../menu.php?page=katalog')</script>";

} else {

  $sql = mysql_query("SELECT id_produk FROM keranjang WHERE id_produk = '$id_produk' AND username = '$username'");
  $ketemu = mysql_num_rows($sql);
  
  if ($ketemu == 0){
    $Q=mysql_query("INSERT INTO keranjang (id_keranjang, username, id_produk, jumlah) VALUES ('$id_keranjang', '$username', '$id_produk', '$jumlah')");


    if($Q) {
      header('location:../../menu.php?page=keranjang');
    }
    else{
      echo "<script>alert('Gagal menyimpan data!')</script>";
      echo "<script>window.location = '../../menu.php?page=keranjang';</script>";
    }
  } else {

    $cek_keranjang = mysql_query("SELECT id_produk, jumlah FROM keranjang WHERE id_produk = '$id_produk' AND username = '$username'");
    $ketemu2 = mysql_fetch_array($cek_keranjang);
    $q2 = mysql_query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $r2 = mysql_fetch_array($q2);
    $total = $ketemu2[jumlah] + $jumlah;

    if ($r[stok] < $total) {
      echo "<script>window.alert('Barang yang ingin anda tambahkan sudah ada dikeranjang dan jumlah yang anda ingin tambah melebihi stok !'); window.location=('../../menu.php?page=keranjang')</script>";
    }
    else{

    $Q  = mysql_query("UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE id_produk = '$id_produk' AND username = '$username'");

    if($Q) {
      header('location:../../menu.php?page=keranjang');
    }
    else{
      echo "<script>alert('Gagal menyimpan data!')</script>";
      echo "<script>window.location = '../../menu.php?page=keranjang';</script>";
    }
  }

  }
  }	  
  
}

elseif ($page=='pdetail' AND $act=='input2'){

$id_produk    = $_GET['id_produk'];
$username     = $_GET['username'];
$id_keranjang = $_GET['id_keranjang'];
$jumlah       = 1;
$q1 = mysql_query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
$r = mysql_fetch_array($q1);

if ($r[stok]==0){
  echo "<script>window.alert('Maaf Stok Barang Habis!'); window.location=('../../menu.php?page=katalog')</script>";
} elseif ($r[stok] < $jumlah) {

  echo "<script>window.alert('Jumlah pembelian melebihi stok barang !'); window.location=('../../menu.php?page=katalog')</script>";

} else {

  $sql = mysql_query("SELECT id_produk FROM keranjang WHERE id_produk = '$id_produk' AND username = '$username'");
  $ketemu = mysql_num_rows($sql);
  
  if ($ketemu == 0){
    $Q=mysql_query("INSERT INTO keranjang (id_keranjang, username, id_produk, jumlah) VALUES ('$id_keranjang', '$username', '$id_produk', '$jumlah')");


    if($Q) {
      header('location:../../menu.php?page=keranjang');
    }
    else{
      echo "<script>alert('Gagal menyimpan data!')</script>";
      echo "<script>window.location = '../../menu.php?page=keranjang';</script>";
    }
  } else {

    $cek_keranjang = mysql_query("SELECT id_produk, jumlah FROM keranjang WHERE id_produk = '$id_produk' AND username = '$username'");
    $ketemu2 = mysql_fetch_array($cek_keranjang);
    $q2 = mysql_query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $r2 = mysql_fetch_array($q2);
    $total = $ketemu2[jumlah] + $jumlah;

    if ($r[stok] < $total) {
      echo "<script>window.alert('Barang yang ingin anda tambahkan sudah ada dikeranjang dan jumlah yang anda ingin tambah melebihi stok !'); window.location=('../../menu.php?page=keranjang')</script>";
    }
    else{

    $Q  = mysql_query("UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE id_produk = '$id_produk' AND username = '$username'");

    if($Q) {
      header('location:../../menu.php?page=keranjang');
    }
    else{
      echo "<script>alert('Gagal menyimpan data!')</script>";
      echo "<script>window.location = '../../menu.php?page=keranjang';</script>";
    }
  }

  }
  }	  
 
}


}

?>