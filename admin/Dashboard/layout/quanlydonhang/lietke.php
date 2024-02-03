<div style="width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
     <div class="head">
          <h3>Các Đơn Hàng</h3>
     </div>
     <div class="filter">
          <input type="text" id="userFilter" placeholder="Tìm theo tên người dùng">
          <select id="statusFilter" style="padding: 10px 50px; margin: 30px 0; border-radius: 10px;">
               <option value="">Tất cả trạng thái</option>
               <option value="chưa xác nhận">Chưa xác nhận</option>
               <option value="đã xác nhận">Đã xác nhận</option>
               <option value="đang giao hàng">Đang giao hàng</option>
          </select>
          <button class="btn btn-primary" onclick="filterOrders()">Lọc</button>
     </div>
     <table>
          <thead>
               <tr>
                    <th>Người Dùng</th>
                    <th>Địa Chỉ Email</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá Bán</th>
                    <th>Size</th>
                    <th>Phương thức thanh toán</th>
                    <th>Số Lượng</th>
                    <th>Ngày Đặt Hàng</th>
                    <th>Trạng Thái</th>
                    <th>Tổng Tiền</th>
               </tr>
          </thead>
          <tbody>
               <?php
               // Kết nối đến cơ sở dữ liệu
               $servername = "localhost";
               $username = "root";
               $password = "";
               $database = "websitebangiay";
               $conn = mysqli_connect($servername, $username, $password, $database);

               // Kiểm tra kết nối
               if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
               }

               // Truy vấn SQL để lấy thông tin của tất cả người đặt hàng, sản phẩm và size
               $sql = "SELECT nguoidung.*, donhang.*, sanpham.*, donhang.size AS donhang_size
                FROM nguoidung
                INNER JOIN donhang ON nguoidung.user_id = donhang.user_id
                INNER JOIN sanpham ON donhang.sanpham_id = sanpham.sanpham_id";

               $result = mysqli_query($conn, $sql);

               if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                         // Hiển thị thông tin của tất cả người đặt hàng và tính tổng tiền sản phẩm
                         while ($row = mysqli_fetch_assoc($result)) {
                              $formatted_date = date('d-m-Y', strtotime($row['ngaydat']));
                              $status_class = '';
                              switch ($row['trangthai']) {
                                   case 'chưa xác nhận':
                                        $status_class = 'chưa xác nhận';
                                        break;
                                   case 'đã xác nhận':
                                        $status_class = 'đã xác nhận';
                                        break;
                                   case 'đang giao hàng':
                                        $status_class = 'đang giao hàng';
                                        break;
                                   default:
                                        $status_class = 'chưa xác nhận';
                              }

                              // Tính tổng tiền sản phẩm
                              $total_price = $row['gia'] * $row['soluong'];

                              // Hiển thị thông tin và tổng tiền sản phẩm
               ?>
               <tr>
                    <td>
                         <?php echo $row['ten']; ?>
                    </td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['tensanpham']; ?></td>
                    <td><?php echo $row['gia']; ?></td>
                    <td><?php echo $row['donhang_size']; ?></td>
                    <td><?php echo $row['phuongthucthanhtoan']; ?></td>
                    <td><?php echo $row['soluong']; ?></td>
                    <td><?php echo $formatted_date; ?></td>
                    <td>
                         <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                         <select name="status">
                              <option value="chưa xác nhận"
                                   <?php if ($status_class === 'chưa xác nhận') echo 'selected'; ?>>Chưa xác nhận
                              </option>
                              <option value="đã xác nhận"
                                   <?php if ($status_class === 'đã xác nhận') echo 'selected'; ?>>Đã xác nhận
                              </option>
                              <option value="đang giao hàng"
                                   <?php if ($status_class === 'đang giao hàng') echo 'selected'; ?>>Đang giao hàng
                              </option>
                         </select>
                    </td>

                    <td><?php echo $total_price; ?></td>
               </tr>
               <td><a class="btn" href="">Cập nhật</a></td>
               <?php
                         }
                    } else {
                         echo "<tr><td>Chưa có đơn hàng nào</td></tr>";
                    }
               } else {
                    echo "Error: " . mysqli_error($conn);
               }

               // Đóng kết nối
               mysqli_close($conn);
               ?>
          </tbody>
     </table>



</div>