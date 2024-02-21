<?php

$idsp = $_GET['id'];
$sql = "SELECT * FROM sanpham where sanpham_id = '" . $idsp . "'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  while ($product = $result->fetch_assoc()) {
    $images = explode(',', $product['hinhanh']);
    $sizes = explode(',', $product['size']);
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
    <main id="main" class="space">
      <div class="container-details container">
        <div class="detail">
          <div class="top-title">
            <ul class="nav-detail">
              <li><a class="home-detail" href="">Trang chủ</a></li>
              <li><a class="now-detail" href="">Available Now !</a></li>
              <li>
                <a class="name-detail" href="">

                </a>
              </li>
            </ul>
          </div>

          <div class="all-detail">
            <div class="slide-img-detail">
              <div class="gallery">
                <div class="gallery-inner">
                  <img src="<?php echo $first_image ?>" alt="" />
                </div>
                <div class="control prev">
                  <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="control next">
                  <i class="fa-solid fa-arrow-right"></i>
                </div>
              </div>

              <div>
                <div class="list">
                  <?php foreach ($images as $image) {
                  ?>
                    <div>
                      <img src="<?php echo $image ?>" alt="" />
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

              <ul class="size">
                <?php foreach ($sizes as $size) {
                ?>
                  <li><?php echo $size ?></li>
                <?php } ?>
              </ul>

              <div class="parameter-detail">
                <div class="para">Code: <b>FZ5741-191</b></div>
                <div class="para">Tình trạng: <b>Tạm hết hàng, vẫn có thể đặt hàng</b></div>
                <div class="para">Hãng sản xuất: <b><?php echo $tendanhmuc ?></b></div>
                <div class="para">Xuất xứ thương hiệu: <b>Hàng xách tay</b></div>
                <div class="para">Chủng loại: <b>Giày</b></div>
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

              <div class="detail-like">
                <i class="fa-regular fa-heart"></i>
                <p>Yêu thích</p>
              </div>

              <div style="margin-top: 10px;">
                <p>Số lượng sản phầm: <?php echo $product["tonkho"] ?></p>
              </div>

              <div class="detail-pay">
                <a href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id'] ?>" class="detail-add-pay">Thêm vào giỏ hàng</a>
                <div class="detail-buy">Mua Ngay</div>
              </div>

              <div class="detail-contact">
                <div class="zalo">Liên hệ Zalo</div>
                <div class="faebook">Liên hệ Fanpage Facebook</div>
                <div class="insta">Liên hệ Instagam</div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>
<?php }
} ?>