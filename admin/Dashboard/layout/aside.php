<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "websitebangiay";

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $database);

// Kiểm tra
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT COUNT(*) AS totalUsers from nguoidung where kieunguoidung='customer'";
$sqlOrders = "SELECT COUNT(*) AS new_orders FROM donhang WHERE DATE(ngaydat) >= CURDATE() - INTERVAL 3 DAY";
$sqlTotalOrders = "SELECT SUM(gia) AS doanh_so_trong_7_ngay
FROM donhang
WHERE ngaydat BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW();
";
// query
$result = $conn->query($sql);
$result_orders = $conn->query($sqlOrders);
$result_total_orders = $conn->query($sqlTotalOrders);
// check counts
if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     $totalUsers = $row['totalUsers'];
} else {
     $totalUsers = 0;
}

// Kiểm tra và hiển thị kết quả
if (mysqli_num_rows($result_orders) > 0) {
     $row = mysqli_fetch_assoc($result_orders);
     $total_orders = $row['new_orders'];
} else {
     echo "Không có đơn hàng nào trong cơ sở dữ liệu.";
}

if (mysqli_num_rows($result_total_orders) > 0) {
     $row = mysqli_fetch_assoc($result_total_orders);
     $total_7days_orders = number_format($row['doanh_so_trong_7_ngay'], 0, ',', '.');
}



$conn->close();

?>

<main>
     <div class="head-title">
          <div class="left">
               <h1>Trang Chủ</h1>
               <ul class="breadcrumb" style="display: flex;
     align-items: center;
     grid-gap: 16px;
     margin: 20px 30px;">
                    <li>
                         <a href="#">Trang Chủ</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                         <a class="active" href="#">Home</a>
                    </li>
               </ul>
          </div>
          <!-- <a href="#" class="btn-download">
               <i class='bx bxs-cloud-download'></i>
               <span class="text">Download PDF</span>
          </a> -->
     </div>

     <ul class="box-info">
          <li>
               <i class='bx bxs-calendar-check'></i>
               <span class="text">
                    <h3><?php echo $total_orders; ?></h3>
                    <p>Đơn mới</p>
               </span>
          </li>
          <li>
               <i class='bx bxs-group'></i>
               <span class="text">
                    <h3> <?php echo $totalUsers ?> </h3>
                    <p>Số người đã đăng kí</p>
               </span>
          </li>
          <li>
               <i class='bx bxs-dollar-circle'></i>
               <span class="text">
                    <h3><?php echo $total_7days_orders; ?> VNĐ</h3>
                    <p>Tổng tiền đã bán trong 7 ngày gần nhất</p>
               </span>
          </li>
     </ul>


     <div class="table-data">
          <div class="order">
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
                              <th>Ngày Đặt Hàng</th>
                              <th>Trạng Thái</th>
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

                         // Truy vấn SQL để lấy thông tin của tất cả người đặt hàng
                         $sql = "SELECT nguoidung.*, donhang.* FROM nguoidung
        INNER JOIN donhang ON nguoidung.user_id = donhang.user_id";

                         $result = mysqli_query($conn, $sql);

                         if ($result) {
                              if (mysqli_num_rows($result) > 0) {
                                   // Hiển thị thông tin của tất cả người đặt hàng
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
                         ?>
                                        <tr>
                                             <td>
                                                  <img src="http://localhost/BanGiay/admin/images/<?php echo $row['hinhanh'] ?>" alt="image" class="image">
                                                  <p><?php echo $row['ten']; ?></p>
                                             </td>
                                             <td><?php echo $formatted_date; ?></td>
                                             <td><span class="status completed"><?php echo $status_class; ?></span></td>
                                        </tr>
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
          <div class="todo">
               <div class="head">
                    <h3>Todos</h3>
                    <i class='bx bx-plus'></i>
                    <i class='bx bx-filter'></i>
               </div>
               <ul class="todo-list">
                    <li class="completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="not-completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="not-completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
               </ul>
          </div>
     </div>
</main>
<!-- MAIN -->