<ul class="breadcrumb" style="display: flex;
     align-items: center;
     grid-gap: 16px;
     margin: 20px 30px;">
     <li>
          <a href="index.php?action=sanpham" style="color: var(--dark-grey);">Dashboard</a>
     </li>
     <li><i class='bx bx-chevron-right'></i></li>
     <li>
          <a class="active" href="" style="pointer-events: none;
color: var(--blue);">Đơn hàng</a>
     </li>
</ul>
<div style="width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
     <div class="head">
          <h3>Các Đơn Hàng</h3>
     </div>
     <div class="filter">
          <form action="index.php?action=donhang" method="post" class="name-custormer">
               <input type="text" name="keyword" style="outline: none;" id="userFilter" placeholder="Tìm theo tên người dùng">
               <button type="submit" name="searchHeader" class="donhang-searchbar-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
               </button>
          </form>

          <form method="GET" action="index.php?action=donhang">
               <select  name="sort" id="statusFilter" onchange="updateUrlWithSort()" style="padding: 10px 50px; margin: 30px 0; border-radius: 10px; border: 1px solid #ccc; outline: none;">
                    <option value="">Tất cả trạng thái</option>
                    <option value="Chờ xác nhận">Chưa xác nhận</option>
                    <option value="Đã xác nhận">Đã xác nhận</option>
               </select>
          </form>


          <!-- <button class="btn btn-primary" onclick="filterOrders()">Lọc</button> -->
     </div>
     <table>
          <tr>
               <th>ID</th>
               <th>Tên người nhận</th>
               <th>Địa Chỉ</th>
               <th>Điện thoại</th>
               <th>Ngày tạo</th>
               <th>Tổng tiền</th>
               <th>Trạng thái</th>
               <th></th>
          </tr>

          <?php
          if (isset($_POST['xacnhan']) && isset($_POST['order_id'])) {
               $order_id = intval($_POST['order_id']); // Convert order_id to an integer

               // Update order status
               $sql_update = "UPDATE donhang SET trangthai = 'Đã xác nhận' WHERE id_donhang = $order_id";
               $query_update = mysqli_query($conn, $sql_update);

               if ($query_update) {
                    $sql = "SELECT * FROM chitietdonhang WHERE id_donhang = $order_id";
                    $query = mysqli_query($conn, $sql);

                    if ($query && mysqli_num_rows($query) > 0) {
                         $row = mysqli_fetch_assoc($query);
                         $soluong = intval($row['soluong']);
                         $sanpham_id = intval($row['sanpham_id']);
                         $sql_sanpham = "UPDATE sanpham SET tonkho = tonkho - $soluong WHERE sanpham_id = $sanpham_id";
                         $query_sanpham = mysqli_query($conn, $sql_sanpham);

                         if (!$query_sanpham) {
                              echo "<script>alert('Có lỗi xảy ra khi cập nhật tồn kho sản phẩm');</script>";
                         }
                    } else {
                         echo "<script>alert('Không tìm thấy chi tiết đơn hàng');</script>";
                    }
               } else {
                    echo "<script>alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng');</script>";
               }
          }

          if (isset($_POST['xoa']) && isset($_POST['delete_order_id'])) {
               $delete_order_id = intval($_POST['delete_order_id']); // Convert the ID to an integer

               // SQL statement to delete the order
               $sql_delete = "DELETE FROM donhang WHERE id_donhang = $delete_order_id";
               $query_delete = mysqli_query($conn, $sql_delete); // Execute the query
               // echo "<script>alert('Đơn hàng đã được xóa thành công');</script>";
          }

          $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
          $get_keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
          $status_filter = isset($_GET['sort']) ? trim($_GET['sort']) : '';
          $sql = "SELECT * FROM donhang";

          $conditions = [];

          if ($keyword !== '') {
               $conditions[] = "ten LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'";
          }

          if ($get_keyword !== '') {
               $conditions[] = "ten LIKE '%" . mysqli_real_escape_string($conn, $get_keyword) . "%'";
          }

          if ($status_filter !== '') {
               $conditions[] = "trangthai = '" . mysqli_real_escape_string($conn, $status_filter) . "'";
          }

          if (!empty($conditions)) {
               $sql .= " WHERE " . implode(" AND ", $conditions);
          }

          $result = mysqli_query($conn, $sql);
          if ($result && mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id_donhang'];
                    $ten = $row['ten'];
                    $sdt = $row['sodienthoai'];
                    $diachi = $row['diachi'];
                    $ngaydat = $row['ngaydat'];
                    $tongtien = number_format($row['tongtien'], 0, ',', '.');
                    $trangthai = $row['trangthai'];
          ?>
                    <tr>
                         <td><?php echo $id; ?></td>
                         <td><?php echo $ten; ?></td>
                         <td><?php echo $diachi; ?></td>
                         <td><?php echo $sdt; ?></td>
                         <td><?php echo $ngaydat; ?></td>
                         <td><?php echo $tongtien; ?>đ</td>
                         <td>
                              <?php
                              if ($trangthai == 'Chờ xác nhận') {
                              ?>
                                   <form action="" method="post">
                                        <input type="hidden" name="order_id" value="<?php echo $id; ?>">
                                        <input type="submit" style="border: none; padding: 5px 15px; color: #fff; background-color: blue; border-radius: 5px;" name="xacnhan" value="Xác nhận">
                                   </form>
                              <?php
                              } elseif ($trangthai == 'Đã xác nhận') {
                                   echo 'Đã xác nhận';
                              } else {
                                   echo 'Đã hủy';
                              }
                              ?>
                         </td>
                         <td>
                              <form action="" method="post" style="display: inline-block;">
                                   <input type="hidden" name="delete_order_id" value="<?php echo $id; ?>">
                                   <input type="submit" style="border: none; padding: 5px 15px; color: white; background-color: red; border-radius: 5px;" name="xoa" value="Xóa">
                              </form>
                         </td>
                    </tr>
          <?php
               }
          } else {
               echo "<tr><td colspan='7'>Chưa có đơn hàng nào</td></tr>";
          }
          ?>
     </table>
