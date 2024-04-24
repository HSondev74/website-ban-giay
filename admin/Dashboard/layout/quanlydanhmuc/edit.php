<?php
// Lấy dữ liệu từ database
$sql_sua = "SELECT * FROM danhmuc where danhmuc_id= '$_GET[id]' LIMIT 1";
$row_sua = mysqli_query($conn, $sql_sua);

?>
<h1 style="font-size: 36px;
     font-weight: 600;
     margin: 10px 30px;
     color: var(--dark);">Sửa danh mục</h1>
<ul class="breadcrumb" style="display: flex;
     align-items: center;
     grid-gap: 16px;
     margin: 20px 30px;">
     <li>
          <a href="index.php" style="color: var(--dark-grey);">Dashboard</a>
     </li>
     <li><i class='bx bx-chevron-right'></i></li>
     <li>
          <a class="active" href="" style="pointer-events: none;
color: var(--blue);">Sửa danh mục</a>
     </li>
</ul>
<div style="width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
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