<?php
// Lấy dữ liệu từ database
$sql_sua = "SELECT * FROM danhmuc where danhmuc_id= '$_GET[id]' LIMIT 1";
$row_sua = mysqli_query($conn, $sql_sua);

?>
<div class="form-edit">
     <h2>Sửa Danh mục</h2>
     <form action="Dashboard/layout/quanlydanhmuc/xuly.php?id=<?php echo $_GET['id'] ?>" method="POST">
          <?php
          while ($row = mysqli_fetch_array($row_sua)) {
          ?>
               <div class="form-group">
                    <label for="category_id">ID Danh mục:</label>
                    <input type="text" id="category_id" name="category_id" value="<?php echo $row['danhmuc_id'] ?>" readonly>
               </div>
               <div class="form-group">
                    <label for="category_name">Tên danh mục:</label>
                    <input type="text" id="category_name" name="category_name" value="<?php echo $row['tendanhmuc'] ?>">
               </div>
               <button class="save" type="submit" name="btnLuu">Lưu</button>
          <?php } ?>
     </form>
</div>