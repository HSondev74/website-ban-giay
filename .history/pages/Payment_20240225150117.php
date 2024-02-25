<?php

$total_price = 0;
// Tính tổng giá trị của giỏ hàng
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { // Kiểm tra giỏ hàng có tồn tại và không rỗng
     foreach ($_SESSION['cart'] as $item) {
          $total_price += $item['gia'] * $item['soluong'];
     }
}

$phi_van_chuyen = 0;
// Xử lý POST Data
if (isset($_POST['tinh_thanh'])) {
     $tinh_thanh = $_POST['tinh_thanh'];

     // Truy vấn cơ sở dữ liệu để lấy phí vận chuyển tương ứng
     $sql = "SELECT phi FROM phivanchuyen WHERE thanhpho = '$tinh_thanh'";
     $result = mysqli_query($conn, $sql);

     if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $phi_van_chuyen = $row['phi'];
     } else {
          $phi_van_chuyen = 0; // Hoặc bất kỳ giá trị mặc định nào bạn muốn nếu không tìm thấy phí vận chuyển
     }
}


?>
<main id="main">
    <form action="pages/xulythanhtoan.php" method="POST" class="page-payment">
        <div class="column-left-pay">
            <div class="center-img">
                <img src="./images/logo-brand.png" alt="" />
            </div>
            <div class="in4-payment">
                <div class="receiving-in4">
                    <div class="title-receiving">
                        <h2>Thông tin nhận hàng</h2>
                        <!-- <a href=""><i style="margin-right: 8px" class='bx bx-user-circle'></i>Đăng Nhập</a> -->
                        <span style="display:flex; color: red; font-size: 20px; font-weight: 600;"><i
                                style="margin-right: 3px"
                                class='bx bx-user-circle'></i><?php echo $_SESSION['dangnhap']['ten']; ?></span>
                    </div>
                    <div class="form-in4-pay">
                        <input type="email" name="email" placeholder="Email (tùy chọn)" class="inp-pay"
                            required /><br />
                        <input type="text" name="ten" placeholder="Họ tên" class="inp-pay" required /><br />
                        <div class="tel-pay">
                            <input type="tel" name="sodth" placeholder="Số điện thoại" class="inp-pay inp-tel"
                                required />
                            <div class="con">
                                <select>
                                    <option value="vn">VN+84</option>
                                </select>
                            </div>
                        </div>

                        <input type="text" name="tinh_thanh" placeholder="Tỉnh Thành" class="inp-pay" required />
                        <br />
                        <input type="text" name="quan_huyen" placeholder="Quận Huyện" class="inp-pay" required /><br />
                        <input type="text" name="phuong_xa" placeholder="Phường Xã" class="inp-pay" required />
                        <textarea class="inp-pay" name="ghi_chu" placeholder="Ghi chú"
                            style="width: 100%; height: 100px"></textarea>
                    </div>
                </div>
                <div class="shipping-in4">
                    <div class="ship">
                        <h2>Vận Chuyển</h2>
                        <p class="inp-pay span-ship">
                            Vui lòng nhập thông tin giao hàng
                        </p>
                    </div>
                    <br /><br />
                    <div class="payment-methods">
                        <h2>Phương Thức Thanh Toán</h2>
                        <div class="inp-pay">
                            <div class="atm " style="gap:10px;">
                                <input type="radio" id="bank-transfer" name="payment-method" value="chuyển khoản" />
                                <label for="bank-transfer">Chuyển khoản qua ngân hàng</label>
                                <i style=" color: rgb(114, 114, 114);" class='bx bx-credit-card'></i>
                            </div>

                            <div class="atm-banking-in4" style="text-align: center; ">
                                <br>
                                <h4>Thông Tin Chuyển Khoản</h4>
                                <br>
                                <p><b>STK : </b> 1026134501</p>
                                <P><b>Ngân Hàng : </b> Vietcombank</P>
                                <p><b>Tên TK : </b> NGUYEN TIEN DAT</p>
                                <br>
                                <p><b>QR CODE :</b></p>
                                <img src="./images/banking/bankking.jpg" alt="" style="width: 250px; height:250px">
                            </div>
                        </div>
                        <div class="cod inp-pay" style="gap:10px;">
                            <input type="radio" id="cash-on-delivery" name="payment-method"
                                value="thanh toán tiền mặt" />
                            <label for="cash-on-delivery">Thanh toán khi nhận hàng</label>
                            <i style=" color: rgb(114, 114, 114);" class='bx bx-money'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column-right-pay">
            <?php
               // Kiểm tra xem session cart có tồn tại không
               if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $product) {
                         // Lặp qua mỗi sản phẩm trong session cart và hiển thị chúng
               ?>
            <div class="box-prd-pay">
                <div class="img-prd-pay">
                    <img src="<?php echo $product['hinhanh']; ?>" alt="" />
                    <div class="number-prd-pay">
                        <span><?php echo $product['soluong']; ?></span>
                    </div>
                </div>
                <div class="name-prd-pay">
                    <span><?php echo $product['tensp']; ?></span>
                    <br />
                </div>
                <div class="price-prd-pay">
                    <span><?php echo number_format($product['gia'], 0, ',', '.'); ?>đ</span>
                </div>
            </div>
            <?php
                    }
               } else {
                    // Nếu không có sản phẩm trong giỏ hàng, hiển thị thông báo
                    ?>
            <h2>Đơn Hàng (0 sản phẩm)</h2>
            <p>Giỏ hàng của bạn đang trống.</p>
            <?php
               }
               ?>
            <hr class="hr" />
            <!-- <div class="discount-pay">
                    <input type="text" placeholder="Mã giảm giá (nếu có)" />
                    <button>ÁP DỤNG</button>
               </div>
               <br />
               <hr class="hr" /> -->
            <!-- <div class="provisional-fee">
                    <p>Tạm Tính: <span><?php echo number_format($total_price); ?> đ</span></p>
               </div>
               <br />
               <hr class="hr" /> -->
            <div class="total-payment">
                <p>Tổng Cộng: <span><?php echo number_format($total_price + $phi_van_chuyen); ?> đ</span></p>
            </div>
            <br />
            <hr class="hr" />
            <div class="return-to-cart">
                <a href="index.php?action=giohang" class=""><i style="margin-right: 5px"
                        class="icon fa-solid fa-angle-left"></i>Quay về
                    giỏ
                    hàng
                </a>
                <button>Đặt Hàng</button>
            </div>
        </div>
    </form>
</main>