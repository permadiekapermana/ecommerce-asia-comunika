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

switch($_GET[act]){
  // Tampil desa
default: 

$detail = mysql_query("SELECT
`produk`.`id_produk`,
`produk`.`produk`,
`kategori`.`kategori`,
`merek`.`merek`,
`produk`.`harga`,
`produk`.`berat`,
`produk`.`stok`,
`produk`.`deskripsi`,
`produk`.`gambar`
FROM
`produk`
INNER JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id_kategori`
INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` WHERE id_produk='$_GET[id]'");
$r      = mysql_fetch_array($detail);

?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detail Product</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=pdetail">Detail Produk</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<br><br>
	<!--================Single Product Area =================-->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Kategori</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_kategori='$r[id_kategori]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=kategori&id=$r[id_kategori]'>$r[kategori]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div> <br>
				<div class="sidebar-categories">
					<div class="head">Merek</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM merek ORDER BY id_merek DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_merek='$r[id_merek]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=merek&id=$r[id_merek]'>$r[merek]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head"></div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<form action="?page=katalog&act=cari" method="POST">
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select name='id_kategori'>
							<option value="">-- Pilih Kategori --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_kategori]'>$r[kategori]</option>";
							}
										
							?>
						</select>
					</div>
					<div class="sorting">
						<select name='id_merek'>
							<option value="">-- Pilih Merek --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM merek ORDER BY id_merek");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_merek]'>$r[merek]</option>";
							}
										
							?>
						</select>
					</div>					
					<!-- <div class="sorting">
					<input class="form-control" name="EMAIL" placeholder="Masukan Nama Produk" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan Nama Produk '"
									 required="" type="email">
					</div> -->
					<div class="sorting">
						<button type='submit' class="genric-btn primary">Cari</button>
					</div>
				</div>
				</form>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<form action="<?php echo" $aksi?page=pdetail&act=input "; ?>" method="POST">
				<section class="lattest-product-area pb-40 category-list">
					<div class="row"><?php
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
					INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` ORDER BY id_produk LIMIT 8");
				
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
				</section>
				</form>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="button-group-area" align="center">
				<a href="?page=katalog&act=lihatsemua" class="genric-btn primary">Lihat Semua</a><br> <br>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!--================End Product Description Area =================-->
<?php
			  
break;

case "lihatsemua":
?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detail Product</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=pdetail">Detail Produk</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<br><br>
	<!--================Single Product Area =================-->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Kategori</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_kategori='$r[id_kategori]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=kategori&id=$r[id_kategori]'>$r[kategori]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div> <br>
				<div class="sidebar-categories">
					<div class="head">Merek</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM merek ORDER BY id_merek DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_merek='$r[id_merek]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=merek&id=$r[id_merek]'>$r[merek]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head"></div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<form action="?page=katalog&act=cari" method="POST">
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select name='id_kategori'>
							<option value="">-- Pilih Kategori --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_kategori]'>$r[kategori]</option>";
							}
										
							?>
						</select>
					</div>
					<div class="sorting">
						<select name='id_merek'>
							<option value="">-- Pilih Merek --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM merek ORDER BY id_merek");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_merek]'>$r[merek]</option>";
							}
										
							?>
						</select>
					</div>					
					<!-- <div class="sorting">
					<input class="form-control" name="EMAIL" placeholder="Masukan Nama Produk" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan Nama Produk '"
									 required="" type="email">
					</div> -->
					<div class="sorting">
						<button type='submit' class="genric-btn primary">Cari</button>
					</div>
				</div>
				</form>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<form action="<?php echo" $aksi?page=pdetail&act=input "; ?>" method="POST">
				<section class="lattest-product-area pb-40 category-list">
					<div class="row"><?php
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
					INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` ORDER BY id_produk");
				
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
				</section>
				</form>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<!-- <div class="button-group-area" align="center">
				<a href="?page=katalog&act=lihatsemua" class="genric-btn primary">Lihat Semua</a><br> <br>
				</div> -->
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!--================End Product Description Area =================-->

<?php

break; 
  
case "kategori":
 
