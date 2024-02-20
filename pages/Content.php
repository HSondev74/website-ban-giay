<?php

if (isset($_GET['action'])) {
  $khoitao = $_GET['action'];
} else {
  $khoitao = null;
}


if ($khoitao == 'chitietsanpham') {
  include('./pages/chitietsanpham.php');
} elseif ($khoitao == 'giohang') {
  include('./pages/Cart.php');
} elseif ($khoitao == 'search') {
  include('./pages/searchProduct.php');
} elseif ($khoitao == 'lienhe') {
  include('./pages/Contact.php');
} elseif ($khoitao == 'cuahang') {
  include('./pages/Store.php');
} elseif ($khoitao == 'kiemtradonhang') {
  include('./pages/InforCommodity.php');
} elseif ($khoitao == 'thanhtoan') {
  include('./pages/Payment.php');
} elseif ($khoitao == 'login') {
  include('./pages/Login.php');
} else {
  include('Home.php');
}
