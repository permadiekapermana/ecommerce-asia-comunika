<?php
include "../../../config/koneksi.php";

$username       = $_POST['username'];
$pass           = md5($_POST['password']);
$pass2          = md5($_POST['password2']);
$nama_lengkap   = $_POST['nama_lengkap'];
$email          = $_POST['email'];
$no_hp          = $_POST['no_hp'];
$id_kota        = $_POST['id_kota'];
$alamat         = $_POST['alamat'];
$blokir         = 'N';
// pastikan username dan password adalah berupa huruf atau angka.

$login=mysql_query("SELECT username FROM `user` WHERE username = '$username'");
$ketemu=mysql_num_rows($login);

if ($_POST['password']==$_POST['password2'] ) {
  //proses simpan data, $_POST['pw'] dan $_POST['pw1'] adalah name dari masing masing text password 
  


if ($ketemu > 0){

  echo"<script>alert('Username yang anda pakai telah digunakan !');history.go(-1);</script>";
}
else{

  $query = mysql_query("INSERT INTO user (username, password, nama_lengkap, email, no_hp,  id_kota, alamat, blokir) 
  VALUES ('$username','$pass','$nama_lengkap','$email','$no_hp', '$id_kota', '$alamat', '$blokir')");    
  echo"<script>alert('Anda berhasil terdaftar di Sistem!');history.go(-1);</script>";
    
}

}else {
  echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
  }

?>