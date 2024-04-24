<div id="breadcrumb" class="container">
    <?php
    // Lấy tên trang hiện tại từ URL
    $current_page = basename($_SERVER['PHP_SELF']);
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Mảng chứa các thông tin breadcrumb
    $breadcrumbs = array(
        'index.php' => 'Trang Chủ',
        'index.php?action=sanpham' => 'Sản phẩm',
        'index.php?action=lienhe' => 'Liên Hệ',
        'index.php?action=gioithieu' => 'Tuyển Dụng',
        'index.php?action=giohang' => 'Giỏ Hàng',
        'index.php?action=login' =>  'Đăng nhập',
        'index.php?action=logup' =>  'Đăng ký',
        'index.php?action=thanhtoan' => 'Thanh toán',
        'index.php?action=account' => 'Tài khoản',
        'index.php?action=search' => 'Tìm kiếm',
        'index.php?action=donhang' => 'Đơn hàng'
    );

    // Hiển thị breadcrumb
    if (array_key_exists($current_page, $breadcrumbs)) {
        $trangchu =  $breadcrumbs[$current_page];
        $trangchu_href = 'index.php';
        // Nếu có tham số action, thêm breadcrumb cho tham số đó
        if ($action && array_key_exists("index.php?action=$action", $breadcrumbs)) {
            echo  "<a href='$trangchu_href'>$trangchu</a>" . ' &gt; ' . $breadcrumbs["index.php?action=$action"];
        }


        if (isset($_GET['category'])) {
            $category_ids_str = $_GET['category'];  // Chuỗi category, có thể chứa nhiều giá trị
            $category_ids = explode(',', $category_ids_str);  // Chuyển thành mảng
            $category_ids = array_map('intval', $category_ids);  // Đảm bảo tất cả các giá trị là số

            // Truy vấn cơ sở dữ liệu để lấy tên danh mục cho tất cả category_id
            $sql_category_names = "SELECT tendanhmuc FROM danhmuc WHERE danhmuc_id IN (" . implode(',', $category_ids) . ")";
            $result_category_names = mysqli_query($conn, $sql_category_names);

            // Kiểm tra nếu có kết quả
            if (mysqli_num_rows($result_category_names) > 0) {
                $category_names = array();  // Mảng để lưu tên danh mục
                while ($row = mysqli_fetch_assoc($result_category_names)) {
                    $category_names[] = $row['tendanhmuc'];  // Thêm tên vào mảng
                }
                // In tất cả các tên danh mục
                echo ' &gt ' . implode(' - ', $category_names);  // Nối các tên bằng ' &gt '
            }
        }



        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $sql_id = "SELECT * FROM sanpham WHERE sanpham_id = $product_id  ";
            $result_id = mysqli_query($conn, $sql_id);
            if (mysqli_num_rows($result_id) > 0) {
                $product = mysqli_fetch_assoc($result_id);
                if (isset($product['danhmuc_id'])) {
                    $danhmuc_id = $product['danhmuc_id'];
                    $sql_danhmuc = "SELECT * FROM danhmuc where danhmuc_id = $danhmuc_id";
                    $result_danhmuc = mysqli_query($conn, $sql_danhmuc);
                    if (mysqli_num_rows($result_danhmuc) > 0) {
                        $danhmuc = mysqli_fetch_assoc($result_danhmuc);
                        echo  "<a href='$trangchu_href'>$trangchu</a>" . ' &gt ' . $danhmuc['tendanhmuc'] . ' &gt ' . $product['tensanpham'];
                    }
                }
            }
        }
    }




    ?>
</div>