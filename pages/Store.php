<?php
$options1 = ["0", "500000", "1000000", "2000000", "3000000", "4000000", "5000000", "6000000", "7000000", "8000000", "9000000", "10000000", "15000000", "20000000"];
$options2 = ["500000", "1000000", "2000000", "3000000", "4000000", "5000000", "6000000", "7000000", "8000000", "9000000", "10000000", "15000000", "20000000"];

$products_per_page = 12;
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start_index = ($current_page - 1) * $products_per_page;

// Truy vấn tất cả các danh mục
$sql = "SELECT * FROM danhmuc";
$result = mysqli_query($conn, $sql);

$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

// Xây dựng SQL truy vấn sản phẩm
$sql = "SELECT * FROM sanpham";
$sql_conditions = array();  // Mảng chứa các điều kiện truy vấn

// Thêm điều kiện theo danh mục nếu có
if (isset($_GET['category'])) {
    $category_ids = array_map('intval', explode(',', $_GET['category']));
    $sql_conditions[] = "danhmuc_id IN (" . implode(',', $category_ids) . ")";
}

// Thêm điều kiện theo giá nếu có
if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
    $min_price = intval($_GET['min_price']);
    $max_price = intval($_GET['max_price']);
    $sql_conditions[] = "gia BETWEEN $min_price AND $max_price";
}

// Thêm điều kiện truy vấn nếu có
if (count($sql_conditions) > 0) {
    $sql .= " WHERE " . implode(' AND ', $sql_conditions);
}

// Sắp xếp sản phẩm nếu có lựa chọn sắp xếp
if (isset($_GET['sort'])) {
    $sort_option = $_GET['sort'];
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
        default:
            // Xử lý giá trị không hợp lệ hoặc không xác định
            $sql .= " ORDER BY tensanpham";  // Mặc định
            break;
    }
}

// Thêm phân trang
$sql .= " LIMIT $start_index, $products_per_page";

// Thực hiện truy vấn SQL để lấy sản phẩm
$result = mysqli_query($conn, $sql);
?>


<div class="container " id="main">

    <div class="hidden-search-item-prd">
        <div>Sắp xếp theo</div>
        <form method="GET" action="index.php?action=sanpham">
            <select name="sort" id="sort-select" class="search-in4-item" onchange="updateQuery(this)">
                <option value="">Mặc định</option>
                <option value="latest">Mặt hàng mới nhất</option>
                <option value="az">A > Z</option>
                <option value="za">Z > A</option>
                <option value="price_asc">Giá tăng dần</option>
                <option value="price_desc">Giá giảm dần</option>
            </select>
            <!-- <input type="submit" value="Sắp xếp" /> -->
        </form>
    </div>

    <div class="flex-store">
        <div class="filter-product">
            <div class="in4-prd">
                <h4>THƯƠNG HIỆU</h4>
                <br />
                <div class="name-prd">
                    <form method="post" action="index.php?action=sanpham" id="filter-form">
                        <?php
                        // Kiểm tra xem có tham số GET hoặc POST 'category'
                        $selected_categories = [];

                        if (isset($_GET['category'])) {
                            // Nếu tham số 'category' trong GET, tách thành mảng
                            $selected_categories = explode(',', $_GET['category']);
                        } elseif (isset($_POST['category'])) {
                            // Nếu có trong POST, sử dụng mảng này
                            $selected_categories = $_POST['category'];
                        }

                        // Hiển thị các danh mục
                        foreach ($categories as $category) :
                            $is_checked = in_array($category['danhmuc_id'], $selected_categories); // Kiểm tra xem có trong mảng đã chọn không
                        ?>
                            <div class="brand-name">
                                <input type="checkbox" id="<?php echo $category['danhmuc_id']; ?>" name="category[]" value="<?php echo $category['danhmuc_id']; ?>" <?php if ($is_checked) echo 'checked'; ?> />
                                <label for="<?php echo $category['danhmuc_id']; ?>"><?php echo $category['tendanhmuc']; ?></label>
                            </div>
                        <?php endforeach; ?>

                        <br>
                        <h4>Giá từ</h4>
                        <select name="min_price_select" class="filter-input">
                            <?php
                            // Kiểm tra giá trị được chọn trong GET hoặc POST
                            $selected_min_price = isset($_GET['min_price']) ? $_GET['min_price'] : (isset($_POST['min_price_select']) ? $_POST['min_price_select'] : null);

                            foreach ($options1 as $option) :
                                $is_selected = ($option == $selected_min_price); // Kiểm tra giá trị đã chọn
                            ?>
                                <option value="<?php echo $option; ?>" <?php if ($is_selected) echo 'selected'; ?>><?php echo number_format($option, 0, '', '.') . 'đ'; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <h4>Đến</h4>
                        <select name="max_price_select" class="filter-input">
                            <?php
                            $selected_max_price = isset($_GET['max_price']) ? $_GET['max_price'] : (isset($_POST['max_price_select']) ? $_POST['max_price_select'] : null);

                            foreach ($options2 as $option) :
                                $is_selected = ($option == $selected_max_price); // Kiểm tra giá trị đã chọn
                            ?>
                                <option value="<?php echo $option; ?>" <?php if ($is_selected) echo 'selected'; ?>><?php echo number_format($option, 0, '', '.') . 'đ'; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <input type="submit" name="loc" value="Lọc sản phẩm" class="btn-prd-price" />
                    </form>


                </div>
            </div>

        </div>

        <div class="down-product">
            <div class="contents-products">
                <?php

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
                } ?>



            </div>

            <div class="pagination">
                <?php
                $sql_count = "SELECT COUNT(*) AS total FROM sanpham";

                // If category filter is applied, add it to the SQL condition
                if (isset($_GET['category'])) {
                    $id_cate_str = implode(',', array_map('intval', explode(',', $_GET['category'])));
                    $sql_count .= " WHERE danhmuc_id IN ($id_cate_str)";
                }

                // Add price filtering with proper handling of `WHERE` or `AND`
                if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
                    $min_price = intval($_GET['min_price']);
                    $max_price = intval($_GET['max_price']);

                    if (strpos($sql_count, 'WHERE') !== false) {
                        // If `WHERE` exists, use `AND`
                        $sql_count .= " AND gia BETWEEN $min_price AND $max_price";
                    } else {
                        $sql_count .= " WHERE gia BETWEEN $min_price AND $max_price";
                    }
                }

                // Get the total number of products with the specified conditions
                $result_count = mysqli_query($conn, $sql_count);
                $row_count = mysqli_fetch_assoc($result_count);
                $total_pages = ceil($row_count['total'] / $products_per_page);

                // Get all existing GET parameters to maintain context while paginating
                // Retain existing GET parameters
                $query_params = $_GET;


                // Tạo liên kết phân trang
                if ($current_page > 3) {
                    $query_params['page'] = 1;
                    $query_string = http_build_query($query_params);
                    echo "<a href='?{$query_string}'>First</a> ";
                }

                if ($current_page > 1) {
                    $query_params['page'] = $current_page - 1;
                    $query_string = http_build_query($query_params);
                    echo "<a href='?{$query_string}'>Prev</a> ";
                }

                // Create page links with condition to display a limited number around the current page
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i != $current_page && $i > $current_page - 2 && $i < $current_page + 2) {
                        $query_params['page'] = $i;
                        $query_string = http_build_query($query_params);
                        echo "<a href='?{$query_string}'>$i</a> ";
                    } elseif ($i == $current_page) {
                        echo "<strong class = 'hover-page'>$i</strong> "; // Current page highlighted
                    }
                }

                // Add "Next" and "Last" buttons if not on the last few pages
                if ($current_page < $total_pages) {
                    $query_params['page'] = $current_page + 1;
                    $query_string = http_build_query($query_params);
                    echo "<a href='?{$query_string}'>Next</a> ";
                }

                if ($current_page < $total_pages - 3) {
                    $query_params['page'] = $total_pages;
                    $query_string = http_build_query($query_params);
                    echo "<a href='?{$query_string}'>Last</a> ";
                }

                ?>
            </div>
        </div>
    </div>
