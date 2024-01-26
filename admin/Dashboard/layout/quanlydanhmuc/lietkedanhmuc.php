<?php
// Lấy dữ liệu từ database
$sql_lietke = "SELECT * FROM danhmuc ORDER BY danhmuc_id DESC";
$row_lietke = mysqli_query($conn, $sql_lietke);

?>
<div class="wrapper">
     <h2>Danh sách danh mục sản phẩm</h2>
     <table>
          <thead>
               <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th colspan="2">Tên danh mục</th>
               </tr>
          </thead>
          <tbody>
               <?php
               $i = 0;
               while ($row = mysqli_fetch_array($row_lietke)) {
                    $i++;
               ?>
               <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['danhmuc_id']; ?></td>
                    <td><?php echo $row['tendanhmuc']; ?></td>
                    <td>
                         <button class="btn"><a
                                   href="Dashboard/layout/quanlydanhmuc/xuly.php?id=<?php echo $row['danhmuc_id'] ?>">Xóa</a></button>

                         <button class="btn"><a
                                   href="?action=danhmuc&query=edit&id=<?php echo $row['danhmuc_id'] ?>">Sửa</a></button>
                    </td>
               </tr>
               <?php } ?>
          </tbody>
     </table>
</div>