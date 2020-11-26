	<!-- Start Banner Area -->
	<?php
	include "../config/koneksi.php";
	error_reporting(0);
	session_start(0); 
	if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	  echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../client/index.php'</script>";
	}
	?>
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Konfirmasi Pembayaran</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=konfirm_bayar">Konfirmasi Pembayaran</a>
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
			
				<h3>Konfirmasi Pembayaran</h3> <br><br>
				<br><font color="red">* Mohon lakukan konfirmasi pembayaran sebelum 1x24 jam.</font> <br><br>
						<form class="row contact_form" action="page/page_konfirm/aksi_bayar.php" method="post" enctype="multipart/form-data">
									<div class="col-md-7">
										<div class="form-group">
											<h5>Nomor Invoice / Order ID</h5>
											<select name="no_invoice" class="form-control" required>
												<option value="">-- Pilih Nomor Invoice / Order ID --</option>
												<?php
												
												$tampil=mysql_query("SELECT * FROM orders WHERE u_pembeli= '$_SESSION[namauser]' AND status_order ='Menunggu Pembayaran' ORDER BY no_invoice");
												while($r=mysql_fetch_array($tampil)){
												  echo "<option value='$r[no_invoice]'>$r[no_invoice]</option>";
												}
												
												?>
											</select>
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
		
	</section>
	<!--================End Login Box Area =================-->

