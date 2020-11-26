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
if ($page=='checkout' AND $act=='input'){

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

$no_invoice     = $_POST['no_invoice'];
$status_order	= 'Menunggu Pembayaran';
$metode_bayar   = $_POST['metode_bayar'];
$u_pembeli      = $_SESSION[namauser];
$id_produk		= $_POST['id_produk'];
$jumlah			= $_POST['jumlah'];
$latitude			= $_POST['latitude'];
$longitude			= $_POST['longitude'];
$total_tagihan			= $_POST['total_tagihan'];
$jml=count($_POST[id_produk]);

if($metode_bayar=='Transfer'){

	$Q=mysql_query("INSERT INTO orders (no_invoice, status_order, tgl_order, jam_order, total_tagihan, metode_bayar, latitude, longitude, u_pembeli) VALUES ('$no_invoice', '$status_order', '$tgl_skrg', '$jam_skrg', '$total_tagihan', '$metode_bayar', '$latitude', '$longitude', '$u_pembeli')");	

	for ($i=0; $i < $jml; $i++){
	mysql_query("INSERT INTO orders_detail (no_invoice, id_produk, jumlah) VALUES ('$no_invoice', '$id_produk[$i]', '$jumlah[$i]')");	
	mysql_query("DELETE FROM keranjang WHERE username = '$u_pembeli' AND id_produk = '$id_produk[$i]' AND jumlah = '$jumlah[$i]'");		
	}


	if($Q) {
	  header('location:../../menu.php?page=confirmation&id='.$no_invoice);
	}
	else{
	  echo "<script>alert('Gagal menyimpan data!')</script>";
	  echo "<script>window.location = 'location:../../menu.php?page=checkout';</script>";
	}

}
else{

	$Q=mysql_query("INSERT INTO orders (no_invoice, status_order, tgl_order, jam_order, total_tagihan, metode_bayar, latitude, longitude, u_pembeli) VALUES ('$no_invoice', 'Sedang Diproses', '$tgl_skrg', '$jam_skrg', '$total_tagihan', 'COD', '$latitude', '$longitude', '$u_pembeli')");

	for ($i=0; $i < $jml; $i++){
	mysql_query("INSERT INTO orders_detail (no_invoice, id_produk, jumlah) VALUES ('$no_invoice', '$id_produk[$i]', '$jumlah[$i]')");
	mysql_query("DELETE FROM keranjang WHERE username = '$u_pembeli' AND id_produk = '$id_produk[$i]' AND jumlah = '$jumlah[$i]'");		
	}


	if($Q) {
	  header('location:../../menu.php?page=confirmation&id='.$no_invoice);
	}
	else{
	  echo "<script>alert('Gagal menyimpan data!')</script>";
	  echo "<script>window.location = 'location:../../menu.php?page=checkout';</script>";
	}

}

}

}

?>
