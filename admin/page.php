<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/fungsi_rupiah.php";
              
                   
 echo"  ";     
if ($_GET['page']=='Dashboard'){  
    include "page_dashboard/dashboard.php";  
}
elseif ($_GET['page']=='DataAdmin'){  
  include "page_admin/admin.php";  
}
elseif ($_GET['page']=='DataPengguna'){  
  include "page_pengguna/pengguna.php";  
}
elseif ($_GET['page']=='DataProvinsi'){  
  include "page_provinsi/provinsi.php";  
}
elseif ($_GET['page']=='DataKota'){  
  include "page_kota/kota.php";  
}
elseif ($_GET['page']=='DataBank'){  
  include "page_bank/bank.php";  
}
elseif ($_GET['page']=='Kategori'){  
  include "page_kategori/kategori.php";  
}
elseif ($_GET['page']=='Merek'){  
  include "page_merek/Merek.php";  
}
elseif ($_GET['page']=='Produk'){  
  include "page_produk/produk.php";  
}
elseif ($_GET['page']=='RekomendasiProduk'){  
  include "page_rekomendasi/rekomendasi.php";  
}
elseif ($_GET['page']=='Pembelian'){  
  include "page_transaksi/pembelian.php";  
}
elseif ($_GET['page']=='RiwayatPembelian'){  
  include "page_transaksi/riwayat.php";  
}
elseif ($_GET['page']=='Komplain'){  
  include "page_transaksi/komplain.php";  
}
elseif ($_GET['page']=='RiwayatKomplain'){  
  include "page_transaksi/riwayat_komplain.php";  
}

else{
  echo "<p><b>Halaman Tidak DITEMUKAN</b></p>";
}		
echo"";
?>   
