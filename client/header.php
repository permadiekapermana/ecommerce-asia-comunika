	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="?page=dashboard"><img src="img/logo.png" width='100%' alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item"><a class="nav-link" href="?page=dashboard">Beranda</a></li>
							<li class="nav-item"><a class="nav-link" href="?page=katalog">Katalog</a></li>
							
							
							
							
							<?php							
							if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
								echo "
								<li class='nav-item'><a class='nav-link' href='?page=hubungi_kami'>Hubungi Kami</a></li>
								<li class='nav-item'><a class='nav-link' href='?page=login'>Login / Daftar</a></li>
								";
							}
							else{
								echo "
								<li class='nav-item submenu dropdown'>
								<a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true'
								 aria-expanded='false'>Transaksi</a>
									<ul class='dropdown-menu'>
										<li class='nav-item'><a class='nav-link' href='?page=pembelian'>Pembelian</a></li>
										<li class='nav-item'><a class='nav-link' href='?page=riwayat'>Riwayat Pembelian</a></li>
										<li class='nav-item'><a class='nav-link' href='?page=riwayat_komplain'>Riwayat Komplain</a></li>
									</ul>
								</li>";
								$id = $_SESSION[namauser];
								$hitung_produk = mysql_query("SELECT COUNT(keranjang.id_produk) AS jumlah_produk FROM keranjang, produk WHERE username = '$id' AND keranjang.id_produk = produk.id_produk");
								$r2=mysql_fetch_array($hitung_produk);
								echo"
								<li class='nav-item'><a href='?page=keranjang' class='nav-link'>Keranjang ($r2[jumlah_produk]) <span class='ti-bag'></span></a></li>
								<li class='nav-item'><a class='nav-link' href='?page=konfirm_bayar'>Konfirmasi Pembayaran</a></li>
								<li class='nav-item'><a class='nav-link' href='?page=hubungi_kami'>Hubungi Kami</a></li>
								<li class='nav-item'><a class='nav-link' href='?page=profil'>Profil</a></li>
								<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>
								";
							}
							?>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!-- End Header Area -->