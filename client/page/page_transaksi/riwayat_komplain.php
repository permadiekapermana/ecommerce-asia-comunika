<?php

include "../config/koneksi.php";
error_reporting(0);
session_start(0); 
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../client/index.php'</script>";
}
include "../../../config/fungsi_indotgl.php";

$aksi="page/page_transaksi/aksi_pembelian.php";

$id = $_GET[id];
$nota   = mysql_query("SELECT * FROM orders WHERE no_invoice='$id'");
$r      = mysql_fetch_array($nota);

switch($_GET[act]){
default:

?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Riwayat Komplain</h1>
                    <nav class="d-flex align-items-center">
                        <a href="?page=dashboard">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="?page=riwayat_komplain">Riwayat Komplain</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
		<h3>Riwayat Komplain</h3> <br>
		<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No Invoice</th>
                                            <th>Jenis Komplain</th>
                                            <th>Status Komplain</th>
                                            <th>Tgl Order</th>
                                            <th>Tgl Bayar</th>
                                            <th>Metode Bayar</th>
                                            <th>Bukti Komplain</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $tampil = mysql_query("SELECT
                                        *
                                      FROM
                                        `komplain`
                                        INNER JOIN `orders` ON `komplain`.`no_invoice` = `orders`.`no_invoice`
                                        INNER JOIN `user` ON `komplain`.`u_pembeli` = `user`.`username` WHERE komplain.u_pembeli = '$_SESSION[namauser]'  ORDER BY komplain.no_invoice ASC");
            
                                        $no = 1;
                                        while($r=mysql_fetch_array($tampil)){
                                        echo"                                    
                                        <tr>
                                            <td>$no.</td>
                                            <td>$r[no_invoice]</td>
                                            <td>$r[jenis_komplain]</td>
                                            <td>$r[status]</td>
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
                                                echo"<a href='../admin/upload/bukti/$r[bukti_komplain]' target='_blank' class='btn btn-outline-danger btn-sm'>Bukti Komplain</a>";
                                            }elseif($r['metode_bayar']=='COD' AND $r['status_order']=='Selesai'){
                                                echo"<font color='green'>Terverifikasi</font>";
                                            }
                                            else{
                                                echo"<font color='red'>Belum Ada</font>";
                                            }
                                            echo"
                                            </td>
                                            <td width='9%' align='center'>";
                                            $bukti=mysql_query("SELECT bukti_transfer FROM konfirm_bayar WHERE no_invoice='$r[no_invoice]'");
                                            $r2=mysql_fetch_array($bukti);
                                            if($r['status_order']=='Sedang Dikirim'){
                                            echo"
                                            <a href='?page=riwayat_komplain&act=detail2&id=$r[no_invoice]' class='btn btn-outline-danger btn-sm'><i class='fa fa-pencil'></i> Detail</a> ";                    
                                            }
                                            else{
                                            echo"
                                            <a href='?page=pembelian&act=detail&id=$r[no_invoice]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i> Detail</a>";
                                            }
                                            echo"
                                            </td>";
                                        $no++;
                                        }
                                        echo"
                                        </tr>";
                                    ?>
                                    </tbody>
                                </table>
		</div>
	</section>
	<!--================End Order Details Area =================-->

<?php

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

?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Konfirmasi</h1>
                    <nav class="d-flex align-items-center">
                        <a href="?page=dashboard">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="?page=#">Konfirmasi</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
            <?php
            if($r[metode_bayar]=='Transfer' AND $r[status_order]=='Menunggu Pembayaran'){
            echo"
            <h3 class='title_confirmation'>Terima Kasih. Silahkan lakukan konfirmasi pembayaran untuk melanjutkan.</h3>
            ";  
            }
            elseif($r[metode_bayar]=='COD'){
            echo"
			<h3 class='title_confirmation'>Terima Kasih. Pesanan Anda telah kami terima.
			<br>
			Karyawan toko kami akan segera menghubungi anda untuk pengiriman barang.
			</h3>
            ";
            }
            if($r[status_order]=='Sedang Dikirim'){
            echo"
            <h3 class='title_confirmation'>Pesanan telah dikirim. Silahkan tunggu barang sampai.</h3>
            ";  
            }
            ?>
			<div class="row order_d_inner">
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Info Pembelian</h4>
						<ul class="list">
							<li><a href="#"><span>No. Invoice</span> : <?php echo"$r[no_invoice]"; ?></a></li>
                            <li><a href="#"><span>Tanggal</span> : <?php $tgl=tgl_indo($r['tgl_order']); echo"$tgl"; ?></a></li>
                            <?php
                            $id = $_SESSION[namauser];
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
                            ?>
							<li><a href="#"><span>Total</span> : <?php echo"Rp. " .number_format($total_semua,0,".", ".");"";echo""; ?></a></li>
							<li><a href="#"><span>Metode Pembayaran</span> : <?php echo"$r[metode_bayar]"; ?></a></li>
                            <li><a href="#"><span>Nomor Resi</span> : <?php echo"$r[no_resi]"; ?></a></li>
                            <li><a href="#"><span>Status Pembelian</span> : <?php echo"$r[status_order]"; ?></a></li>
                            <?php
                            if($r[metode_bayar]=='Transfer' AND $r[status_order]=='Menunggu Pembayaran'){
                            echo"
                            <a href='$aksi?page=pembelian&act=batal&id=$r[no_invoice]' class='btn btn-outline-danger btn-sm'><i class='fa fa-close'></i> Batal</a>
                            ";
                            }
                            ?>
						</ul>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="details_item">
                        <h4>Alamat Pengiriman</h4>
                        <?php
                        $konsumen   = mysql_query("SELECT * FROM user WHERE username='$id'");
                        $k          = mysql_fetch_array($konsumen);
                        $kota       = mysql_query("SELECT * FROM `provinsi`
                        INNER JOIN `kota` ON `kota`.`id_provinsi` = `provinsi`.`id_provinsi` WHERE id_kota='$k[id_kota]'");
                        $s          = mysql_fetch_array($kota);
                        ?>
						<ul class="list">
                            <li><a href="#"><span>Nama Penerima</span> : <?php echo"$k[nama_lengkap]"; ?></a></li>
                            <li><a href="#"><span>Provinsi</span> : <?php echo"$s[provinsi]"; ?></a></li>
							<li><a href="#"><span>Kota/Kabupaten</span> : <?php echo"$s[kota]"; ?></a></li>
							<li><a href="#"><span>Alamat</span> : <?php echo"$k[alamat]"; ?></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="order_details_table">
				<h2>Detail Pembelian</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Produk</th>
								<th scope="col">Jumlah</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            $id = $_GET[id];
                            $produk = mysql_query("SELECT * FROM `orders_detail`
								INNER JOIN `orders` ON `orders_detail`.`no_invoice` = `orders`.`no_invoice`
								INNER JOIN `produk` ON `orders_detail`.`id_produk` = `produk`.`id_produk` WHERE orders_detail.no_invoice = '$id'");
                                while($r = mysql_fetch_array($produk)){
                                echo"
                                <tr>
								<td>
									<p>$r[produk]</p>
								</td>
								<td>
									<h5>x $r[jumlah]</h5>
								</td>
								<td>
									<p>Rp. " .number_format($r[harga],0,".", ".");"</span>";echo"</p>
								</td>
							    </tr>";
                                }
                            ?>
							
							<tr>
								<td>
									<h4>Grand Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p><?php echo"Rp. " .number_format($total,0,".", ".");"";echo""; ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Ongkos Kirim</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p><?php echo"Rp. " .number_format($s[ongkir],0,".", ".");"";echo""; ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p><?php echo"Rp. " .number_format($total_semua,0,".", ".");"";echo""; ?></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--================End Order Details Area =================-->

<?php
break;

case "detail2":

$tampil=mysql_query("SELECT
*
FROM
  `orders`
  INNER JOIN `orders_detail` ON
    `orders`.`no_invoice` = `orders_detail`.`no_invoice`
  INNER JOIN `user` ON `orders`.`u_pembeli` = `user`.`username`
  INNER JOIN `produk` ON `orders_detail`.`id_produk` = `produk`.`id_produk` WHERE orders.no_invoice='$_GET[id]'");
$r=mysql_fetch_array($tampil);

?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Komplain</h1>
                    <nav class="d-flex align-items-center">
                        <a href="?page=dashboard">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="?page=#">Komplain</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
            <?php
            if($r[metode_bayar]=='Transfer' AND $r[status_order]=='Menunggu Pembayaran'){
            echo"
            <h3 class='title_confirmation'>Terima Kasih. Silahkan lakukan konfirmasi pembayaran untuk melanjutkan.</h3>
            ";  
            }
            elseif($r[metode_bayar]=='COD'){
            echo"
			<h3 class='title_confirmation'>Terima Kasih. Pesanan Anda telah kami terima.
			<br>
			Karyawan toko kami akan segera menghubungi anda untuk pengiriman barang.
			</h3>
            ";
            }
            if($r[status_order]=='Sedang Dikirim'){
            echo"
            <h3 class='title_confirmation'>Pesanan telah dikirim. Silahkan tunggu barang sampai.</h3>
            ";  
            }
            ?>
			<div class="row order_d_inner">
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Info Pembelian</h4>
						<ul class="list">
							<li><a href="#"><span>No. Invoice</span> : <?php echo"$r[no_invoice]"; ?></a></li>
                            <li><a href="#"><span>Tanggal</span> : <?php $tgl=tgl_indo($r['tgl_order']); echo"$tgl"; ?></a></li>
                            <?php
                            $id = $_SESSION[namauser];
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
                            ?>
							<li><a href="#"><span>Total</span> : <?php echo"Rp. " .number_format($total_semua,0,".", ".");"";echo""; ?></a></li>
							<li><a href="#"><span>Metode Pembayaran</span> : <?php echo"$r[metode_bayar]"; ?></a></li>
                            <li><a href="#"><span>Nomor Resi</span> : <?php echo"$r[no_resi]"; ?></a></li>
                            <li><a href="#"><span>Status Pembelian</span> : <?php echo"$r[status_order]"; ?></a></li>
                            <?php
                            if($r[metode_bayar]=='Transfer' AND $r[status_order]=='Menunggu Pembayaran'){
                            echo"
                            <a href='$aksi?page=pembelian&act=batal&id=$r[no_invoice]' class='btn btn-outline-danger btn-sm'><i class='fa fa-close'></i> Batal</a>
                            ";
                            }
                            ?>
						</ul>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="details_item">
                        <h4>Alamat Pengiriman</h4>
                        <?php
                        $konsumen   = mysql_query("SELECT * FROM user WHERE username='$id'");
                        $k          = mysql_fetch_array($konsumen);
                        $kota       = mysql_query("SELECT * FROM `provinsi`
                        INNER JOIN `kota` ON `kota`.`id_provinsi` = `provinsi`.`id_provinsi` WHERE id_kota='$k[id_kota]'");
                        $s          = mysql_fetch_array($kota);
                        ?>
						<ul class="list">
                            <li><a href="#"><span>Nama Penerima</span> : <?php echo"$k[nama_lengkap]"; ?></a></li>
                            <li><a href="#"><span>Provinsi</span> : <?php echo"$s[provinsi]"; ?></a></li>
							<li><a href="#"><span>Kota/Kabupaten</span> : <?php echo"$s[kota]"; ?></a></li>
							<li><a href="#"><span>Alamat</span> : <?php echo"$k[alamat]"; ?></a></li>
						</ul>
					</div>
                </div>
                <div class="col-lg-12">
					<div class="details_item">
                        <h4>Detail Komplain</h4>
                        <?php
                        $tampil3 = mysql_query("SELECT
                        *
                      FROM
                        `komplain`
                        INNER JOIN `orders` ON `komplain`.`no_invoice` = `orders`.`no_invoice`
                        INNER JOIN `user` ON `komplain`.`u_pembeli` = `user`.`username` WHERE komplain.u_pembeli = '$_SESSION[namauser]'  ORDER BY komplain.no_invoice ASC");
                        $r3          = mysql_fetch_array($tampil3);
                        ?>
						<ul class="list">
                            <li><a href="#"><span>Jenis Komplain</span> : <?php echo"$r3[jenis_komplain]"; ?></a></li>
                            <li><a href="#"><span>Keterangan</span> : <?php echo"$r3[keterangan]"; ?></a></li>
                            <li><a href="#"><span>Status Komplain</span> : <?php echo"$r3[status]"; ?></a></li>
                            <li><a href="#"><span>Solusi</span> : <?php echo"$r3[solusi]"; ?></a></li>
                            <li><a href="#"><span>Keterangan Solusi</span> : <?php echo"$r3[keterangan2]"; ?></a></li>
                            <?php
                            if($r3[status]=='Menunggu Solusi'){
                            echo"
                            <a href='$aksi?page=pembelian&act=selesaikomplain&id=$r[no_invoice]' class='btn btn-outline-success btn-sm'><i class='fa fa-check'></i> Selesai Komplain</a>
                            ";
                            }
                            ?>
						</ul>
					</div>
				</div>
            </div>
            
			<div class="order_details_table">
				<h2>Detail Pembelian</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Produk</th>
								<th scope="col">Jumlah</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            $id = $_GET[id];
                            $produk = mysql_query("SELECT * FROM `orders_detail`
								INNER JOIN `orders` ON `orders_detail`.`no_invoice` = `orders`.`no_invoice`
								INNER JOIN `produk` ON `orders_detail`.`id_produk` = `produk`.`id_produk` WHERE orders_detail.no_invoice = '$id'");
                                while($r = mysql_fetch_array($produk)){
                                echo"
                                <tr>
								<td>
									<p>$r[produk]</p>
								</td>
								<td>
									<h5>x $r[jumlah]</h5>
								</td>
								<td>
									<p>Rp. " .number_format($r[harga],0,".", ".");"</span>";echo"</p>
								</td>
							    </tr>";
                                }
                            ?>
							
							<tr>
								<td>
									<h4>Grand Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p><?php echo"Rp. " .number_format($total,0,".", ".");"";echo""; ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Ongkos Kirim</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p><?php echo"Rp. " .number_format($s[ongkir],0,".", ".");"";echo""; ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p><?php echo"Rp. " .number_format($total_semua,0,".", ".");"";echo""; ?></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--================End Order Details Area =================-->

<?php
break;

}

?> 