?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detail Product</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=pdetail">Detail Produk</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<br><br>
	<!--================Single Product Area =================-->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Kategori</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_kategori='$r[id_kategori]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=kategori&id=$r[id_kategori]'>$r[kategori]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div> <br>
				<div class="sidebar-categories">
					<div class="head">Merek</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM merek ORDER BY id_merek DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_merek='$r[id_merek]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=merek&id=$r[id_merek]'>$r[merek]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head"></div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<form action="?page=katalog&act=cari" method="POST">
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select name='id_kategori'>
							<option value="">-- Pilih Kategori --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_kategori]'>$r[kategori]</option>";
							}
										
							?>
						</select>
					</div>
					<div class="sorting">
						<select name='id_merek'>
							<option value="">-- Pilih Merek --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM merek ORDER BY id_merek");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_merek]'>$r[merek]</option>";
							}
										
							?>
						</select>
					</div>					
					<!-- <div class="sorting">
					<input class="form-control" name="EMAIL" placeholder="Masukan Nama Produk" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan Nama Produk '"
									 required="" type="email">
					</div> -->
					<div class="sorting">
						<button type='submit' class="genric-btn primary">Cari</button>
					</div>
				</div>
				</form>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<form action="<?php echo" $aksi?page=pdetail&act=input "; ?>" method="POST">
				<section class="lattest-product-area pb-40 category-list">
					<div class="row"><?php
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
					INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` WHERE produk.id_kategori='$_GET[id]' ORDER BY id_produk");
				
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
				</section>
				</form>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<!-- <div class="button-group-area" align="center">
				<a href="?page=katalog&act=lihatsemua" class="genric-btn primary">Lihat Semua</a><br> <br>
				</div> -->
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!--================End Product Description Area =================-->

<?php

break;

case "merek":
 
?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detail Product</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=pdetail">Detail Produk</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<br><br>
	<!--================Single Product Area =================-->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Kategori</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_kategori='$r[id_kategori]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=kategori&id=$r[id_kategori]'>$r[kategori]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div> <br>
				<div class="sidebar-categories">
					<div class="head">Merek</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM merek ORDER BY id_merek DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_merek='$r[id_merek]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=merek&id=$r[id_merek]'>$r[merek]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head"></div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<form action="?page=katalog&act=cari" method="POST">
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select name='id_kategori'>
							<option value="">-- Pilih Kategori --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_kategori]'>$r[kategori]</option>";
							}
										
							?>
						</select>
					</div>
					<div class="sorting">
						<select name='id_merek'>
							<option value="">-- Pilih Merek --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM merek ORDER BY id_merek");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_merek]'>$r[merek]</option>";
							}
										
							?>
						</select>
					</div>					
					<!-- <div class="sorting">
					<input class="form-control" name="EMAIL" placeholder="Masukan Nama Produk" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan Nama Produk '"
									 required="" type="email">
					</div> -->
					<div class="sorting">
						<button type='submit' class="genric-btn primary">Cari</button>
					</div>
				</div>
				</form>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<form action="<?php echo" $aksi?page=pdetail&act=input "; ?>" method="POST">
				<section class="lattest-product-area pb-40 category-list">
					<div class="row"><?php
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
					INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` WHERE produk.id_merek='$_GET[id]' ORDER BY id_produk ");
				
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
				</section>
				</form>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<!-- <div class="button-group-area" align="center">
				<a href="?page=katalog&act=lihatsemua" class="genric-btn primary">Lihat Semua</a><br> <br>
				</div> -->
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!--================End Product Description Area =================-->

<?php

break;

case "cari":
 
?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detail Product</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=pdetail">Detail Produk</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<br><br>
	<!--================Single Product Area =================-->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Kategori</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_kategori='$r[id_kategori]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=kategori&id=$r[id_kategori]'>$r[kategori]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div> <br>
				<div class="sidebar-categories">
					<div class="head">Merek</div>
					<ul class="main-categories">
						<?php
						$tampil = mysql_query("SELECT * FROM merek ORDER BY id_merek DESC");
						
						while($r=mysql_fetch_array($tampil)){
						$hitung_produk = mysql_query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk WHERE id_merek='$r[id_merek]'");
						$r2=mysql_fetch_array($hitung_produk);
						echo"
						<li class='main-nav-list'><a href='?page=katalog&act=merek&id=$r[id_merek]'>$r[merek]<span class='number'>$r2[jumlah_produk]</span></a></li>
						";
						}
						?>
						
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head"></div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
							<ul>
								
							</ul>
						</form>
					</div>
					
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<form action="?page=katalog&act=cari" method="POST">
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select name='id_kategori'>
							<option value="">-- Pilih Kategori --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_kategori]'>$r[kategori]</option>";
							}
										
							?>
						</select>
					</div>
					<div class="sorting">
						<select name='id_merek'>
							<option value="">-- Pilih Merek --</option>
							<?php
												
							$tampil=mysql_query("SELECT * FROM merek ORDER BY id_merek");
							while($r=mysql_fetch_array($tampil)){
							echo "<option value='$r[id_merek]'>$r[merek]</option>";
							}
										
							?>
						</select>
					</div>					
					<!-- <div class="sorting">
					<input class="form-control" name="EMAIL" placeholder="Masukan Nama Produk" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan Nama Produk '"
									 required="" type="email">
					</div> -->
					<div class="sorting">
						<button type='submit' class="genric-btn primary">Cari</button>
					</div>
				</div>
				</form>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<form action="<?php echo" $aksi?page=pdetail&act=input "; ?>" method="POST">
				<section class="lattest-product-area pb-40 category-list">
					<div class="row"><?php
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
					INNER JOIN `merek` ON `produk`.`id_merek` = `merek`.`id_merek` WHERE produk.id_kategori='$_POST[id_kategori]' AND produk.id_merek = '$_POST[id_merek]' ORDER BY id_produk ");
				
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
				</section>
				</form>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<!-- <div class="button-group-area" align="center">
				<a href="?page=katalog&act=lihatsemua" class="genric-btn primary">Lihat Semua</a><br> <br>
				</div> -->
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!--================End Product Description Area =================-->

<?php

break;

} 
        
?>      