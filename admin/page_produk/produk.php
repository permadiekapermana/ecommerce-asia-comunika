<?php
include "../config/koneksi.php";

$pel="PROD.";
$y=substr($pel,0,4);
$query=mysql_query("select * from produk where substr(id_produk,1,4)='$y' order by id_produk desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_produk'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$pel3="BKMN.";
$y3=substr($pel3,0,4);
$query3=mysql_query("select * from komentar_balas where substr(id_balas,1,4)='$y3' order by id_balas desc limit 0,1");
$row3=mysql_num_rows($query3);
$data3=mysql_fetch_array($query3);
if ($row3>0){
$no3=substr($data3['id_balas'],-6)+1;}
else{
$no3=1;
}
$nourut3=1000000+$no3;
$nopel3=$pel3.substr($nourut3,-6);

$aksi="page_produk/aksi_produk.php";
switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
        <a href='?page=Produk&act=tambahproduk'><button type='button' class='btn btn-primary'>Tambah</button></a>
        </div>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th width='105px'>Gambar</th>
                    <th width='13%' align='center'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT
                `produk`.`id_produk`,
                `produk`.`produk`,
                `kategori`.`kategori`,
                `merek`.`merek`,
                `produk`.`harga`,
                `produk`.`berat`,
                `produk`.`stok`,
                `produk`.`gambar`
              FROM
                `produk`
                INNER JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id_kategori`
                INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` ORDER BY id_produk DESC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[id_produk]</td>
                    <td>$r[produk]</td>
                    <td>$r[kategori]</td>
                    <td>$r[merek]</td>
                    <td>Rp. " .number_format($r[harga],0,".", ".");"</td>";echo"
                    <td>$r[stok]</td>
                    <td width='105px'><img src='upload/produk/$r[gambar]' border='3' height='150' width='100'></td>
                    <td width='13%' align='center'>
                    <a href='?page=Produk&act=infoproduk&id=$r[id_produk]' class='btn btn-outline-success btn-sm'><i class='fa fa-info-circle'></i></a>
                    <a href='?page=Produk&act=editproduk&id=$r[id_produk]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i></a>
                    <a href='$aksi?page=Produk&act=hapus&id=$r[id_produk]' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i></a>
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

case "tambahproduk":
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Tambah Data Produk</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=Produk&act=input' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_produk' class='form-control-label'>ID Produk</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$nopel' id='id_produk' class='form-control' disabled>
            <input type='hidden' name='id_produk' value='$nopel' id='id_produk' class='form-control'>
            <small class='form-text text-muted'>ID Produk dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='produk' class='form-control-label'>Nama Produk</label></div>
                <div class='col-9 col-md-6'><input type='text' name='produk' id='produk'  placeholder='Masukkan Nama Produk' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_kategori' class='form-control-label'>Kategori</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Kategori --' name='id_kategori' class='standardSelect' tabindex='1' required>
                    <option value=''></option>";
                    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
                    while($r=mysql_fetch_array($tampil)){
                    echo "<option value=$r[id_kategori]>$r[kategori]</option>";
                    }
                    echo "
                </select>
                </div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_merek' class='form-control-label'>Merek</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Merek --' name='id_merek' class='standardSelect' tabindex='1' required>
                    <option value=''></option>";
                    $tampil=mysql_query("SELECT * FROM merek ORDER BY id_merek DESC");
                    while($r=mysql_fetch_array($tampil)){
                    echo "<option value=$r[id_merek]>$r[merek]</option>";
                    }
                    echo "
                </select>
                </div>
            </div>            
            <div class='row form-group'>
                <div class='col col-md-3'><label for='harga' class='form-control-label'>Harga (Rp.)</label></div>
                <div class='col-9 col-md-6'><input type='number' name='harga' id='harga'  placeholder='Masukkan Harga Produk' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='berat' class='form-control-label'>Berat (Gram)</label></div>
                <div class='col-9 col-md-6'><input type='number' name='berat' id='berat'  placeholder='Masukkan Berat Produk' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='deskripsi' class='form-control-label'>Deskripsi Produk</label></div>
                <div class='col-9 col-md-6'><textarea rows='5' name='deskripsi' id='deskripsi'  placeholder='Masukkan Deskripsi Produk' class='form-control' required></textarea></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='stok' class='form-control-label'>Stok</label></div>
                <div class='col-9 col-md-6'><input type='number' name='stok' id='stok'  placeholder='Masukkan Stok Produk' class='form-control' required></div>
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

case "editproduk":
$edit = mysql_query("SELECT
`produk`.`id_produk`,
`produk`.`produk`,
`kategori`.`kategori`,
`merek`.`merek`,
`produk`.`harga`,
`produk`.`deskripsi`,
`produk`.`stok`,
`produk`.`berat`,
`produk`.`gambar`
FROM
`produk`
INNER JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id_kategori`
INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` WHERE id_produk='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Ubah Data Produk</strong>
        </div>
        <div class='card-body card-block'>
        <form action='$aksi?page=Produk&act=update' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_produk' class='form-control-label'>ID Produk</label></div>
            <div class='col-9 col-md-6'><input type='text' value='$r[id_produk]' id='id_produk' class='form-control' disabled>
            <input type='hidden' name='id_produk' value='$r[id_produk]' id='id_produk' class='form-control'>
            <small class='form-text text-muted'>ID Produk dibuat otomatis oleh sistem</small></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='produk' class='form-control-label'>Nama Produk</label></div>
                <div class='col-9 col-md-6'><input type='text' value='$r[produk]' name='produk' id='produk'  placeholder='Masukkan Nama Produk' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_kategori' class='form-control-label'>Kategori</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Kategori --' name='id_kategori' class='standardSelect' tabindex='1' required>
                ";          
                $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
                if ($r[id_provinsi]==0){
                echo "<option value='' selected>-- Pilih Kategori --</option>";
                }   
                while($w=mysql_fetch_array($tampil)){
                if ($r[id_provinsi]==$w[id_provinsi]){
                echo "<option value=$w[id_kategori] selected>$w[kategori]</option>";
                }
                else{
                echo "<option value=$w[id_kategori]>$w[kategori]</option>";
                }
                }
                echo "
                </select>
                </div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_merek' class='form-control-label'>Merek</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Merek --' name='id_merek' class='standardSelect' tabindex='1' required>
                ";          
                $tampil=mysql_query("SELECT * FROM merek ORDER BY id_merek DESC");
                if ($r[id_provinsi]==0){
                echo "<option value='' selected>-- Pilih Merek --</option>";
                }   
                while($w=mysql_fetch_array($tampil)){
                if ($r[id_provinsi]==$w[id_provinsi]){
                echo "<option value=$w[id_merek] selected>$w[merek]</option>";
                }
                else{
                echo "<option value=$w[id_merek]>$w[merek]</option>";
                }
                }
                echo "
                </select>
                </div>
            </div>            
            <div class='row form-group'>
                <div class='col col-md-3'><label for='harga' class='form-control-label'>Harga (Rp.)</label></div>
                <div class='col-9 col-md-6'><input type='number' value='$r[harga]' name='harga' id='harga'  placeholder='Masukkan Harga Produk' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='berat' class='form-control-label'>Berat (Gram)</label></div>
                <div class='col-9 col-md-6'><input type='number' value='$r[berat]' name='berat' id='berat'  placeholder='Masukkan Berat Produk' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='stok' class='form-control-label'>Stok</label></div>
                <div class='col-9 col-md-6'><input type='number' value='$r[stok]' name='stok' id='stok'  placeholder='Masukkan Stok Produk' class='form-control' required></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='deskripsi' class='form-control-label'>Deskripsi Produk</label></div>
                <div class='col-9 col-md-6'><textarea rows='5' name='deskripsi' id='deskripsi'  placeholder='Masukkan Deskripsi Produk' class='form-control' required>$r[deskripsi]</textarea></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='gambar' class='form-control-label'>Gambar Produk</label></div>
                <div class='col-9 col-md-6'><img src='upload/produk/$r[gambar]' border='3' height='250' width='200'></img></div>
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

case "infoproduk":
$edit = mysql_query("SELECT
`produk`.`id_produk`,
`produk`.`produk`,
`kategori`.`kategori`,
`merek`.`merek`,
`produk`.`harga`,
`produk`.`deskripsi`,
`produk`.`stok`,
`produk`.`berat`,
`produk`.`gambar`
FROM
`produk`
INNER JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id_kategori`
INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` WHERE id_produk='$_GET[id]'");
$r    = mysql_fetch_array($edit);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Info Data Produk</strong>
        </div>
        <div class='card-body card-block'>
        <form action='#' method='POST' enctype='multipart/form-data' class='form-horizontal'>
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_produk' class='form-control-label'>ID Produk</label></div>
            <div class='col-9 col-md-6'><label for='produk' class='form-control-label'>:&nbsp;$r[id_produk]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='produk' class='form-control-label'>Nama Produk</label></div>
                <div class='col-9 col-md-6'><label for='produk' class='form-control-label'>:&nbsp;$r[produk]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_kategori' class='form-control-label'>Kategori</label></div>
                <div class='col-9 col-md-6'><label for='produk' class='form-control-label'>:&nbsp;$r[kategori]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_merek' class='form-control-label'>Merek</label></div>
                <div class='col-9 col-md-6'><label for='produk' class='form-control-label'>:&nbsp;$r[merek]</label></div>
            </div>            
            <div class='row form-group'>
                <div class='col col-md-3'><label for='harga' class='form-control-label'>Harga (Rp.)</label></div>
                <div class='col-9 col-md-6'><label for='produk' class='form-control-label'>:&nbsp;Rp. " .number_format($r[harga],0,".", ".");"";echo"</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='berat' class='form-control-label'>Berat (Gram)</label></div>
                <div class='col-9 col-md-6'><label for='produk' class='form-control-label'>:&nbsp;$r[berat]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='stok' class='form-control-label'>Stok</label></div>
                <div class='col-9 col-md-6'><label for='produk' class='form-control-label'>:&nbsp;$r[stok]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='deskripsi' class='form-control-label'>Deskripsi Produk</label></div>
                <div class='col-9 col-md-6'><textarea rows='5' name='deskripsi' id='deskripsi'  placeholder='Masukkan Deskripsi Produk' class='form-control' required>$r[deskripsi]</textarea></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='gambar' class='form-control-label'>Gambar Produk</label></div>
                <div class='col-9 col-md-6'><img src='upload/produk/$r[gambar]' border='3' height='250' width='200'></img></div>
            </div>   
            
            <div class='form-group'>
            <div class='col col-md-3'></div>
            <div class='col-9 col-md-6'>
                <button class='btn btn-danger btn-sm' type='button' onclick=self.history.back()>Back</button>
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