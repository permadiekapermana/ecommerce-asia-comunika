	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Daftar</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=register">Login/Daftar</a>
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
			
				<h3>Registrasi Pengguna Baru</h3> <br><br>
						<form class="row contact_form" action="page/page_login/aksi_register.php" method="post" enctype="multipart/form-data">
									<div class="col-md-7">
										<div class="form-group">
											<h5>Username</h5>
											<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Username'" required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Password</h5>
											<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Password'" required>
											<input type="password" class="form-control" id="password2" name="password2" placeholder="Masukkan Konfirmasi Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Konfirmasi Password'" required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Nama Lengkap</h5>
											<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Nama Lengkap'" required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>E-mail</h5>
											<input type="email" class="form-control" id="email" name="email" placeholder="Masukkan E-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan E-mail'" required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Nomor Handphone</h5>
											<input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor HP" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Nomor HP'" required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Provinsi</h5>
											<select name="id_provinsi" class="form-control" id="pilih-kota" required>
												<option value="">-- Pilih Provinsi --</option>
												<?php
												
												$tampil=mysql_query("SELECT * FROM provinsi ORDER BY id_provinsi");
												while($r=mysql_fetch_array($tampil)){
												  echo "<option value='$r[id_provinsi]'>$r[provinsi]</option>";
												}
												
												?>
											</select>
										</div>
									</div><br>									
									<div class='col-md-7' id="kota"></div>
									<div class="col-md-7">
										<div class="form-group">
											<font color='red'>* Metode pembayaran via COD hanya berlaku untuk pembeli di Kota Cirebon dan Kabupaten Cirebon.</font>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Alamat Lengkap</h5>
											<textarea class="form-control" name="alamat" id="alamat" rows="1" placeholder="Masukkan Alamat Lengkap" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Alamat Lengkap'" required></textarea>
										</div>
									</div>
									<div class="col-md-7 text-left">
										<button type="submit" value="submit" class="primary-btn">Daftar</button>
									</div>
								</form>
					</div>
				</div>
		
	</section>
	<!--================End Login Box Area =================-->

