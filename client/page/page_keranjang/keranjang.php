<?php

include "../config/koneksi.php";
error_reporting(0);
session_start(0); 
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../client/index.php'</script>";
}

$id = $_SESSION[namauser];
$sql = mysql_query("SELECT * FROM keranjang, produk WHERE username = '$id' AND keranjang.id_produk = produk.id_produk");
$ketemu = mysql_num_rows($sql);
if($ketemu < 1 ){
	echo "<script>window.alert('Keranjang Belanja Masih Kosong. Silahkan Anda Berbelanja Terlebih Dahulu'); window.location=('?page=katalog')</script>";
} else {

$aksi="page/page_keranjang/aksi_keranjang.php";

?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Keranjang Belanja</h1>
                    <nav class="d-flex align-items-center">
                        <a href="?page=dashboard">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="?page=keranjang">Keranjang Belanja</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <form action="<?php echo"$aksi?page=keranjang&act=update "; ?>" method="POST">
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col" width='15%'>Total</th>
                                <th scope="col">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
                            $id = $_SESSION[namauser];
							$detail = mysql_query("SELECT
                            *
                          FROM
                            `keranjang`
                            INNER JOIN `produk` ON `keranjang`.`id_produk` = `produk`.`id_produk`
                            INNER JOIN `user` ON `keranjang`.`username` = `user`.`username` WHERE user.username = '$id'");
                            $no=1;
							while($r = mysql_fetch_array($detail)){
							echo"
                            <tr>
                                <td>
                                    <h5>$no.</h5>
                                </td>
                                <td>
                                    <div class='media'>
                                        <div class='d-flex'>
                                            <img src='../admin/upload/produk/$r[gambar]' alt='' border='3' height='300' width='200'>
                                        </div>
                                        <div class='media-body'>
                                            <p>$r[produk]</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>Rp. " .number_format($r[harga],0,".", ".");"</h5>";echo"
                                </td>
                                <td>
                                    <div class='product_count'>
										<input type='text' name='qty' id='sst' maxlength='12' value='$r[jumlah]' title='Quantity:'
                                        class='input-text qty' onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\">
                                        <input type='hidden' name='id' value='$r[id_produk]'>
                                        <input type='hidden' name='id_keranjang' value='$r[id_keranjang]'>
                                    </div>
                                </td>
                                ";
                                $total_harga = $r[harga]*$r[jumlah];
                                echo"
                                <td>
                                    <h5>Rp. " .number_format($total_harga,0,".", ".");"</h5>";echo"
                                </td>
                                <td>
                                    <h5><a href='$aksi?page=keranjang&id=keranjang&act=hapus&id=$r[id_keranjang]' class='btn btn-sm red' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-times'></i></a></h5>
                                </td>
                            </tr>";
                            $no++;
							}
							?>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Grand Total</h5>
                                </td>
                                <?php
                                $id = $_SESSION[namauser];
								$total_harga = mysql_query("SELECT * FROM `keranjang` INNER JOIN `produk` ON `keranjang`.`id_produk` = `produk`.`id_produk` WHERE username = '$id'");
								  	while($r=mysql_fetch_array($total_harga)){
                                    $subtotal    = $r[harga]* $r[jumlah];
                                    $total       = $total + $subtotal;
                                    }
								?>
                                <td>
                                <?php
                                echo"
                                    <h5>Rp. " .number_format($total,0,".", ".");"</h5>";echo"
                                ";
                                ?>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                            <td>

</td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="?page=katalog">Pilih Barang Lagi</a>
                                        <a class="primary-btn" href="?page=checkout">Checkout Barang</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    </form>
    <!--================End Cart Area =================-->

<?php
}
?> 