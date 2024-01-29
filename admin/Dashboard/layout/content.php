<section id="content">
     <?php
     include('article.php');
     include('header.php');
     ?>
     <aside>
          <?php
          if (isset($_GET['action']) && $_GET['query']) {
               $khoitao = $_GET['action'];
               $query = $_GET['query'];
          } else {
               $khoitao = null;
               $query = '';
          }


          if ($khoitao == 'danhmuc' && $query == 'them') {
               include("quanlydanhmuc/add.php");
               include("quanlydanhmuc/lietkedanhmuc.php");
          } elseif ($khoitao == 'danhmuc' && $query == 'edit') {
               include("quanlydanhmuc/edit.php");
          } elseif ($khoitao == 'sanpham' && $query == 'them') {
               include("quanlysanpham/add.php");
               include("quanlysanpham/lietkesanpham.php");
          } elseif ($khoitao == 'sanpham' && $query == 'sua') {
               include("quanlysanpham/editsanpham.php");
          } elseif (isset($_GET['action']) == 'logout' && $query == "") {
               unset($_SESSION['login']);
               echo "<script>alert('Đăng xuất thành công!'); window.location.href='login.php';</script>";
          }

          //elseif ($khoitao == "khachhang") {
          //      include("quanlysanpham/add.php");
          // } elseif ($khoitao == "donhang") {
          //      include("quanlysanpham/add.php");
          // } elseif ($khoitao == "thongke") {
          //      include("quanlysanpham/add.php");
          // } elseif ($khoitao == "logout") {
          //      include("quanlysanpham/add.php");
          // }
          elseif ($khoitao == 'setting' && $query == 'them') {
               include("settings/lietke.php");
          } else {
               include("aside.php");
          }
          ?>
     </aside>
</section>