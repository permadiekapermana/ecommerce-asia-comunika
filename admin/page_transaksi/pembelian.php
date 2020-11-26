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
                    <th>Status Order</th>
                    <th>Tgl Order</th>
                    <th>Tgl Bayar</th>
                    <th>Metode Bayar</th>
                    <th>Bukti Bayar</th>
                    <th width='9%' align='center'>Pilihan</th>
                </tr>
            </thead>
            <tbody>";
                $tampil = mysql_query("SELECT * FROM orders WHERE status_order = 'Menunggu Pembayaran' OR status_order = 'Sedang Diproses' OR status_order = 'Sedang Dikirim' ORDER BY no_invoice ASC");
            
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r[no_invoice]</td>
                    <td>$r[status_order]</td>
                    <td>$r[tgl_order]</td>                    
                    <td>";
                    if($r['tgl_bayar']==''){
                        echo"<font color='Red'>Belum Bayar</font>";
                    }
                    else{
                        echo"$r[tgl_bayar]";
                    }
                    echo"
                    </td>
                    <td>$r[metode_bayar]</td>
                    <td width='105px'>";
                    $bukti=mysql_query("SELECT bukti_transfer FROM konfirm_bayar WHERE no_invoice='$r[no_invoice]'");
                    $ketemu=mysql_num_rows($bukti);
                    $r2=mysql_fetch_array($bukti);
                    if($ketemu > 0){
                        echo"<a href='upload/bukti/$r2[bukti_transfer]' target='_blank' class='btn btn-outline-success btn-sm'>Bukti Bayar</a>";
                    }else{
                        echo"<font color='red'>Belum Ada</font>";
                    }
                    echo"
                    </td>
                    <td width='9%' align='center'>";
                    $bukti=mysql_query("SELECT bukti_transfer FROM konfirm_bayar WHERE no_invoice='$r[no_invoice]'");
                    $r2=mysql_fetch_array($bukti);
                    if($r['metode_bayar']=='Transfer' AND $r['tgl_bayar']==''){
                        echo"<a href='$aksi?page=Pembelian&act=tolak&id=$r[no_invoice]' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Yakin ingin tolak pembelian ? Data yang ditolak tidak dapat dipulihkan !')\"><i class='fa fa-close'></i> Tolak</a>";
                    }
                    elseif($r['status_order']=='Sedang Dikirim'){
                    $konsumen   = mysql_query("SELECT * FROM user WHERE username='$r[u_pembeli]'");
                    $k          = mysql_fetch_array($konsumen);
                    echo"
                    <a href='?page=Pembelian&act=detail&id=$r[no_invoice]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i> Detail</a>                    
                    <a href='https://api.whatsapp.com/send?phone=$k[no_hp]&text=Terima%20kasih%20telah%20berbelanja%20di%20Toko%20Asia%20Comunika.%20Pesanan%20anda%20dengan%20no%20invoice%20$r[no_invoice]%20telah%20dikirim%20dengan%20nomor%20resi%20$r[no_resi].' class='btn btn-outline-info btn-sm' target='_blank'><i class='fa fa-arrow-left'></i> Kirim Pesan WA</a>
                    <a href='$aksi?page=Pembelian&act=selesai&id=$r[no_invoice]&metode='$r[metode_bayar]' class='btn btn-outline-success btn-sm'><i class='fa fa-check'></i> Selesai</a>";                    
                    }
                    else{
                    echo"
                    <a href='?page=Pembelian&act=detail&id=$r[no_invoice]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i> Detail</a>";
                    }
                    echo"
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
  `orders`
  INNER JOIN `orders_detail` ON
    `orders`.`no_invoice` = `orders_detail`.`no_invoice`
  INNER JOIN `user` ON `orders`.`u_pembeli` = `user`.`username`
  INNER JOIN `produk` ON `orders_detail`.`id_produk` = `produk`.`id_produk` WHERE orders.no_invoice='$_GET[id]'");
