<?php
if (isset($_GET['id'])) {

  $idsp = $_GET['id'];
  $sql = "SELECT * FROM sanpham where sanpham_id = '" . $idsp . "'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
      $images = explode(',', $product['hinhanh']);
      $sizes = explode(',', $product['size']);
      $first_size = $sizes[0];
      $mota = $product['mota'];

      if (!empty($images)) {
        $first_image = $images[0];
        $second_image = isset($images[1]) ? $images[1] : $images[0];
      }
      $danhmuc_id = $product['danhmuc_id'];
      $sql_danhmuc = "SELECT tendanhmuc FROM danhmuc WHERE danhmuc_id = $danhmuc_id";
      $result_danhmuc = mysqli_query($conn, $sql_danhmuc);
      $row_danhmuc = mysqli_fetch_assoc($result_danhmuc);
      $tendanhmuc = $row_danhmuc['tendanhmuc'];


?>


      <main id="main" class="container">
        <div class="container-details">
          <div class="detail">

            <div class="all-detail">
              <div class="slide-img-detail">
                <div class="gallery">
                  <div class="gallery-inner">
                    <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image ?>" alt="" />
                  </div>

                  <!-- <div class="control prev">
                  <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="control next">
                  <i class="fa-solid fa-arrow-right"></i>
                </div> -->

                </div>

                <div>
                  <div class="list">
                    <?php foreach ($images as $image) {
                    ?>
                      <div>
                        <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $image ?>" alt="" />
                      </div>
                    <?php } ?>
                  </div>
                </div>

              </div>

              <div class="detail-product">
                <div class="detail-brand"><?php echo $tendanhmuc ?></div>

                <h4 class="detail-name">
                  <?php echo $product['tensanpham'] ?>
                </h4>

                <div class="detail-price"><?php echo number_format($product['gia'], 0, ',', '.') . ' VNĐ'; ?>
                </div>

                <div class="title-size"> SIZE</div>
                <!-- <ul class="size">
                  <?php foreach ($sizes as $size) {
                    $ref = '';
                    if (isset($_GET['size'])) {
                      if ($_GET['size'] == $size) {
                        $ref = 'selected';
                      } else {
                        $ref = '';
                      }
                    } ?>

                    <li>
                      <a href="index.php?action=chitietsanpham&id=<?php echo $product['sanpham_id']; ?>&size=<?php echo $size; ?>" data-size="<?php echo $size; ?>" class="<?php echo $ref ?>">
                        <?php echo $size; ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul> -->


                <ul class="size">
                  <?php foreach ($sizes as $index => $size) { ?>
                    <li onclick="selectSize(this)" <?php if ($index === 0) echo 'class="selected"'; ?>>
                      <?php echo $size; ?>
                    </li>
                  <?php } ?>
                </ul>







                <div class="parameter-detail">
                  <div class="para">Code: <b>VIBES-<?php echo $product['sanpham_id'] ?></b></div>
                  <div class="para">Tình trạng: <b><?php echo $product["tonkho"] >= 1 ? 'Còn hàng' : 'Đã hết hàng' ?></b></div>
                  <div class="para">Hãng sản xuất: <b><?php echo $tendanhmuc ?></b></div>
                  <div class="para">Xuất xứ thương hiệu: <b>Hàng xách tay</b></div>
                  <!-- <div class="para">Chủng loại: <b>Giày</b></div> -->
                </div>

                <div class="detail-ship">
                  <div class="detail-icon">
                    <img src="./images/img-icon/icon_service_product_1.svg" alt="">
                    <p>Giao hàng toàn quốc (Hỗ trợ ship COD nhận hàng thanh toán)
                    <p>
                  </div>
                  <div class="detail-icon">
                    <img src="./images/img-icon/icon_service_product_2.svg" alt="">
                    <p>Nhận ngay QUÀ TẶNG và VOUCHER giảm giá cho lần mua hàng tiếp theo
                    <p>
                  </div>
                  <div class="detail-icon">
                    <img src="./images/img-icon/icon_service_product_3.svg" alt="">
                    <p>
                      Hỗ trợ đổi size và đổi mẫu trong vòng 5 ngày
                    <p>
                  </div>
                  <div class="detail-icon">
                    <img src="./images/img-icon/icon_service_product_4.svg" alt="">
                    <p>Cam kết hàng chính hãng 100%
                    <p>
                  </div>
                </div>

                <!-- <div class="detail-like">
                  <i class="fa-regular fa-heart"></i>
                  <p>Yêu thích</p>
                </div> -->

                <?php $tonkho = $product['tonkho'] ?>
                <form action="" method="post">
                  <div style="margin-top: 20px;">
                    <div class="up-and-downproduct">
                      <div class="quantity-decrease" onclick="changeValue(-1, <?php echo $tonkho ?>)">-</div>
                      <input class="up-and-downproduct-input" type="text" readonly id="value" name="value" min="1" max="<?php echo $tonkho ?>" value="1" onchange="updateLinks()">
                      <div class="quantity-increase" onclick="changeValue(1, <?php echo $tonkho ?>)">+</div>
                    </div>
                  </div>

                  <div class="detail-pay">
                    <a id="addToCartLink" href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id']; ?>&size=<?php echo $first_size ?>&soluong=<?php echo isset($_POST['value']) ? $_POST['value'] : 1; ?>&them" class="detail-add-pay">Thêm vào giỏ hàng</a>
                    <a id="buyNowLink" href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id']; ?>&size=<?php echo $first_size ?>&soluong=<?php echo isset($_POST['value']) ? $_POST['value'] : 1; ?>&muangay" class="detail-buy">Mua Ngay</a>
                  </div>
                </form>



                <!-- <div class="detail-contact">
                  <div class="zalo">Liên hệ Zalo</div>
                  <div class="faebook">Liên hệ Fanpage Facebook</div>
                  <div class="insta">Liên hệ Instagam</div>
                </div> -->

              </div>
            </div>
          </div>
        </div>

        <div class="detail-pro">
          <h2>CHI TIẾT SẢN PHẨM</h2>
          <p style="margin-top: 10px;"><?php echo $mota ?></p>
        </div>

        <!-- sanpham lien quan -->
        <div class="product-hot ">
          <div class="title-hot">
            <h1>Sản phẩm liên quan</h1>
          </div>
          <div class="content-products">
            <?php
            $products_per_page = 5;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start_index = ($current_page - 1) * $products_per_page;

            $sql = "SELECT * FROM sanpham WHERE danhmuc_id = $danhmuc_id and sanpham_id != $idsp LIMIT $start_index, $products_per_page";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
              while ($product = $result->fetch_assoc()) {
                $images = explode(',', $product['hinhanh']);
                $sizes = explode(',', $product['size']);
                $first_size = $sizes[0];

                if (!empty($images)) {
                  $first_image = $images[0];
                  $second_image = isset($images[1]) ? $images[1] : $images[0];
                }
            ?>

                <div class="product" onmouseover="changeImage('admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $second_image; ?>', '<?php echo $product['sanpham_id']; ?>')" onmouseout="changeImage('admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image; ?>', '<?php echo $product['sanpham_id']; ?>')" data-id="<?php echo $product['sanpham_id']; ?>">
                  <a href="index.php?action=chitietsanpham&id=<?php echo $product['sanpham_id']; ?>">

                    <!-- <div class="discount"> -20% </div> -->
                    <div class="product-image">
                      <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image; ?>" alt="">
                      <!-- <a href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id'] ?>" class="cart-popup" name="addProduct"><i class='bx bx-cart-add'></i></a> -->
                    </div>
                    <!-- <span class="heart-product" onclick="changeFavorites(this,<?php echo $product['sanpham_id']; ?>)" data-id="<?php echo $product['sanpham_id']; ?> "><i class='bx bxs-heart'></i></span> -->
                    <p class=" product-title"><?php echo $product['tensanpham'] ?></p>
                    <p class="product-price"><?php echo number_format($product['gia'], 0, ',', '.') . ' VNĐ'; ?>
                    </p>
                  </a>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>

        <!-- phan trang -->
        <div class="pagination">
          <?php
          $sql_count = "SELECT COUNT(*) AS total FROM sanpham WHERE danhmuc_id = $danhmuc_id";
          $result_count = mysqli_query($conn, $sql_count);
          $row_count = mysqli_fetch_assoc($result_count);
          $total_pages = ceil($row_count['total'] / $products_per_page);

          for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='index.php?action=chitietsanpham&id=$idsp&page=$i'>$i</a>";
          }
          ?>
        </div>



      </main>
<?php }
  }
} ?>

