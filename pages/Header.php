<header class="umine-top">
        <div class="navbar" >
            <p class="navbar-left" style="color: white;">
                Mọi đơn hàng khi mua đều được <span style="color: red">FreeShip</span> ! <a href="index.php?action=sanpham" class="underline" style="color: white;">xem
                    thêm</a>
            </p>
            <!-- <p class="navbar-left" style="color: white;">
                Bạn là Học Sinh hay Sinh Viên được <span style="color: red">GIẢM GIÁ NGAY
                    20%</span> ! <a href="index.php?action=sanpham" class="underline" style="color: white;">xem
                    thêm</a>
            </p> -->
            <div class="nav-space"></div>
        </div>

    <div class="map">
        <div class="show-map">
            <div class="address-show">
                <h3>Địa chỉ cửa hàng</h3>
                <div class="close-map">x</div>
            </div>
            <div class="img-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.70066492663!2d105.7470029747149!3d21.04465988723339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454edcdbc166f%3A0xa9f96e0cf23b6dc4!2zTmcuIDE3NyDEkC4gQ-G6p3UgRGnhu4VuLCBLaeG7gXUgTWFpLCBQaMO6YyBEaeG7hW4sIELhuq9jIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1708398620880!5m2!1svi!2s"
                    width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <!-- header-search-wrapper -->
    <div class="container-wrapper header-search-wrapper">
        <div class=" flex-header v-center">
            <i class="fa-solid fa-bars"></i>
            <a href="index.php" class="header-search__logo-section">
                    <div class="header-search__logo-wrapper">
                        <img src="./images/logo-brand.png" alt="logo">
                    </div>
            </a>

            <form role="search" autocomplete="off" action="index.php?action=search" method="POST" class="umine-searchbar">
                <input class="umine-searchbar-input__input" maxlength="128" placeholder="Tìm kiếm sản phẩm..." autocomplete="off" aria-expanded="false" role="combobox" value="" name="keyword">
                <button type="submit" name="searchHeader" class="umine-searchbar-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>


            <div class="header-search-cart flex v-center">

                <div class="header-location">
                    <i class='bx bx-map'></i>

                    <div class="chia">
                        <div class="title-map" >Địa chỉ</div>
                        <div class="flex-title">
                            <div class="title-map">cửa hàng</div> 
                            <i style="font-size: 20px;" class='bx bx-chevron-down'></i>
                        </div>
                    </div>
                </div>

                <div class="header-search-cart-account">
                    <?php if (isset($_SESSION['dangnhap']) && !empty($_SESSION['dangnhap'])) : ?>
                    <div class="account-icon">
                        <nav style=" color: black;">   
                            <i class='bx bx-user' ></i>
                        </nav>
                        <div class="accc" >
                            <!-- <a class="info-login" href="/bangiay/pages/logout.php">
                                <p><?php echo $_SESSION['dangnhap']; ?></p>
                                <a href="pages/logout.php" style="color: #000; font-weight: 700; ">Đăng
                                    xuất
                            </a> -->
                            <p>Hi</p>
                            <p><?php echo $_SESSION['dangnhap']; ?></p>
                        </div>
                        </a>

                    </div>
                    <?php else : ?>

                    <div class="account-icon">
                        <i class='bx bx-user'></i>
                        
                    </div>

                    <div class="account-title">
                        <p>Đăng nhập</p>
                        <p>Đăng ký</p>
                    </div>


                    
                    <?php endif; ?>

                    <?php if (isset($_SESSION['dangnhap']) && !empty($_SESSION['dangnhap'])) : ?>


                    <div class="box-show-acc">
                        <!-- <div class="name-acc">
                                Hi <?php echo $_SESSION['dangnhap']; ?> !
                        </div> -->
                        <div class="show-acc">
                                <a class="title-log" href="index.php?action=account&view=account">Xem chi tiết</a>
                                <a class="title-log" href="pages/logout.php" >Đăng xuất </a>
                        </div>
                    </div>

                    
                    <?php else : ?>
                        
                        
                        <div class="box-show-acc">
                                <div class="show-acc">
                                    <a class="title-log" href="index.php?action=login">Đăng nhập</a>
                                    <a class="title-log" href="index.php?action=logup">Đăng ký</a>
                                </div>
                        </div>

                    <?php endif; ?>
                    
                </div>
                
                <!-- <div class="header-favorites">
                    <span class="favorite">0</span>
                    <i class='bx bx-heart'></i>
                </div> -->

                <a href="./index.php?action=giohang" class="header-cart flex v-center">
                    <?php
                    // Kiểm tra xem session 'cart' có tồn tại không
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        $cart = $_SESSION['cart'];
                        $totalItems = count($_SESSION['cart']);
                        $totalPrice = 0;
                    
                        // Tính tổng số lượng các mục trong session và tổng giá tiền của giỏ hàng
                        foreach ($cart as $item) {
                            $totalPrice += $item['gia'] * $item['soluong'];
                        }
                        ?>
                        <div class="carts">
                            <span class="cart"><?php echo $totalItems; ?></span>
                            <i class='bx bx-cart'></i>
                        </div>
                        <div class="cart-price">
                            <p>Your Cart</p>
                            <strong><?php echo number_format($totalPrice) . " VNĐ" ?></strong>
                        </div>
                    <?php } else { ?>
                        <div class="carts">
                            <span class="cart">0</span>
                            <i class='bx bx-cart'></i>
                        </div>
                        <div class="cart-price">
                            <p>Your Cart</p>
                            <strong>0 VNĐ</strong>
                        </div>
                    <?php } ?>
                </a>

            </div>
        </div>
    </div>

    <ul class="search-list-select ">
        <li><a href="index.php">TRANG CHỦ</a></li>
        <li><a href="index.php?action=sanpham">SẢN PHẨM</a>
            <ul class="sub-menu">
            <li><a href="index.php?action=sanpham">Tất cả sản phẩm</a></li>
            <?php
            $sql_categories = "SELECT * FROM danhmuc";
            $result_categories = mysqli_query($conn, $sql_categories);

            // Kiểm tra xem có dữ liệu từ câu truy vấn hay không
            if(mysqli_num_rows($result_categories) > 0) {
                // Duyệt qua từng phần tử trong kết quả truy vấn và in ra
                while($row = mysqli_fetch_assoc($result_categories)) {
                    ?>
                    <li><a href="index.php?action=sanpham&category=<?php echo $row['danhmuc_id']; ?>"><?php echo $row['tendanhmuc']; ?></a></li>
                    <?php
                }
            }
            ?>
            </ul>

        </li>
        <li><a href="index.php?action=lienhe">LIÊN HỆ</a></li>
        <!-- <li><a href="index.php?action=gioithieu">TUYỂN DỤNG</a></li> -->
        <li>
            <a href="index.php?action=giohang">GIỎ HÀNG</a>
        </li>
        <!-- <li><a href="" class="strong">Mua ngay với những sản phẩm giảm lên đến 50%</a></li> -->
    </ul>

    <div class="drop-down">
    <div class="close-drop-down-menu"><i class="fa-solid fa-x"></i></div>
    <ul class="drop-down-menu">
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="index.php?action=sanpham">Cửa Hàng</a>
            <!-- <i class='bx bx-chevron-down'></i> -->
            <!-- <ul class="dropmenu">
                    <li><a href="">ADIDAS</a></li>
                    <li><a href="">NIKE</a></li>
                    <li><a href="">NEW BALANCE</a></li>
               </ul> -->
        </li>
        <li><a href="index.php?action=lienhe">Liên Hệ </a></li>
        <li><a href="index.php?action=gioithieu">Tuyển Dụng </a></li>
        <li>
            <a href="index.php?action=giohang">Giỏ Hàng</a>
        </li>
        <li><a href="" class="strong">Mua ngay với những sản phẩm giảm lên đến 50%</a></li>
    </ul>
    </div>


</header>

