<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/fungsi_rupiah.php";
              
                   
 echo"  ";     
if ($_GET['page']=='dashboard'){  
    include "page/page_dashboard/dashboard.php";  
}
elseif ($_GET['page']=='login'){  
  include "page/page_login/login.php";  
}
elseif ($_GET['page']=='register'){  
  include "page/page_login/register.php";  
}
elseif ($_GET['page']=='profil'){  
  include "page/page_login/profil.php";  
}
elseif ($_GET['page']=='pdetail'){  
  include "page/page_pdetail/product_detail.php";  
}
elseif ($_GET['page']=='katalog'){  
  include "page/page_katalog/katalog.php";  
}
elseif ($_GET['page']=='keranjang'){  
  include "page/page_keranjang/keranjang.php";  
}
elseif ($_GET['page']=='checkout'){  
  include "page/page_keranjang/checkout.php";  
}
elseif ($_GET['page']=='confirmation'){  
  include "page/page_keranjang/confirmation.php";  
}
elseif ($_GET['page']=='konfirm_bayar'){  
  include "page/page_konfirm/konfirm_bayar.php";  
}
elseif ($_GET['page']=='thanks'){  
  include "page/page_konfirm/thanks.php";  
}
elseif ($_GET['page']=='wait'){  
  include "page/page_transaksi/wait.php";  
}
elseif ($_GET['page']=='hubungi_kami'){  
  include "page/page_kontak/hubungi_kami.php";  
}
elseif ($_GET['page']=='pembelian'){  
  include "page/page_transaksi/pembelian.php";  
}
elseif ($_GET['page']=='riwayat'){  
  include "page/page_transaksi/riwayat.php";  
}
elseif ($_GET['page']=='riwayat_komplain'){  
  include "page/page_transaksi/riwayat_komplain.php";  
}

else{
  echo "<p><b>Halaman Tidak DITEMUKAN</b></p>";
}		
echo"";
?>   
