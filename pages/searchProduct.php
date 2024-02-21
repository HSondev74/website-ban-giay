<?php
if (isset($_POST['keyword'])) {
     $keyWord = $_POST['keyword'];
} else {
     $keyWord = '';
}

if (isset($_POST['Categories'])) {
     $categoryId = $_POST['Categories'];
} else {
     $categoryId = '';
}
$sql = "SELECT * FROM sanpham where tensanpham LIKE '%" . $keyWord . "%'  ";
// Nếu có danh mục được chọn, thêm điều kiện lọc theo danh mục vào câu truy vấn SQL
if (!empty($categoryId)) {
     $sql .= " AND danhmuc_id = " . $categoryId;
}
$result = mysqli_query($conn, $sql);
?>
<div class="product-hot">
     <h1 class="title-hot">Sản Phẩm Tìm Thấy</h1>
     <div class="content-products">
          <?php
          if ($result->num_rows > 0) {
               while ($product = $result->fetch_assoc()) {
                    $images = explode(',', $product['hinhanh']);
                    if (!empty($images)) {
                         $first_image = $images[0];
                         $second_image = isset($images[1]) ? $images[1] : $images[0];
                    }
          ?>

                    <div class="product" onmouseover="changeImage('<?php echo $second_image; ?>', '<?php echo $product['sanpham_id']; ?>')" onmouseout="changeImage('<?php echo $first_image; ?>', '<?php echo $product['sanpham_id']; ?>')" data-id="<?php echo $product['sanpham_id']; ?>">
                         <a href="/pages/cart.php?action=chitietsanpham&id=<?php echo $product['sanpham_id']; ?>">

                              <div class="discount"> -20% </div>
                              <div class="product-image">
                                   <img src="<?php echo $first_image; ?>" alt="">
                                   <a href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id'] ?>" class="cart-popup" name="addProduct"><i class='bx bx-cart-add'></i></a>
                              </div>
                              <span class="heart-product" onclick="changeFavorites(this,<?php echo $product['sanpham_id']; ?>)" data-id="<?php echo $product['sanpham_id']; ?> "><i class='bx bxs-heart'></i></span>
                              <p class=" product-title"><?php echo $product['tensanpham'] ?></p>
                              <p class="product-price"><?php echo number_format($product['gia'], 0, ',', '.') . ' VNĐ'; ?>
                              </p>
                         </a>
                    </div>
          <?php
               }
          } ?>
     </div>
</div>