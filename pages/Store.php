<?php
// Truy vấn để lấy danh sách các danh mục
$sql = "SELECT * FROM danhmuc";
$result = mysqli_query($conn, $sql);

// Danh sách các danh mục
$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
     $categories[] = $row;
}
// Mặc định giá trị tối thiểu và tối đa
$min_price = 0;
$max_price = 10000000;

// Kiểm tra nếu người dùng đã chọn giá

// Kiểm tra nếu người dùng đã chọn danh mục
if (isset($_GET['category'])) {
     $selected_category = $_GET['category'];
     // Thực hiện truy vấn để lấy các sản phẩm của danh mục đã chọn
     $sql = "SELECT * FROM sanpham WHERE danhmuc_id = '$selected_category'";
     $result = mysqli_query($conn, $sql);
} elseif (isset($_POST['min_price']) || isset($_POST['max_price'])) {
     // Lấy giá trị từ biểu mẫu POST
     $min_price = $_POST['min_price'];
     $max_price = $_POST['max_price'];

     // Truy vấn lấy các sản phẩm trong khoảng giá đã chọn
     $sql = "SELECT * FROM sanpham WHERE gia BETWEEN $min_price AND $max_price";
     $result = mysqli_query($conn, $sql);
} else {
     // Nếu không có danh mục được chọn, hiển thị tất cả sản phẩm
     $sql = "SELECT * FROM sanpham";

     // Kiểm tra xem có sắp xếp theo yêu cầu nào không
     if (isset($_POST['sort'])) {
          $sort_option = $_POST['sort'];
          switch ($sort_option) {
               case 'az':
                    $sql .= " ORDER BY tensanpham ASC";
                    break;
               case 'za':
                    $sql .= " ORDER BY tensanpham DESC";
                    break;
               case 'price_asc':
                    $sql .= " ORDER BY gia ASC";
                    break;
               case 'price_desc':
                    $sql .= " ORDER BY gia DESC";
                    break;
                    // Thêm các trường hợp sắp xếp khác ở đây nếu cần
               default:
                    // Mặc định là không sắp xếp
                    break;
          }
     }
     $result = mysqli_query($conn, $sql);
}

