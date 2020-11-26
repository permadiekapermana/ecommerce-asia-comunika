<?php
include "../../../config/koneksi.php";
error_reporting(0);
	$id   = $_POST['id'];
	$Q    = mysql_query("SELECT * FROM provinsi WHERE id_provinsi='".$id."'");
    $data = mysql_fetch_array($Q);
			
			echo "
			<div class='form-group'>
				<h5>Kota</h5>
				<select name='id_kota' class='form-control' id='pilih-kota' required>
				  ";
				  $tampil=mysql_query("SELECT * FROM `kota` WHERE id_provinsi='$data[id_provinsi]'");
				  while($r=mysql_fetch_array($tampil)){
				  echo "
				  <option value='$r[id_kota]'>$r[kota]</option>";
                	}
        		echo"</select>
			</div>";	

?>