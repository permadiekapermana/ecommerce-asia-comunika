<?php

include "../../../config/koneksi.php";
include "../../../config/fungsi_indotgl.php";

$aksi="page/page_keranjang/aksi_checkout.php";

$id = $_GET[id];
$nota   = mysql_query("SELECT * FROM orders WHERE no_invoice='$id'");
$r      = mysql_fetch_array($nota);

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
            if($r[metode_bayar]=='Transfer'){
            echo"
            <h3 class='title_confirmation'>Terima Kasih. Silahkan lakukan konfirmasi pembayaran untuk melanjutkan.</h3>
            ";  
            }
            else{
            echo"
			<h3 class='title_confirmation'>Terima Kasih. Pesanan Anda telah kami terima.
			<br>
			Karyawan toko kami akan segera menghubungi anda untuk pengiriman barang.
			</h3>
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
	
		<div class="container">
			<div class="row">				
			
				<h3>Konfirmasi Pembayaran</h3>
				<br><font color="red">* Mohon lakukan konfirmasi pembayaran sebelum 1x24 jam.</font> <br><br>
				
						<form class="row contact_form" action="page/page_konfirm/aksi_bayar.php" method="post" enctype="multipart/form-data">
						
						
									<div class="col-md-7">
										<div class="form-group">
											<h5>Nomor Invoice / Order ID</h5>
											<?php
											$id = $_GET[id];
											$nota   = mysql_query("SELECT * FROM orders WHERE no_invoice='$id'");
											$r      = mysql_fetch_array($nota);
											?>
											<input type="text"  class="form-control" value="<?php echo"$r[no_invoice]"; ?>" disabled>
											<input type="hidden" name="no_invoice"  class="form-control" value="<?php echo"$r[no_invoice]"; ?>">
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Waktu Pembayaran</h5>
											<input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value='<?php echo date('Y-m-d'); echo""; ?>' required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Ditranfer Ke :</h5>
											<select name="id_bank" class="form-control" id="pilih-bank" required>
												<option value="">-- Pilih Bank --</option>
												<?php
												
												$tampil=mysql_query("SELECT * FROM bank ORDER BY id_bank");
												while($r=mysql_fetch_array($tampil)){
												  echo "<option value='$r[id_bank]'>$r[bank] - $r[no_rek] - $r[pemilik]</option>";
												}
												
												?>
											</select>
										</div>
									</div><br>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Bank Asal</h5>
											<input type="text" class="form-control" id="bank_asal" name="bank_asal" placeholder="Masukkan Bank Asal" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Bank Asal'" required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Nama Pemilik</h5>
											<input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="Masukkan Nama Pemilik" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Nama Pemilik'" required>
										</div>
									</div>
									
									<div class="col-md-7">
										<div class="form-group">
											<h5>Jumlah (Rp.)</h5>
											<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Transfer Sesuai Nominal Pembelian" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Jumlah Transfer Sesuai Nominal Pembelian'" required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Bukti Transfer</h5>
											<input type="file" class="form-control" id="fupload" name="fupload" required>
										</div>
									</div>
									<div class="col-md-7 text-left">
										<button type="submit" value="submit" class="primary-btn">Konfirm</button>
									</div>
								</form>
					</div>
				</div>
				<br>

<?php

?> 