<?php
include "../config/koneksi.php";

$pel="KTGR.";
$y=substr($pel,0,4);
$query=mysql_query("select * from kategori where substr(id_kategori,1,4)='$y' order by id_kategori desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_kategori'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_kategori/aksi_kategori.php";
switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
        <a href='?page=Kategori&act=tambahkategori'><button type='button' class='btn btn-primary'>Tambah</button></a>
        </div>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>ID Kategori</th>
                    <th>Nama Kategori</th>
                    <th width='10%'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT * FROM `kategori` ORDER BY id_kategori DESC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[id_kategori]</td>
                    <td>$r[kategori]</td>
                    <td width='10%' align='center'>
                    <a href='?page=Kategori&act=editkategori&id=$r[id_kategori]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i></a>
                    <a href='$aksi?page=Kategori&act=hapus&id=$r[id_kategori]' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i></a>
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

case "tambahkategori":
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Tambah Data Kategori</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=Kategori&act=input' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_kategori' class='form-control-label'>ID Kategori</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$nopel' id='id_kategori' class='form-control' disabled>
            <input type='hidden' name='id_kategori' value='$nopel' id='id_kategori' class='form-control'>
            <small class='form-text text-muted'>ID Kategori dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='kategori' class='form-control-label'>Nama Kategori</label></div>
                <div class='col-9 col-md-6'><input type='text' name='kategori' id='kategori'  placeholder='Masukkan Nama Kategori' class='form-control' required></div>
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

case "editkategori":
$edit = mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Ubah Data Kategori</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=Kategori&act=update' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_kategori' class='form-control-label'>ID Kategori</label></div>
            <div class='col-9 col-md-6'><input type='text' id='id_kategori' value='$r[id_kategori]'   class='form-control' disabled><small class='form-text text-muted'>ID Kategori tidak dapat diubah!</small></div>
            <input type='hidden' name='id_kategori' id='id_kategori' value='$r[id_kategori]'  class='form-control' >
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='kategori' class='form-control-label'>Nama Kategori</label></div>
                <div class='col-9 col-md-6'><input type='text' name='kategori' id='kategori'  value='$r[kategori]' class='form-control' ></div>
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