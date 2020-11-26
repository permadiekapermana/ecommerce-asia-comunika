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
if ($page=='keranjang' AND $act=='update'){

	$id       = $_POST['id'];
	$id_keranjang       = $_POST['id_keranjang'];
	$jumlah   = $_POST['qty']; // quantity
	  $sql2 = mysql_query("SELECT stok AS stok FROM produk	WHERE id_produk = '".$id."'");
	  while($r=mysql_fetch_array($sql2)){
		  if ($jumlah > $r[stok]){
			  echo "<script>window.alert('Jumlah Yang Dibeli Melebihi Stok Yang Ada'); window.location=('../../menu.php?page=keranjang')</script>";
		  } else if ($jumlah == 0){
			  echo "<script>window.alert('Anda Tidak Boleh Menginputkan Angka 0 atau Mengkosongkannya!'); window.location=('../../menu.php?page=keranjang')</script>";
		  } else {
			  mysql_query("UPDATE keranjang SET jumlah = '".$jumlah."' WHERE id_keranjang = '".$id_keranjang."'");
			  header('location:../../menu.php?page=keranjang');
		  }
	  }
  
  
}

elseif ($page == 'keranjang' AND $act == 'hapus') {
  mysql_query("DELETE FROM keranjang WHERE id_keranjang = '$_GET[id]'");
  header('location:../../menu.php?page=keranjang');				
}

}

?>
