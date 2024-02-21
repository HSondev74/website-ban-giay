<?php
$total_price = 0;
// Tính tổng giá trị của giỏ hàng
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { // Kiểm tra giỏ hàng có tồn tại và không rỗng
     foreach ($_SESSION['cart'] as $item) {
          $total_price += $item['gia'] * $item['soluong'];
     }
}
?>

<main>
     <div class="attach" style="margin: 0 auto; width: 70%; padding: 20px 0px">
          <span style="font-size: 12px; color: #777777; font-weight: bold">Trang Chủ / <text style="color: #000000c0">Giỏ Hàng</text></span>
          <br />
          <br /><br />
          <span class="title-frame">Giỏ Hàng Của Bạn</span>
     </div>
     <br />
     <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
          <!-- Kiểm tra nếu giỏ hàng không rỗng -->
          <div class="frame-prd-cart">
               <table>
                    <tr>
                         <th align="left">Sản Phẩm</th>
                         <th align="left">Đơn Giá</th>
                         <th align="left">Số Lượng</th>
                         <th align="left">Thành Tiền</th>
                         <th align="right"></th>
                    </tr>
                    <?php foreach ($_SESSION['cart'] as $item) : ?>
                         <tr>
                              <td data-cell="Sản Phẩm :">
                                   <div class="in4-prd-cart">
                                        <div class="img-prd-cart">
                                             <img src="<?php echo $item['hinhanh']; ?>" alt="" />
                                        </div>
                                        <div class="name-prd-cart">
                                             <br />
                                             <span><a href="" class="name-prd-link-cart"><?php echo $item['tensp']; ?></a></span><br />
                                             <?php if (isset($item['size'])) : ?>
                                                  <span><?php echo $item['size']; ?></span>
                                             <?php endif; ?>
                                        </div>
                                   </div>
                              </td>
                              <td data-unit-price="<?php echo $item['gia']; ?>">
                                   <?php echo number_format($item['gia']); ?>đ</td>
                              <td>
                                   <div class="up-and-downproduct">
                                        <a href="pages/addProduct.php?decrease=<?php echo $item['id']; ?>" class="quantity-decrease" data-id="<?php echo $item['id']; ?>">-</a>
                                        <span class="quantity-prd"><?php echo $item['soluong']; ?></span>
                                        <a href="pages/addProduct.php?increase=<?php echo $item['id']; ?>" class="quantity-increase" data-id="<?php echo $item['id']; ?>">+</a>
                                   </div>
                              </td>

                              <td class="sum-price-cart" data-cell="Tổng :">
                                   <span id="total" class="sum-pay-color" data-total-price="<?php echo $total_price; ?>"><?php echo number_format($item['gia'] * $item['soluong']); ?>đ</span>
                              </td>
                              <td>
                                   <a href="pages/addProduct.php?xoa=<?php echo $item['id']; ?>" class="btn-del-item-cart">Xóa</a>
                              </td>
                         </tr>
                    <?php endforeach; ?>
               </table>
               <div class="pay-cart">
                    <span class="sum-pay">TỔNG HÓA ĐƠN: <span id="total" class="sum-pay-color"><?php echo number_format($total_price); ?>đ</span></span>
                    <a href="index.php?action=thanhtoan"> <input type="button" value="Thanh Toán" class="btn-pay-cart" /></a>
               </div>
          </div>
     <?php else : ?>
          <!-- Hiển thị thông báo khi giỏ hàng trống -->
          <h3 style="text-align:center;">Không có sản phẩm nào trong giỏ hàng!</h3>
     <?php endif; ?>
</main>