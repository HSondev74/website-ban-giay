<section id="content">
     <?php
     include('article.php');
     include('header.php');
     ?>
     <aside>
          <?php
          if (isset($_GET['action'])) {
               $khoitao = $_GET['action'];
          } else {
               $khoitao = null;
          }

          if(isset($_GET['query']))
          {
               $query = $_GET['query'];
          }
          else
          {
               $query = null;
          }

          if($khoitao == 'sanpham' && !isset($query))
          {
               include("quanlysanpham/lietkesanpham.php");
          }
          elseif($khoitao == 'sanpham' && $query == 'them')
          {
               include("quanlysanpham/add.php");
          }
          elseif($khoitao == 'sanpham' && $query == 'sua')
          {
               include("quanlysanpham/editsanpham.php");
          }
          elseif($khoitao == 'danhmuc' && !isset($query))
          {
               include("quanlydanhmuc/add.php");  
               include("quanlydanhmuc/lietkedanhmuc.php");
          }
          elseif($khoitao == 'danhmuc' && $query == 'edit')
          {
               include("quanlydanhmuc/edit.php");
          }
          elseif($khoitao == 'khachhang' && !isset($query))
          {
               include("quanlykhachhang/edit.php");
          }
          elseif($khoitao == 'donhang' && !isset($query))
          {
               include("quanlydonhang/lietke.php");
          }
          elseif($khoitao == 'donhang' && !isset($query))
          {
               include("quanlythongke/lietke.php");
          }
          elseif($khoitao == 'setting' && !isset($query))
          {
               include("settings/lietke.php");
          }
          elseif($khoitao == 'logout' && !isset($query))
          {
               unset($_SESSION['login']);
               echo "<script>alert('Đăng xuất thành công!'); window.location.href='login.php';</script>";
          }

          // if ($khoitao == 'danhmuc' && $query == 'them') {
          //      // include("quanlydanhmuc/add.php");
          //      // include("quanlydanhmuc/lietkedanhmuc.php");
          // } elseif ($khoitao == 'danhmuc' && $query == 'edit') {
          //      include("quanlydanhmuc/edit.php");
          // } elseif ($khoitao == 'sanpham' && $query == 'sanpham') {
          //      include("quanlysanpham/lietkesanpham.php");
          // }
          // elseif($khoitao == 'sanpham' && $query == 'them')
          // {
          //      include("quanlysanpham/add.php");
          // }
          // elseif ($khoitao == 'sanpham' && $query == 'sua') {
          //      include("quanlysanpham/editsanpham.php");
          // } elseif (isset($_GET['action']) == 'logout' && $query == "") {
          //      unset($_SESSION['login']);
          //      echo "<script>alert('Đăng xuất thành công!'); window.location.href='login.php';</script>";
          // } elseif ($khoitao == "khachhang" && $query == 'them') {
          //      include("quanlykhachhang/edit.php");
          // } elseif ($khoitao == 'setting' && $query == 'them') {
          //      include("settings/lietke.php");
          // } elseif ($khoitao == 'donhang' && $query == 'them') {
          //      include("quanlydonhang/lietke.php");
          // } elseif ($khoitao == 'thongke' && $query == 'them') {
          //      include("quanlythongke/lietke.php");
          // } else {
          //      include("aside.php");
          // }
          // ?>
     </aside>
</section>