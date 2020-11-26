<?php
include "../config/koneksi.php";

$pel="MERK.";
$y=substr($pel,0,4);
$query=mysql_query("select * from merek where substr(id_merek,1,4)='$y' order by id_merek desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_merek'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_merek/aksi_merek.php";
switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
        <a href='?page=Merek&act=tambahmerek'><button type='button' class='btn btn-primary'>Tambah</button></a>
        </div>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>ID Merek</th>
                    <th>Nama Merek</th>
                    <th width='10%'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT * FROM `merek` ORDER BY id_merek DESC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[id_merek]</td>
                    <td>$r[merek]</td>
                    <td width='10%' align='center'>
                    <a href='?page=Merek&act=editmerek&id=$r[id_merek]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i></a>
                    <a href='$aksi?page=Merek&act=hapus&id=$r[id_merek]' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i></a>
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

case "tambahmerek":
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Tambah Data Merek</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=Merek&act=input' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_merek' class='form-control-label'>ID Merek</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$nopel' id='id_merek' class='form-control' disabled>
            <input type='hidden' name='id_merek' value='$nopel' id='id_merek' class='form-control'>
            <small class='form-text text-muted'>ID Merek dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='merek' class='form-control-label'>Nama Merek</label></div>
                <div class='col-9 col-md-6'><input type='text' name='merek' id='merek'  placeholder='Masukkan Nama Merek' class='form-control' required></div>
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

case "editmerek":
$edit = mysql_query("SELECT * FROM merek WHERE id_merek='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Ubah Data Merek</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=Merek&act=update' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_merek' class='form-control-label'>ID Merek</label></div>
            <div class='col-9 col-md-6'><input type='text' id='id_merek' value='$r[id_merek]'   class='form-control' disabled><small class='form-text text-muted'>ID Merek tidak dapat diubah!</small></div>
            <input type='hidden' name='id_merek' id='id_merek' value='$r[id_merek]'  class='form-control' >
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='merek' class='form-control-label'>Nama Merek</label></div>
                <div class='col-9 col-md-6'><input type='text' name='merek' id='merek'  value='$r[merek]' class='form-control' ></div>
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