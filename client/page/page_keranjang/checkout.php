<?php

include "../../../config/koneksi.php";

$id = $_SESSION[namauser];
$sql = mysql_query("SELECT * FROM keranjang, produk WHERE username = '$id' AND keranjang.id_produk = produk.id_produk");
$ketemu = mysql_num_rows($sql);
if($ketemu < 1 ){
	echo "<script>window.alert('Keranjang Belanja Masih Kosong. Silahkan Anda Berbelanja Terlebih Dahulu'); window.location=('?page=katalog')</script>";
} else {

$aksi="page/page_keranjang/aksi_checkout.php";

?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="?page=dashboard">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="?page=checkout">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
            <h3>Alamat Pengiriman</h3>
            <form action="<?php echo"$aksi?page=checkout&act=input "; ?>" method="POST">

<div class="main">

<div id="mapa"></div>
<div class="eventtext">
<div>Lattitude On Cursor: <span id="latspan"></span></div>

<div>Longitude On Cursor: <span id="lngspan"></span></div>
<div>Lattitude Longitude: <span id="latlong"></span></div>
<div><input type="hidden" id="latlongclicked" style="width:300px; border:1px inset gray;"></span></div>
<div>Latitude on Click:
<input type="text" class="form-control" id="latclicked" name="latitude" style="width:300px; border:1px inset gray;" required></span></div>
<div>Longitude on Click:
<input type="text" class="form-control" id="longclicked" name="longitude" style="width:300px; border:1px inset gray;" required></span></div>
</div>
</div>

</div>
<script type="text/javascript">
if (GBrowserIsCompatible())
{
map = new GMap2(document.getElementById("mapa"));
map.addControl(new GLargeMapControl());
map.addControl(new GMapTypeControl(3));
map.setCenter( new GLatLng(-6.7063, 108.557), 11,0);

GEvent.addListener(map,'mousemove',function(point)
{
document.getElementById('latspan').innerHTML = point.lat()
document.getElementById('lngspan').innerHTML = point.lng()
document.getElementById('latlong').innerHTML = point.lat() + ', ' + point.lng()
});

GEvent.addListener(map,'click',function(overlay,point)
{
document.getElementById('latlongclicked').value = point.lat() + ', ' + point.lng()
document.getElementById('latclicked').value = point.lat()
document.getElementById('longclicked').value = point.lng()
});
}
</script>

<br />

                <div class="row">
                        
                        
                        <?php
                        $id = $_SESSION[namauser];
                        $konsumen   = mysql_query("SELECT * FROM user WHERE username='$id'");
                        $k          = mysql_fetch_array($konsumen);
                        $kota       = mysql_query("SELECT * FROM `provinsi`
                                    INNER JOIN `kota` ON `kota`.`id_provinsi` = `provinsi`.`id_provinsi` WHERE id_kota='$k[id_kota]'");
                        $s          = mysql_fetch_array($kota);
                        ?>    
                    <div class="col-lg-12">
                    
                        <div class="order_box">
                            <h2>Pembelian Kamu</h2>
                            <ul class="list">
                                <li><h5>Produk</h5></li>
                                <?php
                                $id = $_SESSION[namauser];
                                $produk = mysql_query("SELECT * FROM `keranjang`
                                        INNER JOIN `produk` ON `keranjang`.`id_produk` = `produk`.`id_produk`
                                        INNER JOIN `user` ON `keranjang`.`username` = `user`.`username` WHERE user.username = '$id'");
                                while($r = mysql_fetch_array($produk)){
                                echo"
                                <li>$r[produk]</li>
                                <li>x $r[jumlah]</li>
                                <li><span class='last'>Rp. " .number_format($r[harga],0,".", ".");"</span>";echo"</li> <br>";
                                }
                                ?>
                            </ul>
                            <?php
                            $user = mysql_query("SELECT * FROM user WHERE username='$_SESSION[namauser]'");
                            $u    = mysql_fetch_array($user);                            

                            if ($u['id_kota']=='KOTA.000001' OR $u['id_kota']=='KOTA.000002'){
                            echo"
                            <div class='col-md-14 form-group'>
                            <label for='metode_bayar'><h5>Metode Pembayaran</h5></label> <br>
                            <select class='country_select' name='metode_bayar' required>
                                <option value=>-- Pilih Metode Pembayaran --</option>
                                <option value='Transfer'>Transfer Bank</option>
                                <option value='COD'>Cash on Delivery (COD)</option>
                            </select>
                            </div>
                            ";
                            }
                            else{
                            echo"
                            <div class='col-md-14 form-group'>
                            <label for='metode_bayar'><h5>Metode Pembayaran</h5></label> <br>
                            <select class='country_select' name='metode_bayar' required>
                                <option value=>-- Pilih Metode Pembayaran --</option>
                                <option value='Transfer'>Transfer Bank</option>
                                <option value='COD' disabled>Cash on Delivery (COD)</option>
                            </select>
                            </div>
                            ";
                            }
                            ?>
                            <?php
                            $sql_i = mysql_query("SELECT * FROM orders");
                            $num_i = mysql_num_rows($sql_i);
                        
                            if ($num_i <> 0) {
                                $kode_i = $num_i + 1;
                            } else {
                                $kode_i = 1;
                            }
                        
                            //mulai bikin kode
                            $bikin_kode_i = str_pad($kode_i, 9, "0", STR_PAD_LEFT);
                            $tahun_i = date('Ymd');
                            $kode_jadi_i = "INV$tahun_i$bikin_kode_i";
                            ?>
                            <input type="hidden" name='no_invoice' value='<?php echo"$kode_jadi_i"; ?>'></input>
                            <ul class="list list_2">
                            <?php
                                $id = $_SESSION[namauser];
								$total_harga = mysql_query("SELECT * FROM `keranjang` INNER JOIN `produk` ON `keranjang`.`id_produk` = `produk`.`id_produk` WHERE username = '$id'");
							 	while($r=mysql_fetch_array($total_harga)){
                                $subtotal    = $r[harga]* $r[jumlah];
                                $total       = $total + $subtotal;
                                }
                            ?>
                            <?php
                            $tampil3 = mysql_query("SELECT * FROM keranjang where username='$_SESSION[namauser]' ");
                            while($r3=mysql_fetch_array($tampil3)){
                            echo"
                            <input type='hidden' name='id_produk[]' value='$r3[id_produk]' class='form-control col-md-7 col-xs-12'>
                            <input type='hidden' name='jumlah[]' value='$r3[jumlah]' class='form-control col-md-7 col-xs-12'>
                            ";                                    
                            }
                            ?>
                            <br><br>
                                <li><a href="#">Total <span><?php echo"Rp. " .number_format($total,0,".", ".");"";echo""; ?></span></a></li>
                                <li><a href="#">Ongkos Kirim <span><?php echo"Rp. " .number_format($s[ongkir],0,".", ".");"";echo""; ?></span></a></li>
                            <?php
                            $total_semua = $total+$s[ongkir];
                            ?>
                                <li><a href="#">Grand Total <span><?php echo"Rp. " .number_format($total_semua,0,".", ".");"";echo""; ?></span></a></li>
                                <input type='hidden' value='<?php echo"$total_semua";?>' name='total_tagihan'></input>
                            </ul>
                            <div class="payment_item active">
                                <p>Mohon pastikan kembali order anda dengan benar sebelum checkout. Data yang sudah dicheckout tidak dapat diubah</p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector" required>
                                <label for="f-option4">Saya telah setuju dengan </label>
                                <a href="#">syarat dan ketentuan*</a>
                            </div>
                            <div align="center">
                            <button type="submit" class="primary-btn">Lanjut ke Pembayaran</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->

<?php
}
?> 