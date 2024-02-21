<main class="umine-center container">
     <div class="umine-center-top">
          <div class="slider">
               <div class="list-show">
                    <div class="list-image">
                         <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/slider_1.jpg?1705683863776"
                              alt="" />
                         <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/slider_2.jpg?1705683863776" />
                         <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/slider_3.jpg?1705683863776"
                              alt="" />
                         <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/slider_4.jpg?1705683863776"
                              alt="" />
                         <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/slider_5.jpg?1705683863776"
                              alt="" />
                    </div>

                    <div class="btns">
                         <div class="btn-left btn"><i class="bx bx-chevron-left"></i></div>
                         <div class="btn-right btn"><i class="bx bx-chevron-right"></i></div>
                    </div>
                    <div class="index-images">
                         <div class="index-item index-item-0 active"></div>
                         <div class="index-item index-item-1"></div>
                         <div class="index-item index-item-2"></div>
                         <div class="index-item index-item-3"></div>
                         <div class="index-item index-item-4"></div>
                    </div>
               </div>
          </div>
     </div>

     <div class="product-hot">
          <h1 class="title-hot">Sản Phẩm Hot</h1>
          <div class="content-products">
               <?php
               $sql = "SELECT * FROM sanpham LIMIT 15";
               $result = mysqli_query($conn, $sql);

               if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                         $images = explode(',', $product['hinhanh']);
                         if (!empty($images)) {
                              $first_image = $images[0];
                              $second_image = isset($images[1]) ? $images[1] : $images[0];
                         }
               ?>

               <div class="product"
                    onmouseover="changeImage('<?php echo $second_image; ?>', '<?php echo $product['sanpham_id']; ?>')"
                    onmouseout="changeImage('<?php echo $first_image; ?>', '<?php echo $product['sanpham_id']; ?>')"
                    data-id="<?php echo $product['sanpham_id']; ?>">
                    <a href="/pages/cart.php?action=chitietsanpham&id=<?php echo $product['sanpham_id']; ?>">

                         <div class="discount"> -20% </div>
                         <div class="product-image">
                              <img src="<?php echo $first_image; ?>" alt="">
                              <a href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id'] ?>"
                                   class="cart-popup" name="addProduct"><i class='bx bx-cart-add'></i></a>
                         </div>
                         <span class="heart-product"
                              onclick="changeFavorites(this,<?php echo $product['sanpham_id']; ?>)"
                              data-id="<?php echo $product['sanpham_id']; ?> "><i class='bx bxs-heart'></i></span>
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

     <div class="banner-product ">
          <div class="text-pr">
               <h3>ƯU ĐÃI QUÀ TẶNG HẤP DẪN</h3>
               <p>Giá trị quà tặng lên tới 1.000.000 đ tùy theo giá trị đơn hàng (Áp dụng trên hệ thống Online và tại
                    Cửa Hàng)</p>
          </div>
          <div class="banner-pr">
               <img src="https://bizweb.dktcdn.net/100/453/330/themes/859403/assets/banner_big.jpg?1705683863776"
                    alt="">
          </div>
     </div>

     <div class="banner-only">
          <div class="block-title">
               <h2>Chỉ có tại Vibesneak</h2>
          </div>
          <div class="imgs">
               <div class="only-img">
                    <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/banneronly_1.jpg?1705683863776"
                         alt="">
               </div>
               <div class="only-img">
                    <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/banneronly_2.jpg?1705683863776"
                         alt="">
               </div>
               <div class="only-img">
                    <img src="//bizweb.dktcdn.net/100/453/330/themes/859403/assets/banneronly_3.jpg?1705683863776"
                         alt="">
               </div>
          </div>
     </div>

     <div class="best-selling">
          <div class="title-selling">
               <h1>Sản Phẩm Bán Chạy</h1>
          </div>
          <div class="content-products">
               <div class="product">
                    <div class="discount"> -20% </div>
                    <div class="product-image">
                         <img src="https://bizweb.dktcdn.net/thumb/large/100/453/330/products/footart-anh-san-pham-website-2024-1650-px-1-1697828505660.jpg?v=1697828511123"
                              alt="">
                         <span class="cart-popup"><i class='bx bx-cart-add'></i></span>
                    </div>
                    <span class="heart-product"><i class='bx bxs-heart'></i></span>
                    <p class=" product-title">GIÀY ADIDAS ORIGINALS SAMBA OG CLOUD WHITE CORE BLACK - B75806</p>
                    <p class="product-price">3.400.000₫</p>
               </div>
               <div class="product">
                    <div class="discount"> -20% </div>
                    <div class="product-image">
                         <img src="https://bizweb.dktcdn.net/thumb/large/100/453/330/products/1-1697340489245.jpg?v=1697340499087"
                              alt="">
                         <span class="cart-popup"><i class='bx bx-cart-add'></i></span>
                    </div>
                    <span class="heart-product"><i class='bx bxs-heart'></i></span>
                    <p class=" product-title">GIÀY ADIDAS ORIGINALS SAMBA OG CLOUD WHITE CORE BLACK - B75806</p>
                    <p class="product-price">3.400.000₫</p>
               </div>
               <div class="product">
                    <div class="discount"> -20% </div>
                    <div class="product-image">
                         <img src="https://bizweb.dktcdn.net/thumb/large/100/453/330/products/1-1697337325385.jpg?v=1697337337993"
                              alt="">
                         <span class="cart-popup"><i class='bx bx-cart-add'></i></span>
                    </div>
                    <span class="heart-product"><i class='bx bxs-heart'></i></span>
                    <p class=" product-title">GIÀY ADIDAS ORIGINALS SAMBA OG CLOUD WHITE CORE BLACK - B75806</p>
                    <p class="product-price">3.400.000₫</p>
               </div>
               <div class="product">
                    <div class="discount"> -20% </div>
                    <div class="product-image">
                         <img src="https://bizweb.dktcdn.net/thumb/large/100/453/330/products/1-1697339753947.jpg?v=1697339760973"
                              alt="">
                         <span class="cart-popup"><i class='bx bx-cart-add'></i></span>
                    </div>
                    <span class="heart-product"><i class='bx bxs-heart'></i></span>
                    <p class=" product-title">GIÀY ADIDAS ORIGINALS SAMBA OG CLOUD WHITE CORE BLACK - B75806</p>
                    <p class="product-price">3.400.000₫</p>
               </div>
               <div class="product">
                    <div class="discount"> -20% </div>
                    <div class="product-image">
                         <img src="https://bizweb.dktcdn.net/thumb/large/100/453/330/products/1-1697340659338.jpg?v=1700674285940"
                              alt="">
                         <span class="cart-popup"><i class='bx bx-cart-add'></i></span>
                    </div>
                    <span class="heart-product"><i class='bx bxs-heart'></i></span>
                    <p class=" product-title">GIÀY ADIDAS ORIGINALS SAMBA OG CLOUD WHITE CORE BLACK - B75806</p>
                    <p class="product-price">3.400.000₫</p>
               </div>
          </div>
     </div>


</main>