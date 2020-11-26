<?php

include "../config/koneksi.php";
error_reporting(0);
session_start(0); 
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../client/index.php'</script>";
}
include "../../../config/fungsi_indotgl.php";

$pel="COMP.";
$y=substr($pel,0,4);
$query=mysql_query("select * from komplain where substr(id_komplain,1,4)='$y' order by id_komplain desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_komplain'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

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
                    <h1>Pembelian</h1>
                    <nav class="d-flex align-items-center">
                        <a href="?page=dashboard">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="?page=pembelian">Pembelian</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
		<h3>Pembelian</h3> <br>
		<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No Invoice</th>
                                            <th>Status Order</th>
                                            <th>Tgl Order</th>
                                            <th>Tgl Bayar</th>
                                            <th>Metode Bayar</th>
                                            <th>Bukti Bayar</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $tampil = mysql_query("SELECT * FROM orders WHERE u_pembeli = '$_SESSION[namauser]' AND status_order = 'Menunggu Pembayaran' OR status_order = 'Sedang Diproses' OR status_order = 'Sedang Dikirim' ORDER BY no_invoice ASC");
            
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
                                                echo"<a href='../admin/upload/bukti/$r2[bukti_transfer]' target='_blank' class='btn btn-outline-success btn-sm'>Bukti Bayar</a>";
                                            }else{
                                                echo"<font color='red'>Belum Ada</font>";
                                            }
                                            echo"
                                            </td>
                                            <td width='9%' align='center'>";
                                            $bukti=mysql_query("SELECT bukti_transfer FROM konfirm_bayar WHERE no_invoice='$r[no_invoice]'");
                                            $r2=mysql_fetch_array($bukti);
                                            if($r['status_order']=='Sedang Dikirim'){
                                            echo"
                                            <a href='?page=pembelian&act=detail&id=$r[no_invoice]' class='btn btn-outline-primary btn-sm'><i class='fa fa-pencil'></i> Detail</a>
                                            <a href='?page=pembelian&act=komplain&id=$r[no_invoice]' class='btn btn-outline-danger btn-sm'><i class='fa fa-pencil'></i> Komplain</a>
                                            <a href='$aksi?page=pembelian&act=selesai&id=$r[no_invoice]&metode='$r[metode_bayar]' class='btn btn-outline-success btn-sm'><i class='fa fa-check'></i> Selesai</a>";                    
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

case "komplain":

?>

	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Komplain Pembelian</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<!-- <a href="?page=register">Login/Daftar</a> -->
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">				
			
                <h3>Komplain Pembelian</h3> <br><br>
                        <form class="row contact_form" action="page/page_transaksi/aksi_komplain.php" method="post" enctype="multipart/form-data">
                                    <div class="col-md-7">
										<div class="form-group">
											<font color='red'>* Silahkan berikan informasi mengenai komplain pembelian anda</font>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Nomor Invoice</h5>
                                            <input type="text" class="form-control" value="<?php echo"$_GET[id]"; ?>" id="username" name="username" placeholder="Masukkan Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Username'" disabled>
                                            <input type="hidden" class="form-control" value="<?php echo"$nopel"; ?>" id="id_komplain" name="id_komplain" placeholder="Masukkan Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Username'" required>
                                            <input type="hidden" class="form-control" value="<?php echo"$_GET[id]"; ?>" id="no_invoice" name="no_invoice" placeholder="Masukkan Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Username'" required>
                                            <input type="hidden" class="form-control" value="<?php echo"$_SESSION[namauser]"; ?>" id="u_pembeli" name="u_pembeli" placeholder="Masukkan Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Username'" required>
										</div>
									</div>									
									<div class="col-md-7">
										<div class="form-group">
											<h5>Jenis Komplain</h5>
											<select name="jenis_komplain" class="form-control" id="pilih-kota" required>
                                                <option value="">-- Pilih Jenis Komplain --</option>
                                                <option value="Barang belum sampai">Barang belum sampai</option>
                                                <option value="Pesanan tidak lengkap">Pesanan tidak lengkap</option>
                                                <option value="Produk tidak sesuai dengan deskripsi">Produk tidak sesuai dengan deskripsi</option>
                                                <option value="Lainnya">Lainnya</option>
											</select>
										</div>
									</div><br>									
									<div class="col-md-7">
										<div class="form-group">
											<font color='red'>* Untuk klaim garansi produk pada toko, harap menyertakan video yang diupload ke google drive ketika unboxing dengan menyertakan link pada kolom keterangan. Garansi toko berlaku 1x24 Jam setelah barang diterima.</font>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Keterangan Komplain</h5>
											<textarea class="form-control" name="keterangan" id="keterangan" rows="1" placeholder="Masukkan Keterangan Komplain" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Keterangan Komplain'" required></textarea>
										</div>
                                    </div>
                                    <div class="col-md-7">
										<div class="form-group">
											<h5>Bukti Komplain</h5>
											<input type="file" class="form-control" id="fupload" name="fupload" required>
										</div>
									</div>
									<div class="col-md-7 text-left">
										<button type="submit" value="submit" class="primary-btn">Submit</button>
									</div>
								</form>
					</div>
				</div>
		
    </section>

<?php

break;

}

?> 