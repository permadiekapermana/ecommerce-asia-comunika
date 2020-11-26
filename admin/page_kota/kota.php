<?php
include "../config/koneksi.php";

$pel="KOTA.";
$y=substr($pel,0,4);
$query=mysql_query("select * from kota where substr(id_kota,1,4)='$y' order by id_kota desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_kota'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_kota/aksi_kota.php";
switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
        <a href='?page=DataKota&act=tambahkota'><button type='button' class='btn btn-primary'>Tambah</button></a>
        </div>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>ID Kota</th>
                    <th>Nama Provinsi</th>
                    <th>Nama Kota</th>
                    <th>Ongkos Kirim</th>
                    <th width='10%'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT
                `kota`.`id_kota`,
                `provinsi`.`provinsi`,
                `kota`.`kota`,
                `kota`.`ongkir`
              FROM
                `kota`
                INNER JOIN `provinsi` ON `kota`.`id_provinsi` = `provinsi`.`id_provinsi` ORDER BY id_kota DESC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[id_kota]</td>
                    <td>$r[provinsi]</td>
                    <td>$r[kota]</td>
                    <td>Rp. " .number_format($r[ongkir],0,".", ".");"</td>";echo"
                    <td width='10%' align='center'>
                    <a href='?page=DataKota&act=editkota&id=$r[id_kota]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i></a>
                    <a href='$aksi?page=DataKota&act=hapus&id=$r[id_kota]' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i></a>
                    </td>";                    
                    $no++;
                    }
                    echo"
                </tr>                                        
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>";

break;

case "tambahkota":
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Tambah Data Kota</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataKota&act=input' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_kota' class='form-control-label'>ID Kota</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$nopel' id='id_kota' class='form-control' disabled>
            <input type='hidden' name='id_kota' value='$nopel' id='id_kota' class='form-control'>
            <small class='form-text text-muted'>ID Kota dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_provinsi' class='form-control-label'>Nama Provinsi</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Provinsi --' name='id_provinsi' class='standardSelect' tabindex='1' required>
                    <option value=''></option>";
                    $tampil=mysql_query("SELECT * FROM provinsi ORDER BY id_provinsi DESC");
                    while($r=mysql_fetch_array($tampil)){
                    echo "<option value=$r[id_provinsi]>$r[provinsi]</option>";
                    }
                    echo "
                </select>
                </div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='kota' class='form-control-label'>Nama Kota</label></div>
                <div class='col-9 col-md-6'><input type='text' name='kota' id='kota'  placeholder='Masukkan Nama Kota' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='ongkir' class='form-control-label'>Ongkos Kirim (Rp.)</label></div>
                <div class='col-9 col-md-6'><input type='number' name='ongkir' id='ongkir'  placeholder='Masukkan Ongkos Kirim' class='form-control' required></div>
            </div>      
            
            <div class='form-group'>
            <div class='col col-md-3'></div>
            <div class='col-9 col-md-6'>
                <button class='btn btn-danger btn-sm' type='button' onclick=self.history.back()>Cancel</button>
                <button class='btn btn-warning btn-sm' type='reset'>Reset</button>
                <button type='submit' class='btn btn-primary btn-sm'>Submit</button>  
            </div>      
            </div> 
        </form>                  
        </div>
        </div>          
        </div>
    </div>
</div>
";

break;

case "editkota":
$edit = mysql_query("SELECT * FROM kota WHERE id_kota='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Ubah Data Kota</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataKota&act=update' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_kota' class='form-control-label'>ID Provinsi</label></div>
            <div class='col-9 col-md-6'><input type='text' id='id_kota' value='$r[id_kota]'   class='form-control' disabled><small class='form-text text-muted'>ID Kota tidak dapat diubah!</small></div>
            <input type='hidden' name='id_kota' id='id_kota' value='$r[id_kota]'  class='form-control' >
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_provinsi' class='form-control-label'>Nama Provinsi</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Provinsi --' name='id_provinsi' class='standardSelect' tabindex='1' required>
                    ";          
                    $tampil=mysql_query("SELECT * FROM provinsi ORDER BY id_provinsi DESC");
                    if ($r[id_provinsi]==0){
                    echo "<option value='' selected>-- Pilih Provinsi --</option>";
                    }   
                    while($w=mysql_fetch_array($tampil)){
                    if ($r[id_provinsi]==$w[id_provinsi]){
                    echo "<option value=$w[id_provinsi] selected>$w[provinsi]</option>";
                    }
                    else{
                    echo "<option value=$w[id_provinsi]>$w[provinsi]</option>";
                    }
                    }
                    echo "
                </select>
                </div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='kota' class='form-control-label'>Nama Kota</label></div>
                <div class='col-9 col-md-6'><input type='text' name='kota' id='kota'  value='$r[kota]' class='form-control' placeholder='Masukkan Nama Kota'></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='ongkir' class='form-control-label'>Ongkos Kirim (Rp.)</label></div>
                <div class='col-9 col-md-6'><input type='number' name='ongkir' id='ongkir'  value='$r[ongkir]' class='form-control' placeholder='Masukkan Ongkos Kirim'></div>
            </div>         
            
            <div class='form-group'>
            <div class='col col-md-3'></div>
            <div class='col-9 col-md-6'>
                <button class='btn btn-danger btn-sm' type='button' onclick=self.history.back()>Cancel</button>
                <button class='btn btn-warning btn-sm' type='reset'>Reset</button>
                <button type='submit' class='btn btn-primary btn-sm'>Submit</button>  
            </div>      
            </div> 
        </form>                  
        </div>
        </div>          
        </div>
    </div>
</div>
";

}

?>