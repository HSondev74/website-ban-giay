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
} else {
  include('Home.php');
}