<?php
?>

<script>
  function changeValue(change, maxStock) {
    var valueElement = document.getElementById("value");
    var currentValue = parseInt(valueElement.value);
    var newValue = currentValue + change;

    // Đảm bảo giá trị ở trong phạm vi hợp lệ
    newValue = Math.max(1, Math.min(newValue, maxStock));

    // Cập nhật giá trị trong ô nhập liệu
    valueElement.value = newValue;

    // Cập nhật liên kết với giá trị mới
    updateLinks();
  }

  function updateLinks() {
    var valueElement = document.getElementById("value");
    var addToCartLink = document.getElementById("addToCartLink");
    var buyNowLink = document.getElementById("buyNowLink");

    // Lấy giá trị mới của input
    var newValue = valueElement.value;

    // Cập nhật URL của các liên kết với giá trị mới
    addToCartLink.href = addToCartLink.href.replace(/&soluong=\d+/, "&soluong=" + newValue);
    buyNowLink.href = buyNowLink.href.replace(/&soluong=\d+/, "&soluong=" + newValue);
  }

  function selectSize(element) {
    // Xóa lớp 'selected' từ tất cả các phần tử <li> trong danh sách
    var listItems = document.querySelectorAll('.size li');
    listItems.forEach(function(item) {
      item.classList.remove('selected');
    });

    // Thêm lớp 'selected' vào phần tử được nhấp vào
    element.classList.add('selected');

    // Lấy giá trị của phần tử được chọn và cập nhật vào URL của liên kết
    var selectedSize = element.textContent.trim();
    var addToCartLink = document.getElementById("addToCartLink");
    var buyNowLink = document.getElementById("buyNowLink");

    addToCartLink.href = addToCartLink.href.replace(/&size=[^&]*/, "&size=" + encodeURIComponent(selectedSize));
    buyNowLink.href = buyNowLink.href.replace(/&size=[^&]*/, "&size=" + encodeURIComponent(selectedSize));
  }
</script>