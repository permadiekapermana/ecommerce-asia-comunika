<?php
include "../../../config/koneksi.php";

$pel="CART.";
$y=substr($pel,0,4);
$query=mysql_query("select * from keranjang where substr(id_keranjang,1,4)='$y' order by id_keranjang desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_keranjang'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="page/page_pdetail/aksi_pdetail.php";

?>

<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>Smartphone  <br>Edisi Terbaru!</h1>
									<p>Temukan Smartphone idaman anda dengan pelayanan memuaskan hanya di Toko Asia Comunika.<br>Kepuasan pelanggan adalah komitmen kami.</p>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/banner/banner-img.png" width="10%" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5">
								<div class="banner-content">
									<h1>iPhone  <br>New Collection!</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>			
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/banner/banner-img.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div>
						<h6>Pengiriman Cepat</h6>
						<p>Pengiriman ke seluruh daerah Indonesia</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>100% Uang Kembali</h6>
						<p>Garansi untuk semua barang</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>Dukungan 24/7</h6>
						<p>Customer Service selalu online</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Transaksi Aman</h6>
						<p>Kepercayaan anda tanggung jawab kami</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->


	<!-- start product Area -->
	<section >
		<!-- single product slide -->
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Rekomendasi Kami</h1>
							<p>Bingung memilih smartphone ? Tengok deh rekomendasi dari toko kami, siapa tau cocok langsung bungkus!</p>
						</div>
					</div>
				</div>
				<form action="<?php echo" $aksi?page=pdetail&act=input2&id=$r[id_produk] "; ?>" method="POST">
				<div class="row">
					<!-- single product -->
					<?php
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
				  `rekomendasi`
				INNER JOIN `produk` ON `produk`.`id_produk` = `rekomendasi`.`id_produk`
				INNER JOIN `kategori` ON `kategori`.`id_kategori` = `produk`.`id_kategori`
				INNER JOIN `merek` ON `merek`.`id_merek` = `produk`.`id_merek` ORDER BY produk.id_produk DESC LIMIT 8");
				
					while($r=mysql_fetch_array($tampil)){
					echo"
					<div class='col-lg-3 col-md-6'>
						<div class='single-product'>
							<img src='../admin/upload/produk/$r[gambar]' alt='' border='3' height='300' width='200'>
							<div class='product-details'>
								<h6>$r[produk]</h6>
								<div class='price'>
									<h6>Rp. " .number_format($r[harga],0,".", ".");"</h6>";echo"
								</div>
								<input type='hidden' name='id_produk' value='$r[id_produk]'>
								<input type='hidden' name='username' value='$_SESSION[namauser]'>
								<input type='hidden' name='id_keranjang' value='$nopel'>
								<input type='hidden' name='jumlah' value='1'>
								<div class='prd-bottom'>";
									
																
									if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
										echo "
										<a class='social-info' onClick='loginDulu()'><span class='ti-bag'></span>
										<p class='hover-text'>Tambah</p></a>										
										";
									}
									else{
										echo"										
										<a href='$aksi?page=pdetail&act=input2&id_produk=$r[id_produk]&username=$_SESSION[namauser]&id_keranjang=$nopel' class='social-info'>
											<span class='ti-bag'></span>
											<p class='hover-text'>Tambah</p>
										</a>							
										";
									}
									
									echo"
									<a href='?page=pdetail&id=$r[id_produk]' class='social-info'>
										<span class='lnr lnr-move'></span>
										<p class='hover-text'>Lihat Detail</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					";
					}
					?>
					<!-- single product -->
					
				</div>
				</form>
			</div>
		</div>
		
	</section>
	<!-- end product Area -->
	
	<!-- start product Area -->
	<section >
		<!-- single product slide -->
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Produk Terbaru</h1>
							<p>Cari produk baru yang sedang trending ? Ini nih produk yang gabakal bikin kamu dibilang kudet!</p>
						</div>
					</div>
				</div>
				<form action="<?php echo" $aksi?page=pdetail&act=input2&id=$r[id_produk] "; ?>" method="POST">
				<div class="row">
					<!-- single product -->
					<?php
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
					INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` ORDER BY id_produk DESC LIMIT 8");
				
					while($r=mysql_fetch_array($tampil)){
					echo"
					<div class='col-lg-3 col-md-6'>
						<div class='single-product'>
							<img src='../admin/upload/produk/$r[gambar]' alt='' border='3' height='300' width='200'>
							<div class='product-details'>
								<h6>$r[produk]</h6>
								<div class='price'>
									<h6>Rp. " .number_format($r[harga],0,".", ".");"</h6>";echo"
								</div>
								<input type='hidden' name='id_produk' value='$r[id_produk]'>
								<input type='hidden' name='username' value='$_SESSION[namauser]'>
								<input type='hidden' name='id_keranjang' value='$nopel'>
								<input type='hidden' name='jumlah' value='1'>
								<div class='prd-bottom'>";
									
																
									if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
										echo "
										<a class='social-info' onClick='loginDulu()'><span class='ti-bag'></span>
										<p class='hover-text'>Tambah</p></a>										
										";
									}
									else{
										echo"										
										<a href='$aksi?page=pdetail&act=input2&id_produk=$r[id_produk]&username=$_SESSION[namauser]&id_keranjang=$nopel' class='social-info'>
											<span class='ti-bag'></span>
											<p class='hover-text'>Tambah</p>
										</a>							
										";
									}
									
									echo"
									<a href='?page=pdetail&id=$r[id_produk]' class='social-info'>
										<span class='lnr lnr-move'></span>
										<p class='hover-text'>Lihat Detail</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					";
					}
					?>
					<!-- single product -->
					
				</div>
				</form>
			</div>
		</div>
		
	</section>
	<!-- end product Area -->