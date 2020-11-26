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

	<section class="order_details section_gap">
		<div class="container">
		<h3 class='title_confirmation'>Komplain anda telah kami terima. Mohon berkenan menunggu solusi dari kami.</h3>
		</div>		
	</section>
	<!--================End Login Box Area =================-->

