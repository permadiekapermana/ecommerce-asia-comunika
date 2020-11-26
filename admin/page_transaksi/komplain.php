<?php


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

$aksi="page_transaksi/aksi_pembelian.php";

switch($_GET[act]){
default:

echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
            <div class='card-body'>
            <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>Nomor Invoice</th>
                    <th>Jenis Komplain</th>
                    <th>Status</th>
                    <th>Bukti Komplain</th>
                    <th width='9%' align='center'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT * FROM komplain WHERE status = 'Menunggu Solusi' ORDER BY id_komplain ASC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[no_invoice]</td>
                    <td>$r[jenis_komplain]</td>
                    <td>$r[status]</td>   
                    <td width='105px'>";
                    $bukti=mysql_query("SELECT bukti_komplain FROM komplain WHERE no_invoice='$r[no_invoice]'");
                    $ketemu=mysql_num_rows($bukti);
                    $r2=mysql_fetch_array($bukti);
                    if($ketemu > 0){
                        echo"<a href='upload/bukti/$r[bukti_komplain]' target='_blank' class='btn btn-outline-success btn-sm'>Bukti Komplain</a>";
                    }elseif($r['metode_bayar']=='COD' AND $r['status_order']=='Selesai'){
                        echo"<font color='green'>Terverifikasi</font>";
                    }
                    else{
                        echo"<font color='red'>Belum Ada</font>";
                    }
                    echo"
                    </td>
                    <td width='9%' align='center'>
                    <a href='?page=Komplain&act=detail&id=$r[no_invoice]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i> Detail</a>
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

case "detail":
$tampil=mysql_query("SELECT
*
FROM
`komplain`
INNER JOIN `orders` ON `komplain`.`no_invoice` = `orders`.`no_invoice`
INNER JOIN `user` ON `komplain`.`u_pembeli` = `user`.`username` WHERE orders.no_invoice='$_GET[id]'");
$r=mysql_fetch_array($tampil);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Detail Komplain</strong>
        </div>
        <div class='card-body card-block'>        
        <div class='col-lg-12'>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Nomor Invoice</label></div>
            <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>$r[no_invoice]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Jenis Komplain</label></div>
                <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>$r[jenis_komplain]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Keterangan Komplain</label></div>
                <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>$r[keterangan]</label></div>
            </div>
            <form action='$aksi?page=Pembelian&act=komplain' method='POST' enctype='multipart/form-data' class='form-horizontal'>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='status_order' class='form-control-label'>Solusi Toko</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Solusi --' name='solusi' class='standardSelect' tabindex='1' required>
                    <option value=''></option>
                    <option value='Follow up pihak ekspedisi'>Follow up pihak ekspedisi</option>
                    <option value='Pesanan yang kurang dikirim kembali'>Pesanan yang kurang dikirim kembali</option>
                    <option value='Tukar Barang'>Tukar Barang</option>
                    <option value='Refund'>Refund</option>
                </select>
                </div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='keterangan2' class='form-control-label'>Keterangan</label></div>
                <div class='col-9 col-md-6'><input type='text' name='keterangan2' id='keterangan2'  placeholder='Masukkan Keterangan Solusi' class='form-control'>
                <input type='hidden' name='no_invoice' id='no_invoice'  value='$r[no_invoice]' class='form-control'></div>
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

}

?>