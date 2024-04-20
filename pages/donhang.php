<main id="main" class="container">
    <span class="title-frame">Đơn hàng của bạn</span>
    <h1>Thông tin người nhận</h1>
    <?php
    if (isset($_GET['id_donhang'])) {
        $id = $_GET['id_donhang'];
        $sql = "SELECT * FROM donhang WHERE id_donhang = $id";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        if ($row) {
            $ten = $row['ten'];
            $sdt = $row['sodienthoai'];
            $diachi = $row['diachi'];
            $ngaydat = $row['ngaydat'];
            $tongtien = $row['tongtien'];
            $payment = $row['hinhthucthanhtoan'];
        }

        // Lấy thông tin chi tiết đơn hàng
        $sql = "SELECT * FROM chitietdonhang WHERE id_donhang = $id";
        $query = mysqli_query($conn, $sql);
        
        // Kiểm tra xem có hàng trả về hay không
        if (mysqli_num_rows($query) > 0) {
            // Hiển thị thông tin người nhận
            ?>
            <div class="donhang">
                <div class="fe donhang-name"><span class="booo">Tên:</span> <?php echo $ten ?></div>
                <div class="fe donhang-phone"><span class="booo">Số điện thoại:</span> <?php echo $sdt ?></div>
                <div class="fe donhang-diachi"><span class="booo">Địa chỉ:</span> <?php echo $diachi ?></div>
                <div class="fe donhang-ngaydat"><span class="booo">Ngày đặt:</span> <?php echo $ngaydat ?></div>
                <div class="fe donhang-Payment-methods"><span class="booo">Phương thức thanh toán:</span> <?php echo $payment ?></div>
                <!-- <div class="fe donhang-trangthai"><span class="booo">Trang thái: </span>Đang xác nhận </div> -->
            </div>
            <?php
            
            // Bắt đầu vòng lặp để hiển thị thông tin sản phẩm
            ?>
            <div class="frame-prd-cart">
                <table>
                    <tr>
                        <th align="left">Sản Phẩm</th>
                        <th align="left">Đơn Giá</th>
                        <th align="left">Số Lượng</th>
                        <th align="left">Thành Tiền</th>
                    </tr>
                    <?php
                    // Lặp qua tất cả các hàng kết quả trả về từ truy vấn
                    while ($row2 = mysqli_fetch_assoc($query)) {
                        $soluong = $row2['soluong'];
                        $thanhtien = $row2['tongtien'];
                        $size = $row2['size'];
                        $sanpham_id = $row2['sanpham_id'];
                        
                        // Lấy thông tin sản phẩm từ bảng sản phẩm
                        $sql = "SELECT * FROM sanpham WHERE sanpham_id = $sanpham_id";
                        $query_sanpham = mysqli_query($conn, $sql);
                        $row3 = mysqli_fetch_assoc($query_sanpham);
                        
                        if ($row3) {
                            $tensp = $row3['tensanpham'];
                            $hinhanh = explode(',', $row3['hinhanh']);
                            $first_image = $hinhanh[0];
                            $gia = $row3['gia'];
                            
                            // Hiển thị thông tin sản phẩm
                            ?>
                            <tr>
                                <td>
                                    <div class="in4-prd-cart">
                                        <div class="img-prd-cart">
                                            <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image; ?>" alt="" />
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                            <div class="name-prd-cart">
                                                <span><a href="" class="name-prd-link-cart"><?php echo $tensp ?></a></span><br />
                                                <span>Size: <?php echo $size ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php echo number_format($gia); ?>đ
                                </td>
                                <td>
                                    <?php echo $soluong; ?>
                                </td>
                                <td>
                                    <span class="sum-pay-color"><?php echo number_format($thanhtien); ?>đ</span>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <div class="pay-cart">
                    <span class="sum-pay">TỔNG HÓA ĐƠN: <span id="total" class="total-price"><?php echo number_format($tongtien); ?>đ</span></span>
               </div>
            </div>
            <?php
        }
    }
    ?>
</main>
