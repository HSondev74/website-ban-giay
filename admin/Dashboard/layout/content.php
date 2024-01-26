<main>
     <?php
     include('article.php');
     ?>
     <aside>
          <?php
          if (isset($_GET['action'])) {
               $khoitao = $_GET['action'];
          } else {
               $khoitao = null;
          }
          if ($khoitao == 'sanpham') {
               include("quanlysanpham/add.php");
          } elseif ($khoitao == 'danhmuc') {
               include("quanlydanhmuc/add.php");
          } elseif ($khoitao == "khachhang") {
               include("quanlysanpham/add.php");
          } elseif ($khoitao == "donhang") {
               include("quanlysanpham/add.php");
          } elseif ($khoitao == "thongke") {
               include("quanlysanpham/add.php");
          } elseif ($khoitao == "logout") {
               include("quanlysanpham/add.php");
          } else {
               include("aside.php");
          }
          ?>
     </aside>
</main>