$r=mysql_fetch_array($tampil);
echo"
<div class='animated fadeIn'>
<div class='row'>
    <div class='col-md-12'>
        <div class='card'>
        <div class='card-header'>
            <strong>Detail Pembelian</strong>
        </div>
        <div class='card-body card-block'>        
        <div class='col-lg-12'>
        <h5>Info Pembelian</h5> <br>
        <div class='row form-group'>
        <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Nomor Invoice</label></div>
            <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>$r[no_invoice]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Tanggal Pembelian</label></div>
                <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>$r[tgl_order]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Total Pesanan</label></div>
                <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>Rp. " .number_format($r['total_tagihan'],0,".", ".");"";echo"</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Metode Pembayaran</label></div>
                <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>$r[metode_bayar]</label></div>
            </div>";
            if($r['status_order']=='Sedang Diproses'){
            echo"
            <form action='$aksi?page=Pembelian&act=confirm' method='POST' enctype='multipart/form-data' class='form-horizontal'>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='no_resi' class='form-control-label'>Nomor Resi</label></div>
                <div class='col-9 col-md-6'><input type='text' name='no_resi' id='no_resi'  placeholder='Masukkan Nomor Resi' class='form-control'>
                <input type='hidden' name='no_invoice' id='no_invoice'  value='$r[no_invoice]' class='form-control'></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='status_order' class='form-control-label'>Status Pembelian</label></div>
                <div class='col-9 col-md-6'>
                <select data-placeholder='-- Pilih Status Pembelian --' name='status_order' class='standardSelect' tabindex='1' required>
                    <option value=''></option>
                    <option value='Sedang Dikirim'>Sedang Dikirim</option>
                    <option value='Ditolak'>Ditolak</option>
                </select>
                </div>
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
            ";
            }else{
            echo"
            <div class='row form-group'>
                <div class='col col-md-3'><label for='id_bank' class='form-control-label'>Nomor Resi</label></div>
                <div class='col-9 col-md-6'><label for='id_bank' class='form-control-label'>$r[no_resi]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='status_order' class='form-control-label'>Status Pesanan</label></div>
                <div class='col-9 col-md-6'><label for='status_order' class='form-control-label'>$r[status_order]</label></div>
            </div>            
            ";
            }
            echo" <br> <br> <br>
            <h5>Alamat Pengiriman</h5> <br>";
            $konsumen   = mysql_query("SELECT * FROM user WHERE username='$r[u_pembeli]'");
            $k          = mysql_fetch_array($konsumen);
            $kota       = mysql_query("SELECT * FROM `provinsi`
            INNER JOIN `kota` ON `kota`.`id_provinsi` = `provinsi`.`id_provinsi` WHERE id_kota='$k[id_kota]'");
            $s          = mysql_fetch_array($kota);
            echo"
            <div class='row form-group'>
                <div class='col col-md-3'><label for='status_order' class='form-control-label'>Nama Penerima</label></div>
                <div class='col-9 col-md-6'><label for='status_order' class='form-control-label'>$k[nama_lengkap]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='status_order' class='form-control-label'>Nomor HP</label></div>
                <div class='col-9 col-md-6'><label for='status_order' class='form-control-label'>$k[no_hp]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='provinsi' class='form-control-label'>Provinsi</label></div>
                <div class='col-9 col-md-6'><label for='provinsi' class='form-control-label'>$s[provinsi]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='provinsi' class='form-control-label'>Kota / Kabupaten</label></div>
                <div class='col-9 col-md-6'><label for='provinsi' class='form-control-label'>$s[kota]</label></div>
            </div>
            <div class='row form-group'>
                <div class='col col-md-3'><label for='provinsi' class='form-control-label'>Alamat</label></div>
                <div class='col-9 col-md-6'><label for='provinsi' class='form-control-label'>$k[alamat]</label></div>
            </div>
            
            ";?>
            <script src="http://maps.googleapis.com/maps/api/js"></script>
            <script>
            function initialize() {
            var propertiPeta = {
                center:new google.maps.LatLng(<?php echo"$r[latitude],$r[longitude]"; ?>),
                zoom:9,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            
            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
            
            // membuat Marker
            var marker=new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo"$r[latitude],$r[longitude]"; ?>),
                map: peta
            });

            }

            // event jendela di-load  
            google.maps.event.addDomListener(window, 'load', initialize);
            </script>
            

            <div id="googleMap" style="width:100%;height:380px;"></div>
<?php      echo"
            <br> <br> <br>
            <br>
            <h5>Detail Pembelian</h5> <br>
            <table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th width='3%'>No.</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>";
                $tampil_produk = mysql_query("SELECT * FROM `orders_detail`
                INNER JOIN `orders` ON `orders_detail`.`no_invoice` = `orders`.`no_invoice`
                INNER JOIN `produk` ON `orders_detail`.`id_produk` = `produk`.`id_produk` WHERE orders_detail.no_invoice = '$r[no_invoice]'");
            
                $no = 1;
                while($r3=mysql_fetch_array($tampil_produk)){
                echo"
                <tr>
                    <td>$no.</td>
                    <td>$r3[no_invoice]</td>
                    <td>x$r3[jumlah]</td>
                    <td>Rp. " .number_format($r3['harga'],0,".", ".");"</span>";echo"</td>";     
                    $no++;
                    }
                    echo"
                </tr>
                <tr>
                    <td colspan='3'>Grand Total</td>";                    
                            $id = $r['u_pembeli'];
                            $konsumen   = mysql_query("SELECT * FROM user WHERE username='$id'");
                            $k          = mysql_fetch_array($konsumen);
                            $kota       = mysql_query("SELECT * FROM `provinsi`
                                        INNER JOIN `kota` ON `kota`.`id_provinsi` = `provinsi`.`id_provinsi` WHERE id_kota='$k[id_kota]'");
							$s          = mysql_fetch_array($kota);
							
							$id2 = $_GET[id];
                            $total_harga = mysql_query("SELECT * FROM `orders_detail`
							INNER JOIN `orders` ON `orders_detail`.`no_invoice` = `orders`.`no_invoice`
							INNER JOIN `produk` ON `orders_detail`.`id_produk` = `produk`.`id_produk` WHERE orders_detail.no_invoice = '$id2'");
							while($r2=mysql_fetch_array($total_harga)){
                            $subtotal    = $r2[harga]* $r2[jumlah];
                            $total       = $total + $subtotal;                            
                            }
                            $total_semua = $total+$s[ongkir];
                    echo"
                    <td>Rp. " .number_format($total,0,".", ".");"";echo"</td>
                </tr>
                <tr>
                    <td colspan='3'>Ongkos Kirim</td>
                    <td>Rp. " .number_format($s['ongkir'],0,".", ".");"";echo"</td>
                </tr>
                <tr>
                    <td colspan='3'>Total</td>
                    <td>Rp. " .number_format($total_semua,0,".", ".");"";echo"</td>
                </tr>                                
            </tbody>
            </table>
        </div>
        </div>          
        </div>
    </div>
</div>
";

break;

}

?>