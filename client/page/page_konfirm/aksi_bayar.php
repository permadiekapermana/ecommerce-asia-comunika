<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$no_invoice    = $_POST['no_invoice'];
$tgl_bayar     = $_POST['tgl_bayar'];
$id_bank       = $_POST['id_bank'];
$bank_asal     = $_POST['bank_asal'];
$nama_pemilik  = $_POST['nama_pemilik'];
$jumlah        = $_POST['jumlah'];


$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 

$id_bank        = $_POST['id_bank'];
$bank           = $_POST['bank'];
$no_rek         = $_POST['no_rek'];
$pemilik        = $_POST['pemilik'];

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadBukti($nama_file_unik);
  $Q=mysql_query("INSERT INTO konfirm_bayar (no_invoice, tgl_bayar, id_bank, bank_asal, nama_pemilik, jumlah, bukti_transfer) VALUES ('$no_invoice', '$tgl_bayar', '$id_bank', '$bank_asal', '$nama_pemilik', '$jumlah', '$nama_file_unik')");
  mysql_query("UPDATE orders SET status_order = 'Sedang Diproses', tgl_bayar = '$tgl_bayar' WHERE no_invoice='$no_invoice'");
  
  if($Q) {
    header('location:../../menu.php?page=thanks');
  }
  else{
    echo "<script>alert('Gagal menyimpan data!')</script>";
    echo "<script>window.location = '../../menu.php?page=konfirm_bayar';</script>";
  }

}
}

?>