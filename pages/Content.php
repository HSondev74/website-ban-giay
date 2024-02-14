<?php

if (isset($_GET['action']) && $_GET['query']) {
  $khoitao = $_GET['action'];
  $query = $_GET['query'];
} else {
  $khoitao = null;
  $query = '';
}


if ($khoitao == 'gioithieu') {
} else {
  include('Home.php');
}
