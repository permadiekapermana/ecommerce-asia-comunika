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
					<h1>Profil</h1>
					<nav class="d-flex align-items-center">
						<a href="?page=dashboard">Beranda<span class="lnr lnr-arrow-right"></span></a>
						<a href="?page=profil">Profil</a>
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
			
				<h3>Ubah Profil</h3> <br><br>
				<?php
				$user	= mysql_query("SELECT * FROM user WHERE username='$_SESSION[namauser]'");
				$r 		= mysql_fetch_array($user);
				?>
						<form class="row contact_form" action="page/page_login/aksi_profil.php" method="post" enctype="multipart/form-data">
									<div class="col-md-7">
										<div class="form-group">
											<h5>Username</h5>
											<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value='<?php echo"$r[username]"; ?>' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Username'" disabled>
											<input type="hidden" class="form-control" id="username" name="username" placeholder="Masukkan Username" value='<?php echo"$r[username]"; ?>' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Username'">
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
											<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Nama Lengkap'" value='<?php echo"$r[nama_lengkap]"; ?>' required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>E-mail</h5>
											<input type="email" class="form-control" id="email" name="email" placeholder="Masukkan E-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan E-mail'" value='<?php echo"$r[email]"; ?>'' required>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<h5>Nomor Handphone</h5>
											<input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor HP" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Nomor HP'" value='<?php echo"$r[no_hp]"; ?>' required>
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
											<h5>Alamat Lengkap</h5>
											<textarea class="form-control" name="alamat" id="alamat" rows="1" placeholder="Masukkan Alamat Lengkap" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Alamat Lengkap'" required><?php echo"$r[alamat]"; ?></textarea>
										</div>
									</div>
									<div class="col-md-7 text-left">
										<button type="submit" value="submit" class="primary-btn">Ubah Profil</button>
									</div>
								</form>
					</div>
				</div>
		
	</section>
	<!--================End Login Box Area =================-->

