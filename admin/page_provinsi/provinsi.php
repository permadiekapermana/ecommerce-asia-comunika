<?php
include "../config/koneksi.php";

$pel="PROV.";
$y=substr($pel,0,4);
$query=mysql_query("select * from provinsi where substr(id_provinsi,1,4)='$y' order by id_provinsi desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_provinsi'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_provinsi/aksi_provinsi.php";
switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
        <a href='?page=DataProvinsi&act=tambahprovinsi'><button type='button' class='btn btn-primary'>Tambah</button></a>
        </div>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>ID Provinsi</th>
                    <th>Nama Provinsi</th>
                    <th width='10%'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT * FROM `provinsi` ORDER BY id_provinsi DESC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[id_provinsi]</td>
                    <td>$r[provinsi]</td>
                    <td width='10%' align='center'>
                    <a href='?page=DataProvinsi&act=editprovinsi&id=$r[id_provinsi]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i></a>
                    <a href='$aksi?page=DataProvinsi&act=hapus&id=$r[id_provinsi]' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i></a>
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

case "tambahprovinsi":
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Tambah Data Provinsi</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataProvinsi&act=input' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_provinsi' class='form-control-label'>ID Provinsi</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$nopel' id='id_provinsi' class='form-control' disabled>
            <input type='hidden' name='id_provinsi' value='$nopel' id='id_provinsi' class='form-control'>
            <small class='form-text text-muted'>ID Provinsi dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='provinsi' class='form-control-label'>Nama Provinsi</label></div>
                <div class='col-9 col-md-6'><input type='text' name='provinsi' id='provinsi'  placeholder='Masukkan Nama Provinsi' class='form-control' required></div>
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

case "editprovinsi":
$edit = mysql_query("SELECT * FROM provinsi WHERE id_provinsi='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Ubah Data Provinsi</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataProvinsi&act=update' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_provinsi' class='form-control-label'>ID Provinsi</label></div>
            <div class='col-9 col-md-6'><input type='text' id='id_provinsi' value='$r[id_provinsi]'   class='form-control' disabled><small class='form-text text-muted'>ID Provinsi tidak dapat diubah!</small></div>
            <input type='hidden' name='id_provinsi' id='id_provinsi' value='$r[id_provinsi]'  class='form-control' >
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='provinsi' class='form-control-label'>Nama Provinsi</label></div>
                <div class='col-9 col-md-6'><input type='text' name='provinsi' id='provinsi'  value='$r[provinsi]' class='form-control' ></div>
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