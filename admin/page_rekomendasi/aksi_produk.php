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
if ($page=='RekomendasiProduk' AND $act=='input'){

$id_produk    = $_GET['id'];
$id_rekomendasi    = $_GET['id_rekomendasi'];

  $Q=mysql_query("INSERT INTO rekomendasi (id_rekomendasi, id_produk) VALUES ('$id_rekomendasi', '$id_produk')");
  
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }

}  


// Update perangkatdesa
elseif ($page=='Produk' AND $act=='update'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 

$id_produk    = $_POST['id_produk'];
$id_kategori  = $_POST['id_kategori'];
$id_merek     = $_POST['id_merek'];
$produk       = $_POST['produk'];
$harga        = $_POST['harga'];
$berat        = $_POST['berat'];
$stok         = $_POST['stok'];
$deskripsi    = $_POST['deskripsi'];

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadProduk($nama_file_unik);
  $cek  = mysql_fetch_array(mysql_query("SELECT * FROM produk where id_produk='$id_produk'"));
  unlink("../upload/produk/$cek[gambar]");
  $Q=mysql_query("UPDATE produk SET produk='$produk', id_kategori='$id_kategori', id_merek='$id_merek', harga='$harga', berat='$berat', stok='$stok', deskripsi='$deskripsi', gambar='$nama_file_unik' WHERE id_produk='$id_produk'");
  
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
  $Q=mysql_query("UPDATE produk SET produk='$produk', id_kategori='$id_kategori', id_merek='$id_merek', harga='$harga', berat='$berat', stok='$stok', deskripsi='$deskripsi' WHERE id_produk='$id_produk'");
  if($Q) {
    header('location:../menu.php?page='.$page);
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../menu.php?page=$page';</script>";
  }
}
  

  
}

elseif ($page=='RekomendasiProduk' AND $act=='hapus'){
  
  $id = $_GET[id];

  $Q  = mysql_query("DELETE FROM rekomendasi WHERE id_produk='$id'");

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
