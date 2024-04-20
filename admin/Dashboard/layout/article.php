<?php
$action = isset($_GET['action']) ? $_GET['action'] : ''; // Lấy giá trị của biến action từ URL

// Mảng chứa các action tương ứng với lớp active
$active_actions = array(
    'sanpham',
    'danhmuc',
    'khachhang',
    'donhang',
    'thongke',
    'setting',
    'logout'
);

// Kiểm tra xem action có trong danh sách các action cần kích hoạt không
$ref = (in_array($action, $active_actions)) ? $action : 'trangchu'; // Nếu không tìm thấy thì mặc định là trang chủ
?>

<section id="sidebar">
     <a href="#" class="brand">
          <i class='bx bxs-smile'></i>
          <span class="text">
               <img src="../images/logo-brand.png" alt="">
          </span>
     </a>
     <ul class="side-menu top">
          <li class="<?php echo ($ref == 'trangchu') ? 'active' : ''; ?>">
               <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Trang Chủ</span>
               </a>
          </li>
          <li class="<?php echo ($ref == 'sanpham') ? 'active' : ''; ?>">
               <a href="index.php?action=sanpham">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Sản phẩm</span>
               </a>
          </li>
          <li class="<?php echo ($ref == 'danhmuc') ? 'active' : ''; ?>">
               <a href="index.php?action=danhmuc">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Danh mục</span>
               </a>
          </li>
          <li class="<?php echo ($ref == 'khachhang') ? 'active' : ''; ?>">
               <a href="index.php?action=khachhang">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Khách hàng</span>
               </a>
          </li>
          <li class="<?php echo ($ref == 'donhang') ? 'active' : ''; ?>">
               <a href="index.php?action=donhang">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Đơn hàng</span>
               </a>
          </li>
          <!-- <li class="<?php echo ($ref == 'thongke') ? 'active' : ''; ?>">
               <a href="index.php?action=thongke">
                    <i class='bx bxs-group'></i>
                    <span class="text">Thống Kê</span>
               </a>
          </li> -->
     </ul>
     <ul class="side-menu">
          <!-- <li class="<?php echo ($ref == 'setting') ? 'active' : ''; ?>">
               <a href="index.php?action=setting">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
               </a>
          </li> -->
          <li class="<?php echo ($ref == 'logout') ? 'active' : ''; ?>">
               <a href="index.php?action=logout" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Đăng Xuất</span>
               </a>
          </li>
     </ul>
</section>
