<?php
include "../config/koneksi.php";

$pel="BANK.";
$y=substr($pel,0,4);
$query=mysql_query("select * from bank where substr(id_bank,1,4)='$y' order by id_bank desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_bank'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page_bank/aksi_bank.php";
switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
        <a href='?page=DataBank&act=tambahbank'><button type='button' class='btn btn-primary'>Tambah</button></a>
        </div>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>ID Bank</th>
                    <th>Nama Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Pemilik</th>
                    <th width='105px'>Gambar</th>
                    <th width='9%' align='center'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT * FROM bank ORDER BY id_bank DESC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[id_bank]</td>
                    <td>$r[bank]</td>
                    <td>$r[no_rek]</td>
                    <td>$r[pemilik]</td>
                    <td width='105px'><img src='upload/bank/$r[gambar]' border='3' height='100' width='100'></td>
                    <td width='9%' align='center'>                    
                    <a href='?page=DataBank&act=editbank&id=$r[id_bank]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i></a>
                    <a href='$aksi?page=DataBank&act=hapus&id=$r[id_bank]' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i></a>
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

case "tambahbank":
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Tambah Data Bank</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataBank&act=input' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_bank' class='form-control-label'>ID Bank</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$nopel' id='id_bank' class='form-control' disabled>
            <input type='hidden' name='id_bank' value='$nopel' id='id_bank' class='form-control'>
            <small class='form-text text-muted'>ID Bank dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='bank' class='form-control-label'>Nama Bank</label></div>
                <div class='col-9 col-md-6'><input type='text' name='bank' id='bank'  placeholder='Masukkan Nama Bank' class='form-control' required></div>
            </div>        
            <div class='row form-group'>
                <div class='col col-md-3'><label for='no_rek' class='form-control-label'>Nomor Rekening</label></div>
                <div class='col-9 col-md-6'><input type='number' name='no_rek' id='no_rek'  placeholder='Masukkan Nomor Rekening' class='form-control' required></div>
            </div>            
            <div class='row form-group'>
                <div class='col col-md-3'><label for='pemilik' class='form-control-label'>Nama Pemilik Rekening</label></div>
                <div class='col-9 col-md-6'><input type='text' name='pemilik' id='pemilik'  placeholder='Masukkan Nama Pemilik Rekening' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='fupload' class='form-control-label'>Gambar Produk</label></div>
                <div class='col-9 col-md-6'><input type='file' name='fupload' id='fupload' class='form-control'>
                <small class='form-text text-muted'>File gambar harus berekstensi .JPG / .PNG agar dapat diupload.</small></div>
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

case "editbank":
$edit = mysql_query("SELECT * FROM bank WHERE id_bank='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Ubah Data Bank</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataBank&act=update' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_bank' class='form-control-label'>ID Bank</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$r[id_bank]' id='id_bank' class='form-control' disabled>
            <input type='hidden' name='id_bank' value='$r[id_bank]' id='id_bank' class='form-control'>
            <small class='form-text text-muted'>ID Bank dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='bank' class='form-control-label'>Nama Bank</label></div>
                <div class='col-9 col-md-6'><input type='text' value='$r[bank]' name='bank' id='bank'  placeholder='Masukkan Nama Bank' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='no_rek' class='form-control-label'>Nomor Rekening</label></div>
                <div class='col-9 col-md-6'><input type='number' name='no_rek' value='$r[no_rek]' id='no_rek'  placeholder='Masukkan Nomor Rekening' class='form-control' required></div>
            </div>            
            <div class='row form-group'>
                <div class='col col-md-3'><label for='pemilik' class='form-control-label'>Nama Pemilik Rekening</label></div>
                <div class='col-9 col-md-6'><input type='text' name='pemilik' value='$r[pemilik]' id='pemilik'  placeholder='Masukkan Nama Pemilik Rekening' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='gambar' class='form-control-label'>Gambar Bank</label></div>
                <div class='col-9 col-md-6'><img src='upload/bank/$r[gambar]' border='3' height='100' width='100'></img></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='fupload' class='form-control-label'>Gambar Produk</label></div>
                <div class='col-9 col-md-6'><input type='file' name='fupload' id='fupload' class='form-control'>
                <small class='form-text text-muted'>File gambar harus berekstensi .JPG / .PNG agar dapat diupload.</small></div>
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