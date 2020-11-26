<?php
include "../config/koneksi.php";

$aksi="page_admin/aksi_admin.php";
switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
        <a href='?page=DataAdmin&act=tambahadmin'><button type='button' class='btn btn-primary'>Tambah</button></a>
        </div>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>E-mail</th>
                    <th>Nomor Telepon</th>
                    <th>Status</th>
                    <th>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT * FROM `admin`");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[username]</td>
                    <td>$r[nama_lengkap]</td>
                    <td>$r[email]</td>
                    <td>$r[no_telp]</td>
                    <td>";
                    if ($r[blokir]=='Y')   {                         
                    echo"                 
                      Diblokir";
                    }
                    elseif ($r[blokir]=='N')    {
                    echo"
                      Aktif";        
                    }
                    echo"</td>
                    <td width='5%' align='center'>
                    <a href='?page=DataAdmin&act=editadmin&id=$r[username]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i></a>
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

case "tambahadmin":
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Tambah Data Admin</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataAdmin&act=input' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>Username</label></div>
            <div class='col-9 col-md-6'><input type='text' name='username' id='username'  placeholder='Masukkan Username' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='password' class='form-control-label'>Password</label></div>
                <div class='col-9 col-md-6'><input type='password' name='password' id='password'  placeholder='Masukkan Password' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='nama_lengkap' class='form-control-label'>Nama Lengkap</label></div>
                <div class='col-9 col-md-6'><input type='text' name='nama_lengkap' id='nama_lengkap'  placeholder='Masukkan Nama Lengkap' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='email' class='form-control-label'>Email</label></div>
                <div class='col-9 col-md-6'><input type='email' name='email' id='email'  placeholder='Masukkan Email' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='no_telp' class='form-control-label'>Nomor Telepon</label></div>
                <div class='col-9 col-md-6'><input type='number' name='no_telp' id='no_telp'  placeholder='Masukkan Nomor Telepon' class='form-control' required></div>
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

case "editadmin":
$edit = mysql_query("SELECT * FROM admin WHERE username='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Ubah Data Admin</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=DataAdmin&act=update' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='username' class='form-control-label'>Username</label></div>
            <div class='col-9 col-md-6'><input type='text' name='username' id='username' value='$r[username]'  placeholder='Masukkan Username' class='form-control' disabled><small class='form-text text-muted'>Username tidak dapat diubah!</small></div>
            <input type='hidden' name='username' id='username' value='$r[username]'  placeholder='Masukkan Username' class='form-control' >
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='password' class='form-control-label'>Password</label></div>
                <div class='col-9 col-md-6'><input type='password' name='password' id='password'  placeholder='' class='form-control' ><small class='form-text text-muted'>Kosongkan kolom password jika tidak ingin dirubah</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='nama_lengkap' class='form-control-label'>Nama Lengkap</label></div>
                <div class='col-9 col-md-6'><input type='text' name='nama_lengkap' id='nama_lengkap' value='$r[nama_lengkap]' placeholder='Masukkan Nama Lengkap' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='email' class='form-control-label'>Email</label></div>
                <div class='col-9 col-md-6'><input type='email' name='email' value='$r[email]' id='email'  placeholder='Masukkan Email' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='no_telp' class='form-control-label'>Nomor Telepon</label></div>
                <div class='col-9 col-md-6'><input type='number' name='no_telp' value='$r[no_telp]' id='no_telp'  placeholder='Masukkan Nomor Telepon' class='form-control' required></div>
            </div>
            <div class='form-group'>
            <label for='blokir'>Blokir User ? &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>";
              if ($r[blokir]=='Y')   {                         
              echo"              
                <input type='radio' class='flat' name='blokir' id='level' value='N'  required /> Tidak
                <input type='radio' class='flat' name='blokir' id='level' value='Y' checked='' /> Blokir";
              }
              elseif ($r[blokir]=='N')    {
              echo"
                <input type='radio' class='flat' name='blokir' id='level' value='N' checked='' required /> Tidak
                <input type='radio' class='flat' name='blokir' id='level' value='Y'  /> Blokir";        
              }
              echo"
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