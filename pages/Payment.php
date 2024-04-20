<?php

$total_price = 0;
// Tính tổng giá trị của giỏ hàng
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { // Kiểm tra giỏ hàng có tồn tại và không rỗng
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['gia'] * $item['soluong'];
    }
    $numberOfItems = count($_SESSION['cart']);
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


if (isset($_SESSION['dangnhap'])) {
    $ten = $_SESSION['dangnhap'];
    $selected_thongtinnguoidung = "SELECT * FROM nguoidung WHERE ten = '" . $_SESSION['dangnhap'] . "'";
    $kq = mysqli_query($conn, $selected_thongtinnguoidung);

    if ($kq && mysqli_num_rows($kq) > 0) {
        $cot = mysqli_fetch_assoc($kq);

        $ten = $cot['ten'];
        $diachi = $cot['diachi'];

        if ($diachi) {
            $dia_chi_parts = preg_split('/[-,]\s*/', $diachi);
            $tinh_thanh = $dia_chi_parts[0];
            $quan_huyen = $dia_chi_parts[1];
            $phuong_xa = $dia_chi_parts[2];
        }

        $phone = $cot['sodienthoai'];
    }
}

$tongtien = number_format($total_price + $phi_van_chuyen);



?>
<main id="main" class="container">
    <form action="pages/xulythanhtoan.php" method="POST" class="page-payment">
        <div class="column-left-pay">
            <a href="index.php">
                <div class="center-img">
                    <img src="./images/logo-brand.png" alt="" />
                </div>
            </a>
            <div class="in4-payment">
                <div class="receiving-in4">
                    <div class="title-receiving">
                        <h2>Thông tin nhận hàng</h2>
                        <!-- <a href=""><i style="margin-right: 8px" class='bx bx-user-circle'></i>Đăng Nhập</a> -->

                        <?php if (isset($cot['ten'])) : ?>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class='bx bx-user-circle'>
                                </i>
                                <span><?php echo $cot['ten']; ?></span>
                            </div>
                        <?php else : ?>
                            <div style="display: flex; align-items: center; gap: 5px">
                                <i class='bx bx-user-circle'>
                                </i>
                                <a href="index.php?action=login">Đăng nhập</a>
                            </div>
                        <?php endif; ?>


                    </div>
                    <div class="form-in4-pay">
                        <input type="email" name="email" placeholder="Email" class="inp-pay" required value="<?php echo isset($cot['email']) ? $cot['email'] : '' ?>" /><br />
                        <input type="text" name="ten" placeholder="Họ tên" class="inp-pay" required value="<?php echo isset($cot['ten']) ? $cot['ten'] : '' ?>" /><br />
                        <div class="tel-pay">
                            <input type="tel" name="sodth" placeholder="Số điện thoại" class="inp-pay inp-tel" required value="<?php echo isset($phone) ? $phone : '' ?>" />
                            <div class="con">
                                <select>
                                    <option value="vn">VN+84</option>
                                </select>
                            </div>
                        </div>

                        <input type="text" name="address" placeholder="Địa chỉ" class="inp-pay" required value="<?php echo isset($cot['diachi']) ? $cot['diachi'] : '' ?>">

                        <!-- <input type="text" name="tinh_thanh" placeholder="Tỉnh Thành" class="inp-pay" required value="<?php echo isset($tinh_thanh) ? $tinh_thanh : '' ?>"/>
                        <br />
                        <input type="text" name="quan_huyen" placeholder="Quận Huyện" class="inp-pay" required value="<?php echo isset($quan_huyen) ? $quan_huyen : '' ?>"/><br />
                        <input type="text" name="phuong_xa" placeholder="Phường Xã" class="inp-pay" required value="<?php echo isset($phuong_xa) ? $phuong_xa : '' ?>"/> -->
                        <textarea class="inp-pay node" name="ghi_chu" placeholder="Ghi chú" style="width: 100%; height: 155px"></textarea>
                    </div>
                </div>
                <div class="shipping-in4">
                    <div class="payment-methods">

                        <h2 style="text-align: center;">Phương Thức Thanh Toán</h2>
                        <div class="pay cod inp-pay">
                            <div>
                                <input type="radio" id="cash-on-delivery" name="payment-method" value="Thanh Toán khi nhận hàng" style="cursor: pointer;" required />
                                <label for="cash-on-delivery">Thanh toán khi nhận hàng</label>
                            </div>
                            <i style=" color: rgb(114, 114, 114);" class='icon-money bx bx-money'></i>
                        </div>

                        <div class=" inp-pay">
                            <div class="pay ">
                                <div>
                                    <input type="radio" id="bank-transfer" name="payment-method" value="chuyển khoản qua ngân hàng" style="cursor: pointer;" required />
                                    <label for="bank-transfer">Chuyển khoản qua ngân hàng</label>
                                </div>
                                <i style=" color: rgb(114, 114, 114);" class='icon-money bx bx-credit-card'></i>
                            </div>

                            <div class="atm-banking-in4" style="text-align: center; ">
                                <br>
                                <p><b>STK : </b> 05629916701</p>
                                <P><b>Ngân Hàng : </b> TPBank</P>
                                <p><b>Tên TK : </b> NGUYEN DUC HIEU</p>
                                <br>
                                <!-- <p><b>QR CODE :</b></p>
                                <img src="./images/banking/bankking.jpg" alt=""
                                    style="width: 250px; height:250px ;border: 1px solid #cfcfcf"> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="column-right-pay">
            <h3 style="padding: 15px 0;"><?php echo isset($numberOfItems) ? "Đơn hàng ($numberOfItems sản phẩm)" : "Đơn hàng (0 sản phẩm)"; ?></h3>
            <hr>
            <br>
            <div class="pay-products">
                <?php
                // Kiểm tra xem session cart có tồn tại không
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    // echo 'asdasd';
                    foreach ($_SESSION['cart'] as $product) {
                        $images = explode(',', $product['hinhanh']);
                        if (!empty($images)) {
                            $first_image = $images[0];
                            $second_image = isset($images[1]) ? $images[1] : $images[0];
                        }
                        // Lặp qua mỗi sản phẩm trong session cart và hiển thị chúng
                ?>
                        <div class="box-prd-pay">
                            <div class="img-prd-pay">
                                <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image; ?>" alt="" />
                                <div class="number-prd-pay">
                                    <span><?php echo $product['soluong']; ?></span>
                                </div>
                            </div>
                            <div class="name-prd-pay">
                                <span><?php echo $product['tensp']; ?></span>
                                <span class="">(<?php echo $product['size']; ?>)</span>
                                <br />
                            </div>
                            <div class="price-prd-pay">
                                <span><?php echo number_format($product['gia'] * $product['soluong'], 0, ',', '.'); ?> đ</span>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    // Nếu không có sản phẩm trong giỏ hàng, hiển thị thông báo
                    ?>
                    <!-- <h2>Đơn Hàng (0 sản phẩm)</h2> -->
                    <p>Giỏ hàng của bạn đang trống.</p>
                <?php
                }
                ?>
            </div>

            <br>
            <hr>
            <br>
            <div class="count-payment">
                <p class="count tamtinh">Tạm tính <span><?php echo number_format($total_price) ?> đ</span></p>
                <p class="count phivanchuyen">Phí vận chuyển <span>_</span></p>
            </div>
            <br>
            <hr class="hr" />
            <div class="total-payment">
                <p>Tổng Cộng: <span><?php echo $tongtien ?> đ</span></p>
            </div>
            <div class="return-to-cart">
                <a href="index.php?action=giohang" class=""><i style="margin-right: 5px" class="icon fa-solid fa-angle-left"></i>Quay về
                    giỏ
                    hàng
                </a>
                <input type="submit" name="dathang" class="order" value="Đặt Hàng">
            </div>
        </div>
    </form>
</main>