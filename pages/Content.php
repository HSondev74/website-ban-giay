<?php

if (isset($_GET['action'])) {
  $khoitao = $_GET['action'];
} else {
  $khoitao = null;
}


if ($khoitao == 'chitietsanpham') {
  include('pages/breadcumb.php');
  include('./pages/Detail.php');
} elseif ($khoitao == 'giohang') {
  include('pages/breadcumb.php');
  include('./pages/Cart.php');
} elseif ($khoitao == 'search') {
  include('pages/breadcumb.php');
  include('./pages/searchProduct.php');
} elseif ($khoitao == 'lienhe') {
  include('pages/breadcumb.php');
  include('./pages/Contact.php');
} elseif ($khoitao == 'sanpham') {
  include('pages/breadcumb.php');
  include('./pages/Store.php');
} elseif ($khoitao == 'kiemtradonhang') {
  include('./pages/InforCommodity.php');
} elseif ($khoitao == 'thanhtoan') {
  include('pages/breadcumb.php');
  include('./pages/Payment.php');
  // if (isset($_SESSION['dangnhap']) && !empty($_SESSION['dangnhap'])) {
  // } else {
  //   echo "<script>
  //   alert('Bạn phải đăng nhập để mua hàng !');
  //   window.location.href = 'index.php?action=login';
  //   </script>";
  // }
} elseif ($khoitao == 'login') {
  include('pages/breadcumb.php');
  include('./pages/Login.php');
} elseif ($khoitao == 'logup') {
  include('pages/breadcumb.php');
  include('./pages/LogUp.php');
} elseif ($khoitao == 'account') {
   if (isset($_SESSION['dangnhap']) && !empty($_SESSION['dangnhap'])) {
    include('pages/breadcumb.php');
    include('./pages/user_page.php');
  } else {
    echo "<script>
    window.location.href = 'index.php';
    </script>";
  }
} 
elseif($khoitao == 'gioithieu'){
  include('pages/breadcumb.php');
  include('./pages/recruitment.php');
}
elseif($khoitao == 'donhang'){
  include('pages/breadcumb.php');
  include('./pages/donhang.php');
}
else {
  include('Home.php');
}
?>

