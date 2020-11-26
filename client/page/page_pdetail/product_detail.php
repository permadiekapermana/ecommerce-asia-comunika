
<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_kalender.php";
include "../../../config/library.php";

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

$pel2="KMNT.";
$y2=substr($pel2,0,4);
$query2=mysql_query("select * from komentar where substr(id_komentar,1,4)='$y2' order by id_komentar desc limit 0,1");
$row2=mysql_num_rows($query2);
$data2=mysql_fetch_array($query2);
if ($row2>0){
$no2=substr($data2['id_komentar'],-6)+1;}
else{
$no2=1;
}
$nourut2=1000000+$no2;
$nopel2=$pel2.substr($nourut2,-6);

$pel3="BKMN.";
$y3=substr($pel3,0,4);
$query3=mysql_query("select * from komentar_balas where substr(id_balas,1,4)='$y3' order by id_balas desc limit 0,1");
$row3=mysql_num_rows($query3);
$data3=mysql_fetch_array($query3);
if ($row3>0){
$no3=substr($data3['id_balas'],-6)+1;}
else{
$no3=1;
}
$nourut3=1000000+$no3;
$nopel3=$pel3.substr($nourut3,-6);

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

	<!--================Single Product Area =================-->
	<form action="<?php echo" $aksi?page=pdetail&act=input "; ?>" method="POST">
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
							<img class="img-fluid" src="../admin/upload/produk/<?php echo"$r[gambar]";?>" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="../admin/upload/produk/<?php echo"$r[gambar]";?>" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="../admin/upload/produk/<?php echo"$r[gambar]";?>" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?php echo"$r[produk]"; ?></h3>
						<h2>Rp. <?php echo"" .number_format($r[harga],0,".", ".");""; ?></h2>
						<ul class="list">
							<li><a href="#"><span>Kategori</span> : <?php echo"$r[kategori]";?></a></li>
							<li><a href="#"><span>Stok</span> : <?php echo"$r[stok]";?></a></li>
						</ul>
						<?php
					$deskripsi_produk = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
					$des = mysql_fetch_array($deskripsi_produk);
					echo"
					<p>$des[deskripsi]</p>
					";
					?>
						<div class="product_count">
							<label for="qty">Jumlah :</label> 
							<input type="hidden" value="<?php echo"$nopel"; ?>" name='id_keranjang'>
							<input type="hidden" value="<?php echo"$_SESSION[namauser]"; ?>" name='username'>
							<input type="hidden" value="<?php echo"$r[id_produk]"; ?>" name='id_produk'>
							<input type="text" name="jumlah" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
							 class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
							 class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>						
						<?php
						
						if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
						echo "
						<div class='card_area d-flex align-items-center'>
							<a class='primary-btn' href='#' onClick='loginDulu()'>Tambah Keranjang</a>
						</div>	";
						}
						else{
						echo"										
						<div class='card_area d-flex align-items-center'>
							<button type='submit' class='primary-btn'>Tambah Keranjang</button>
						</div>";
						}
									
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Deskripsi Produk</a>
				</li>
				<!-- <li class="nav-item active">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
					 aria-selected="false">Komentar</a>
				</li> -->
				<!-- <li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
					 aria-selected="false">Penilaian</a>
				</li> -->
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<?php
					$deskripsi_produk = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
					$des = mysql_fetch_array($deskripsi_produk);
					echo"
					<p>$des[deskripsi]</p>
					";
					?>
				</div>				
				<div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row">						
						<div class="col-lg-6">
							<div class="comment_list">
								<?php
								$komentar = mysql_query("SELECT * FROM komentar WHERE id_produk='$_GET[id]'");
								while($ko = mysql_fetch_array($komentar)){					
						
								?>
								<div class="review_item">
									<div class="media">
										<!-- <div class="d-flex">
											<img src="img/product/img_user.png" alt="">
										</div> -->
										<div class="media-body">
											<h4><?php echo"$ko[nama_lengkap]"; ?></h4>
											<h5><?php echo"$ko[tgl]"; ?></h5>
											<?php
											if($ko['nama_lengkap']==$_SESSION[namalengkap]){
											echo"
											<a href='$aksi?page=pdetail&act=hapuscomment&id=$ko[id_komentar]' class='reply_btn' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><font color='red'>X</font></a>
											";
											}
											?>
										</div>
									</div>
									<p><?php echo"$ko[komentar]"; ?></p>
									</div>
									<form action="<?php echo"$aksi?page=pdetail&act=commentbalas "; ?>" method='POST'>						
									<div class="form-group">
										<textarea class="form-control" name="message" id="message" rows="1" placeholder="Tulis Balasan Komentar"></textarea>
										<input type="hidden" class="form-control" id="name" value='<?php echo"$_SESSION[namalengkap]"; ?>' name="name" placeholder="Your Full name">
										<input type="hidden" class="form-control" id="name" value='<?php echo"$ko[id_komentar]"; ?>' name="id_komentar" placeholder="Your Full name">
										<input type="hidden" class="form-control" id="name" value='<?php echo"$_GET[id]"; ?>' name="id_produk" placeholder="Your Full name">
										<input type="hidden" id="name" value='<?php echo"$tgl_sekarang"; ?>' name="tgl" placeholder="Your Full name">
										<input type="hidden" class="form-control" id="name" value='<?php echo"$nopel3"; ?>' name="id_balas" placeholder="Your Full name">
										<div class="review_item reply">
										<div class="media">
											<div class="media-body">
												<button type='submit' class="reply_btn" href="#">Reply</button>
											</div>
										</div>
										</div>
									</div>
									</form>
									<br>
								
								<?php
								$komentar_balas = mysql_query("SELECT * FROM komentar_balas WHERE id_komentar='$ko[id_komentar]'");
								$ketemu=mysql_num_rows($komentar_balas);

								if ($ketemu > 0){

								while($koo = mysql_fetch_array($komentar_balas)){		
						
								?>
								<div class="review_item reply">
									<div class="media">
										<!-- <div class="d-flex">
											<img src="img/product/review-2.png" alt="">
										</div> -->
										<div class="media-body">
											<h4><?php echo"$koo[nama_lengkap]"; ?></h4>
											<h5><?php echo"$koo[tgl]"; ?></h5>
										</div>
									</div>
									<p><?php echo"$koo[komentar]"; ?></p>								
								</div>
									
								<?php
								}
								?>
								<form action="<?php echo"$aksi?page=pdetail&act=commentbalas "; ?>" method='POST'>
								<div class="review_item reply">
									<textarea class="form-control" name="message" id="message" rows="1" placeholder="Tulis Balasan Komentar"></textarea>
									<input type="hidden" class="form-control" id="name" value='<?php echo"$_SESSION[namalengkap]"; ?>' name="name" placeholder="Your Full name">
										<input type="hidden" class="form-control" id="name" value='<?php echo"$ko[id_komentar]"; ?>' name="id_komentar" placeholder="Your Full name">
										<input type="hidden" class="form-control" id="name" value='<?php echo"$_GET[id]"; ?>' name="id_produk" placeholder="Your Full name">
										<input type="hidden" id="name" value='<?php echo"$tgl_sekarang"; ?>' name="tgl" placeholder="Your Full name">
										<input type="hidden" class="form-control" id="name" value='<?php echo"$nopel3"; ?>' name="id_balas" placeholder="Your Full name">
									<div class="review_item reply">
									<div class="media">
										<div class="media-body">
										<button type='submit' class="reply_btn" href="#">Reply</button>
										</div>
									</div>
									</div>
								</div>
								</form><br>
								<br>
								<?php
								}
								?>
								<?php
								}
								?>
							</div>
						</div>
						
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Post Komentar</h4>
								<form class="row contact_form" action="<?php echo"$aksi?page=pdetail&act=comment "; ?>" method="post" id="contactForm">
									<div class="col-md-12">
										<div class="form-group">
											<h6>User</h6>
											<input type="text" class="form-control" id="name" value='<?php echo"$_SESSION[namalengkap]"; ?>' name="name" placeholder="Your Full name" disabled>
											<input type="hidden" class="form-control" id="name" value='<?php echo"$_SESSION[namalengkap]"; ?>' name="name" placeholder="Your Full name">
											<input type="hidden" class="form-control" id="name" value='<?php echo"$nopel2"; ?>' name="id_komentar" placeholder="Your Full name">
											<input type="hidden" class="form-control" id="name" value='<?php echo"$_GET[id]"; ?>' name="id_produk" placeholder="Your Full name">
											<input type="hidden" id="name" value='<?php echo"$tgl_sekarang"; ?>' name="tgl" placeholder="Your Full name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<h6>Komentar</h6>
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" value="submit" class="btn primary-btn">Submit Now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4>4.0</h4>
										<h6>(03 Reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on 3 Reviews</h3>
										<ul class="list">
											<li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="review_list">
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-1.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-2.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-3.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Add a Review</h4>
								<p>Your Rating:</p>
								<ul class="list">
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
								</ul>
								<p>Outstanding</p>
								<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Full name'">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" value="submit" class="primary-btn">Submit Now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
<?php
			  
break;

case "tambahjabatan":
echo "";

break; 
  
case "editjabatan":
 
echo "";

break;

} 
        
?>      