</div>

<script>
     function updateUrlWithSort() {
          const selectElement = document.getElementById("statusFilter");
          const selectedValue = selectElement.value;

          // Get the current URL
          const currentUrl = new URL(window.location.href);

          if (selectedValue === "") {
               // If the selected value is empty ("Tất cả trạng thái"), remove 'sort' parameter
               currentUrl.searchParams.delete("sort");
          } else {
               // Otherwise, set the 'sort' parameter to the selected value
               currentUrl.searchParams.set("sort", selectedValue);
          }

          // Redirect to the updated URL
          window.location.href = currentUrl.toString();
     }

     // Set the current value of the dropdown based on the existing 'sort' parameter
     document.addEventListener("DOMContentLoaded", function() {
          const selectElement = document.getElementById("statusFilter");
          const currentUrl = new URL(window.location.href);
          const currentSort = currentUrl.searchParams.get("sort"); // Get the existing 'sort' value

          if (currentSort) {
               // Set the dropdown value based on the 'sort' parameter
               for (let i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === currentSort) {
                         selectElement.selectedIndex = i; // Set the selected index
                         break;
                    }
               }
          }
     });

     document.addEventListener("DOMContentLoaded", function() {
          const currentUrl = new URL(window.location.href);

          // Set input value to the existing 'keyword' parameter
          const currentKeyword = currentUrl.searchParams.get("keyword");
          if (currentKeyword) {
               document.getElementById("userFilter").value = currentKeyword;
          }
     });

     function retainQueryParams(form) {
          const currentUrl = new URL(window.location.href);

          // Retain the 'keyword' parameter in the URL when the form is submitted
          const keyword = document.getElementById("userFilter").value;
          currentUrl.searchParams.set("keyword", keyword);

          // Set form action with updated query parameters
          form.action = currentUrl.toString();
     }

     // Attach the function to the form submit event
     const form = document.querySelector("form.name-custormer");
     form.addEventListener("submit", function() {
          retainQueryParams(this);
     });
</script>