?>
<main id="main">
     <div class="attach" style="margin: 0 auto; width: 70%; padding: 20px 0px">
          <span style="font-size: 12px; color: #777777; font-weight: bold">Trang Chủ /
               <text style="color: #000000c0">Cửa Hàng</text></span>
     </div>
     <div class="ctn-store">
          <div class="hd-search-in4-item">
               <div class="hidden-search-item-prd">
                    <div>Sắp xếp theo</div>
                    <form method="POST" action="index.php?action=cuahang">
                         <select name="sort" id="sort-select" class="search-in4-item">
                              <option value="">Mặc định</option>
                              <option value="latest">Mặt hàng mới nhất</option>
                              <option value="az">A <i class='bx bx-arrow-to-right'></i> Z</option>
                              <option value="za">Z <i class='bx bx-arrow-to-right'></i> A</option>
                              <option value="price_asc">Giá tăng dần</option>
                              <option value="price_desc">Giá giảm dần</option>
                         </select>
                         <!-- <input type="submit" value="Sắp xếp" /> -->
                    </form>
               </div>

               <div class="hidden-search-item-prd-1">
                    <label for="">Giá</label>
                    <select name="" id="" class="search-in4-item">
                         <option value="">Mặc định</option>
                         <option value="">100 nghìn -> 500 nghìn</option>
                         <option value="">500 nghìn -> 2 triệu</option>
                         <option value="">2 triệu -> 4 triệu</option>
                         <option value="">4 triệu -> 6 triệu</option>
                         <option value="">6 triệu -> 10 triệu</option>
                         <option value="">10 triệu trở lên</option>
                    </select>
               </div>
          </div>
          <div class="show-product">
               <div class="in4-prd">
                    <br />
                    <br />
                    <div class="search-prd">
                         <div class="search-box-prd">
                              <div class="search-field-prd">
                                   <input placeholder="Search..." class="input-prd" type="text" />
                                   <div class="search-box-icon-prd">
                                        <button class="btn-icon-content-prd">
                                             <i class="search-icon-prd">
                                                  <svg xmlns="://www.w3.org/2000/svg" version="1.1"
                                                       viewBox="0 0 512 512">
                                                       <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                                                            fill="#"></path>
                                                  </svg>
                                             </i>
                                        </button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <br />
                    <h4>THƯƠNG HIỆU</h4>
                    <br />
                    <div class="name-prd">
                         <!-- Hiển thị danh sách các danh mục -->
                         <ul class="name-prd-ul">
                              <?php foreach ($categories as $category) : ?>
                              <li><a
                                        href="index.php?action=cuahang&category=<?php echo $category['danhmuc_id']; ?>"><?php echo $category['tendanhmuc']; ?></a>
                              </li>
                              <?php endforeach; ?>
                         </ul>
                    </div>
                    <br />
                    <hr />
                    <div class="price-search-prd">
                         <br />
                         <br />
                         <h4>Giá từ</h4>
                         <div class="card-conteiner-prd">
                              <div class="card-content-prd">
                                   <div data-range="#third" data-value-1="#second" data-value-0="#first"
                                        class="slider-prd">
                                        <label class="label-min-value-prd">0đ</label>
                                        <label class="label-max-value-prd">10.000.000đ</label>
                                   </div>
                                   <form class="rangeslider-prd" method="POST" action="index.php?action=cuahang">
                                        <input class="min input-ranges-prd" name="min_price" type="range" min="0"
                                             max="50000" value="<?php echo $min_price; ?>"
                                             onchange="updateLabelValue(this, 'label-min-value-prd')" />
                                        <input class="max input-ranges-prd" name="max_price" type="range" min="50000"
                                             max="10000000" value="<?php echo $max_price; ?>"
                                             onchange="updateLabelValue(this, 'label-max-value-prd')" />
                                        <input style="margin-top: 50px;" type="submit" value="Lọc Giá"
                                             class="btn-prd-price" />
                                   </form>
                              </div>
                         </div>
                    </div>
                    <br />
                    <!-- <hr /> -->
                    <div class="size-prd">
                         <h4 style="margin-bottom: 10px">Lọc theo size</h4>
                         <input type="checkbox" /><label for="scales">Size S</label><br />
                         <input type="checkbox" /><label for="scales">Size M</label><br />
                         <input type="checkbox" /><label for="scales">Size L</label><br />
                         <input type="checkbox" /><label for="scales">Size XL</label><br />
                         <input type="checkbox" /><label for="scales">Size XXL</label>
                    </div>
               </div>
               <div class="in4-items">
                    <?php
                    // Kiểm tra xem có sản phẩm nào không
                    if (mysqli_num_rows($result) > 0) {
                         // Duyệt qua từng sản phẩm và đổ thông tin vào mẫu HTML
                         while ($row = mysqli_fetch_assoc($result)) {
                              $images = explode(',', $row['hinhanh']);
                              if (!empty($images)) {
                                   $first_image = $images[0];
                              }
                    ?>
                    <div class="box">
                         <a href="index.php?action=chitietsanpham&id=<?php echo $row['sanpham_id']; ?>">
                              <div class="card">
                                   <div class="image-container">
                                        <img src="<?php echo $first_image; ?>" alt="" />
                                   </div>
                                   <label class="favorite">
                                        <input checked="" type="checkbox" />
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000">
                                             <path
                                                  d="M12 20a1 1 0 0 1-.437-.1C11.214 19.73 3 15.671 3 9a5 5 0 0 1 8.535-3.536l.465.465.465-.465A5 5 0 0 1 21 9c0 6.646-8.212 10.728-8.562 10.9A1 1 0 0 1 12 20z">
                                             </path>
                                        </svg>
                                   </label>
                                   <div class="content">
                                        <div class="brand">
                                             <?php
                                                       $iddanhmuc = $row['danhmuc_id'];
                                                       $sql1 = "SELECT tendanhmuc FROM danhmuc WHERE danhmuc_id = '" . $iddanhmuc . "' ";

                                                       // Thực hiện truy vấn
                                                       $result1 = mysqli_query($conn, $sql1); // Thay $sql bằng $sql1
                                                       if ($result1) {
                                                            $row1 = mysqli_fetch_assoc($result1);
                                                            echo $row1['tendanhmuc'];
                                                       } else {
                                                            echo "Không có danh mục"; // Xử lý khi không có kết quả truy vấn
                                                       }
                                                       ?>
                                        </div>

                                        <div class="prd-name"><?php echo $row['tensanpham']; ?></div>
                                        <div class="rating">
                                             <svg viewBox="0 0 99.498 16.286" xmlns="http://www.w3.org/2000/svg"
                                                  class="svg four-star-svg">
                                                  <path fill="#fc0" transform="translate(-0.001 -1.047)"
                                                       d="M9.357,1.558,11.282,5.45a.919.919,0,0,0,.692.5l4.3.624a.916.916,0,0,1,.509,1.564l-3.115,3.029a.916.916,0,0,0-.264.812l.735,4.278a.919.919,0,0,1-1.334.967l-3.85-2.02a.922.922,0,0,0-.855,0l-3.85,2.02a.919.919,0,0,1-1.334-.967l.735-4.278a.916.916,0,0,0-.264-.812L.279,8.14A.916.916,0,0,1,.789,6.576l4.3-.624a.919.919,0,0,0,.692-.5L7.71,1.558A.92.92,0,0,1,9.357,1.558Z"
                                                       id="star-svgrepo-com"></path>
                                                  <path fill="#fc0" transform="translate(20.607 -1.047)"
                                                       d="M9.357,1.558,11.282,5.45a.919.919,0,0,0,.692.5l4.3.624a.916.916,0,0,1,.509,1.564l-3.115,3.029a.916.916,0,0,0-.264.812l.735,4.278a.919.919,0,0,1-1.334.967l-3.85-2.02a.922.922,0,0,0-.855,0l-3.85,2.02a.919.919,0,0,1-1.334-.967l.735-4.278a.916.916,0,0,0-.264-.812L.279,8.14A.916.916,0,0,1,.789,6.576l4.3-.624a.919.919,0,0,0,.692-.5L7.71,1.558A.92.92,0,0,1,9.357,1.558Z"
                                                       data-name="star-svgrepo-com" id="star-svgrepo-com-2"></path>
                                                  <path fill="#fc0" transform="translate(41.215 -1.047)"
                                                       d="M9.357,1.558,11.282,5.45a.919.919,0,0,0,.692.5l4.3.624a.916.916,0,0,1,.509,1.564l-3.115,3.029a.916.916,0,0,0-.264.812l.735,4.278a.919.919,0,0,1-1.334.967l-3.85-2.02a.922.922,0,0,0-.855,0l-3.85,2.02a.919.919,0,0,1-1.334-.967l.735-4.278a.916.916,0,0,0-.264-.812L.279,8.14A.916.916,0,0,1,.789,6.576l4.3-.624a.919.919,0,0,0,.692-.5L7.71,1.558A.92.92,0,0,1,9.357,1.558Z"
                                                       data-name="star-svgrepo-com" id="star-svgrepo-com-3"></path>
                                                  <path fill="#fc0" transform="translate(61.823 -1.047)"
                                                       d="M9.357,1.558,11.282,5.45a.919.919,0,0,0,.692.5l4.3.624a.916.916,0,0,1,.509,1.564l-3.115,3.029a.916.916,0,0,0-.264.812l.735,4.278a.919.919,0,0,1-1.334.967l-3.85-2.02a.922.922,0,0,0-.855,0l-3.85,2.02a.919.919,0,0,1-1.334-.967l.735-4.278a.916.916,0,0,0-.264-.812L.279,8.14A.916.916,0,0,1,.789,6.576l4.3-.624a.919.919,0,0,0,.692-.5L7.71,1.558A.92.92,0,0,1,9.357,1.558Z"
                                                       data-name="star-svgrepo-com" id="star-svgrepo-com-4"></path>
                                                  <path fill="#e9e9e9" transform="translate(82.431 -1.047)"
                                                       d="M9.357,1.558,11.282,5.45a.919.919,0,0,0,.692.5l4.3.624a.916.916,0,0,1,.509,1.564l-3.115,3.029a.916.916,0,0,0-.264.812l.735,4.278a.919.919,0,0,1-1.334.967l-3.85-2.02a.922.922,0,0,0-.855,0l-3.85,2.02a.919.919,0,0,1-1.334-.967l.735-4.278a.916.916,0,0,0-.264-.812L.279,8.14A.916.916,0,0,1,.789,6.576l4.3-.624a.919.919,0,0,0,.692-.5L7.71,1.558A.92.92,0,0,1,9.357,1.558Z"
                                                       data-name="star-svgrepo-com" id="star-svgrepo-com-5"></path>
                                             </svg>
                                             (29,062)
                                        </div>
                                   </div>
                                   <div class="price">
                                        <!-- Giá sản phẩm -->
                                        <?php echo number_format($row['gia'], 0, ',', '.') . ' VNĐ'; ?>
                                   </div>
                                   <div class="button-container">
                                        <button class="buy-button button">Mua Ngay</button>
                                        <a href="pages/addProduct.php?action=giohang&idsp=<?php echo $row['sanpham_id'] ?>&size=37"
                                             class=" cart-button button">
                                             <i class='bx bxs-cart-add'></i>
                                        </a>
                                   </div>
                              </div>
                         </a>
                    </div>
                    <?php
                         }
                    } else {
                         // Hiển thị thông báo nếu không có sản phẩm nào
                         echo "<p>Không có sản phẩm nào.</p>";
                    }
                    ?>

               </div>
          </div>
     </div>
</main>