</div>




</div>

<script>
    document.getElementById("filter-form").onsubmit = function(event) {
        // Lấy URL hành động hiện tại
        var action = this.action;

        // Lấy các danh mục được chọn
        var selectedCategories = [];
        var categoryInputs = this.querySelectorAll('input[name="category[]"]:checked');
        categoryInputs.forEach(function(input) {
            selectedCategories.push(input.value);
        });

        // Lấy giá trị tối thiểu và tối đa
        var minPrice = this.querySelector('select[name="min_price_select"]').value;
        var maxPrice = this.querySelector('select[name="max_price_select"]').value;

        // Xây dựng URL hành động mới với tham số truy vấn
        var newAction = action;

        if (selectedCategories.length > 0) {
            // Sử dụng encodeURIComponent để mã hóa đúng cách
            newAction += "&category=" + encodeURIComponent(selectedCategories.join(","));
        }

        // Mã hóa giá trị giá cả
        newAction += "&min_price=" + encodeURIComponent(minPrice) + "&max_price=" + encodeURIComponent(maxPrice);

        // Đặt hành động mới cho biểu mẫu
        this.action = newAction;
    };

    function updateQuery(selectElement) {
        const selectedValue = selectElement.value; // Lấy giá trị mới từ hộp chọn
        const currentUrl = new URL(window.location); // Lấy URL hiện tại
        currentUrl.searchParams.set("sort", selectedValue); // Đặt tham số 'sort' mới
        window.location.href = currentUrl.toString(); // Chuyển hướng tới URL mới
    }

    const sortSelect = document.getElementById("sort-select");
    const currentUrl = new URL(window.location); // Lấy URL hiện tại
    const currentSort = currentUrl.searchParams.get("sort"); // Đọc giá trị 'sort'

    if (currentSort) {
        // Đặt giá trị cho hộp chọn dựa trên tham số 'sort'
        for (let i = 0; i < sortSelect.options.length; i++) {
            if (sortSelect.options[i].value === currentSort) {
                sortSelect.selectedIndex = i; // Đặt giá trị đã chọn
                break;
            }
        }
    }
</script>