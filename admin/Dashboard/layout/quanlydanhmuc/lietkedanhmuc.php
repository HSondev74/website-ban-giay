<?php
// Lấy dữ liệu từ database
$sql_lietke = "SELECT * FROM danhmuc ORDER BY danhmuc_id DESC";
$row_lietke = mysqli_query($conn, $sql_lietke);

?>

<div class="wrapper" style="width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
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
                         <td style="margin: 10px 0;">
                              <a href="?action=danhmuc&query=edit&id=<?php echo $row['danhmuc_id'] ?>" style="background-color: var(--orange);
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;">Sửa</a>
                              <a style="background-color: var(--red);
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;" href="Dashboard/layout/quanlydanhmuc/xuly.php?id=<?php echo $row['danhmuc_id'] ?>">Xóa</a>
                         </td>
                    </tr>
               <?php } ?>
          </tbody>
     </table>
</div>