<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$no_invoice     = $_POST['no_invoice'];
$id_komplain    = $_POST['id_komplain'];
$jenis_komplain = $_POST['jenis_komplain'];
$keterangan     = $_POST['keterangan'];
$u_pembeli      = $_POST['u_pembeli'];
$status         = 'Menunggu Solusi';


$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file;

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadBukti($nama_file_unik);
  $Q=mysql_query("INSERT INTO komplain (id_komplain, no_invoice, jenis_komplain, keterangan, bukti_komplain, u_pembeli, status) VALUES ('$id_komplain', '$no_invoice', '$jenis_komplain', '$keterangan', '$nama_file_unik', '$u_pembeli', '$status')");
  
  if($Q) {
    header('location:../../menu.php?page=wait');
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../../menu.php?page=dashboard';</script>";
  }

}
}

?>