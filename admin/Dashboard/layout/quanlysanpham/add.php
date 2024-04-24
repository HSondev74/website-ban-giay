<?php
$sql_lietke = "SELECT * FROM danhmuc ORDER BY danhmuc_id DESC";
$row_lietke = mysqli_query($conn, $sql_lietke);

?>
<!-- <h1 style="font-size: 36px;
     font-weight: 600;
     margin: 10px 30px;
     color: var(--dark);">Thêm sản phẩm</h1> -->
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
color: var(--blue);">Thêm</a>
     </li>
</ul>
<div class="board" style="width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
     <h2>Thêm Sản Phẩm</h2>
     <form action="Dashboard/layout/quanlysanpham/xuly.php" method="post" class="form-sanpham"
          enctype="multipart/form-data">
          <div class="form-group">
               <label for="tensanpham">Tên Sản Phẩm</label>
               <input type="text" id="tensanpham" name="tensanpham" required>
          </div>
          <div class="form-group">
               <label for="size">Kích Thước</label>
               <select style="outline: none;" id="size" name="size[]" required multiple>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
               </select>
          </div>
          <div class="form-group">
               <label for="gia">Giá</label>
               <input type="text" id="gia" name="gia" required>
          </div>
          <div class="form-group">
               <div id="image-preview"></div>
               <label for="hinhanh">Hình Ảnh</label>
               <input type="file" id="hinhanh" name="hinhanh[]" multiple >
          </div>
          <div class="form-group">
               <label for="tonkho">Số Lượng</label>
               <input style="outline: none;" type="number" id="tonkho" name="tonkho" required>
          </div>
          <div class="form-group">
               <label for="mota">Mô Tả</label>
               <textarea id="mota" name="mota" cols="30" rows="10" style="width:100%; margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;resize: none;" required></textarea>
          </div>
          <div class="form-group">
               <label for="danhmuc_id">Danh Mục ID</label>
               <select id="danhmuc_id" name="danhmuc_id" required>
                    <option value="">Chọn Danh Mục</option>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($row_lietke)) {
                         $i++;
                    ?>
                    <option value="<?php echo $row['danhmuc_id'] ?>"><?php echo $row['tendanhmuc'] ?></option>
                    <?php } ?>
               </select>
          </div>
          <div class="form-group">
               <button type="submit" name="addSanpham">Thêm Sản Phẩm</button>
          </div>
     </form>
</div>

