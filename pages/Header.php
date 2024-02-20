<header class="umine-top">
     <div class="navbar-wrapper contaner-wrapper" style="background-color: #333; color: white;">
          <div class="container navbar" style="padding-bottom: 5px;">
               <p class="navbar-left" style=" color: white;">
                    Bạn là một Học Sinh hay Sinh Viên GIẢM GIÁ NGAY 20% ! <a href="index.php?action=cuahang"
                         class="underline" style=" color: white;">xem
                         thêm</a>
               </p>
               <div class="nav-space"></div>
               <ul class="navbar__links flex v-center">
                    <li>
                         <a style=" color: white;" href="">Địa Chỉ Cửa Hàng</a>
                    </li>
                    <li>
                         <a style=" color: white;" href="https://i.ghtk.vn/">Vấn Đề Vận Chuyển</a>
                    </li>
                    <!-- <li>
                         <a href="">FAQs</a>
                    </li> -->
               </ul>
          </div>
     </div>
     <div class="line"></div>
     <!-- header-search-wrapper -->
     <div class="container-wrapper header-search-wrapper">
          <div class="container flex-between v-center">
               <a href="" class="header-search__logo-section">
                    <div class="header-search__logo-wrapper">
                         <img src="./images/logo-brand.png" alt="logo">
                    </div>
               </a>
               <div class="header-search__input-section">
                    <form role="search" autocomplete="off" action="index.php?action=search" method="POST"
                         class="umine-searchbar">
                         <div class="umine-select-categories">
                              <select name="Categories">
                                   <option value="" selected>Toàn Bộ Hãng</option>
                                   <?php
                                   // Truy vấn cơ sở dữ liệu để lấy danh sách các danh mục
                                   $sql_categories = "SELECT * FROM danhmuc";
                                   $result_categories = mysqli_query($conn, $sql_categories);

                                   // Kiểm tra xem có danh sách danh mục không
                                   if (mysqli_num_rows($result_categories) > 0) {
                                        // Duyệt qua từng danh mục và tạo các tùy chọn cho trường select
                                        while ($category = mysqli_fetch_assoc($result_categories)) {
                                   ?>
                                   <option value="<?php echo $category['danhmuc_id']; ?>">
                                        <?php echo $category['tendanhmuc']; ?></option>
                                   <?php
                                        }
                                   }
                                   ?>
                              </select>
                         </div>
                         <div class="h-line-searchbar"></div>
                         <div class="umine-searchbar__main">
                              <div class="umine-searchbar-input"><input class="umine-searchbar-input__input"
                                        maxlength="128" placeholder="Tìm kiếm hơn 200+ sản phẩm..." autocomplete="off"
                                        aria-expanded="false" role="combobox" value="" name="keyword">
                              </div>
                         </div><button type="submit" name="searchHeader" class="umine-searchbar-button"
                              style="cursor: pointer;">
                              Tìm Kiếm
                         </button>
                    </form>
               </div>
               <div class="header-search-cart flex v-center">
                    <div class="header-search-cart-account flex">
                         <div class="account-icon">
                              <i class='bx bx-user'></i>
                         </div>
                         <div class="account-title">
                              <a class="account-title-login" href="index.php?action=login">Đăng nhập</a>
                              <p class="account-title-acc">Tài khoản</p>
                         </div>
                    </div>

                    <div class="header-favorites">
                         <span class="favorite">0</span>
                         <i class='bx bx-heart'></i>
                    </div>

                    <a href="./index.php?action=giohang" class="header-cart flex v-center">
                         <?php
                         // Kiểm tra xem session 'cart' có tồn tại không
                         if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                              // Kiểm tra xem session 'cart' có rỗng không
                              if (!empty($_SESSION['cart'])) {
                                   $cart = $_SESSION['cart'];
                                   $totalItems = count($_SESSION['cart']);
                                   // Tính tổng số lượng các mục trong session
                         ?>
                         <div class="carts">
                              <span class="cart"><?php echo $totalItems; ?></span>
                              <i class='bx bx-cart'></i>
                         </div>
                         <?php
                              } else {
                              ?>
                         <div class="carts">
                              <span class="cart">0</span>
                              <i class='bx bx-cart'></i>
                         </div>
                         <?php
                              }

                              $totalPrice = 0;
                              foreach ($cart as $item) {
                                   $totalPrice += $item['gia'] * $item['soluong'];
                              }
                              ?>
                         <div class="cart-price">
                              <p>Your Cart</p>
                              <strong><?php echo number_format($totalPrice) . " VNĐ" ?></strong>
                         </div>
                         <?php
                         } else {
                         ?>
                         <div class="carts">
                              <span class="cart">0</span>
                              <i class='bx bx-cart'></i>
                         </div>
                         <div class="cart-price">
                              <p>Your Cart</p>
                              <strong>0 VNĐ</strong>
                         </div>
                         <?php
                         }
                         ?>
                    </a>


               </div>
          </div>


     </div>
     <div class="line"></div>

     <ul class="container search-list-select">
          <li><a href="index.php">Trang Chủ</a></li>
          <li><a href="index.php?action=cuahang">Cửa Hàng</a>
               <!-- <i class='bx bx-chevron-down'></i> -->
               <!-- <ul class="dropmenu">
                    <li><a href="">ADIDAS</a></li>
                    <li><a href="">NIKE</a></li>
                    <li><a href="">NEW BALANCE</a></li>
               </ul> -->
          </li>
          <li><a href="index.php?action=lienhe">Liên Hệ </a></li>
          <li><a href="index.php?action=gioithieu">Giới Thiệu </a></li>
          <li><a href="index.php?action=kiemtradonhang">Kiểm tra đơn hàng </a></li>
          <li><a href="" class="strong">Mua ngay với những sản phẩm giảm lên đến 50%</a></li>
     </ul>

     <div class="line"></div>
</header>