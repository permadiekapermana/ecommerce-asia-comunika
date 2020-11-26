            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span> Hai, <?php echo" $_SESSION[namalengkap] "; ?>. Anda berhasil Login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <?php
            $tampil_admin = mysql_query("SELECT COUNT(username) AS total_admin FROM admin");
            $r1=mysql_fetch_array($tampil_admin);
            $tampil_kategori = mysql_query("SELECT COUNT(`kategori`.`id_kategori`) AS total_kategori FROM `kategori`");
            $r2=mysql_fetch_array($tampil_kategori);
            $tampil_produk = mysql_query("SELECT COUNT(id_produk) AS total_produk FROM `produk`");
            $r3=mysql_fetch_array($tampil_produk);
            $tampil_orders = mysql_query("SELECT COUNT(id_orders) AS total_orders FROM `orders` WHERE status_order = 'Menunggu Pembayaran' OR status_order = 'Sedang Diproses' OR status_order = 'Sedang Dikirim'");
            $r4=mysql_fetch_array($tampil_orders);
            ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count"><?php echo"$r1[total_admin]"; ?></span>
                        </h4>
                        <p class="text-light">Jumlah <a href="?page=DataAdmin"><font color='white'>Admin</font></a></p>


                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count"><?php echo"$r2[total_kategori]"; ?></span>
                        </h4>
                        <p class="text-light">Jumlah <a href="?page=DataKategori"><font color='white'>Kategori</font></a></p>


                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count"><?php echo"$r3[total_produk]"; ?></span>
                        </h4>
                        <p class="text-light">Jumlah <a href="?page=DataProduk"><font color='white'>Produk</font></a></p>


                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count"><?php echo"$r4[total_orders]"; ?></span>
                        </h4>
                        <p class="text-light">Jumlah <a href="?page=Pembelian"><font color='white'>Pembelian</font></a></p>


                    </div>
                </div>
            </div>
            <!--/.col-->



        </div> <!-- .content -->