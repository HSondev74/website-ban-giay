<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['size'])) {
    $get_size = $_GET['size'];
}

if (isset($_GET["soluong"])) {
    $value = $_GET["soluong"];
}


// them san pham
if (isset($_GET['idsp']) && isset($_GET['muangay'])) {
    $id = $_GET['idsp'];
    $soluong = $value;
    $sql = "SELECT * FROM sanpham WHERE sanpham_id = '$id' ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        $images = explode(',', $row['hinhanh']);
        if (!empty($images)) {
            $first_image = $images[0];
        }
        $new_product = array(
            'id' => $id,
            'hinhanh' => $first_image,
            'tensp' => $row['tensanpham'],
            'size' => $get_size,
            'soluong' => $soluong,
            'gia' => $row['gia'],
        );

        $found = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id && $cart_item['size'] == $get_size) {
                $cart_item['soluong'] += $soluong;
                $found = true;
                break;
            }
        }
        if (!$found) {
            // Nếu sản phẩm không có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
            $_SESSION['cart'][] = $new_product;
        }
    }
    // echo "<script>window.location.href = '../index.php?action=thanhtoan';</script>";
    header("Location: ../index.php?action=thanhtoan");
} elseif (isset($_GET['idsp']) && isset($_GET['them'])) {
    $id = $_GET['idsp'];
    $soluong = $value;
    $sql = "SELECT * FROM sanpham WHERE sanpham_id = '$id' ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {

        $new_product = array(
            'id' => $id,
            'hinhanh' => $row['hinhanh'],
            'tensp' => $row['tensanpham'],
            'size' => $get_size,
            'soluong' => $soluong,
            'gia' => $row['gia'],
        );

        $found = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id && $cart_item['size'] == $get_size) {
                $cart_item['soluong'] += $soluong;
                $found = true;
                break;
            }
        }
        if (!$found) {
            // Nếu sản phẩm không có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
            $_SESSION['cart'][] = $new_product;
        }
    }
    echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>";
    echo "<script>window.history.back();</script>";
}






// xoa san pham
if (isset($_SESSION['cart']) && isset($_GET['xoa']) && isset($_GET['size'])) {
    $id_to_delete = $_GET['xoa'];
    $size_to_delete = $_GET['size'];

    // Duyệt qua mảng giỏ hàng
    foreach ($_SESSION['cart'] as $key => &$cart_item) {
        if ($cart_item['id'] == $id_to_delete && $cart_item['size'] == $size_to_delete) {
            unset($_SESSION['cart'][$key]);
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']);

    header("Location: ../index.php?action=giohang");
    exit();
}



//tang so luong san pham

if (isset($_GET['increase']) && isset($_GET['size'])) {
    $id_to_increase = intval($_GET['increase']);
    $size_to_increase = $_GET['size'];

    $sql = "SELECT * FROM sanpham where sanpham_id = $id_to_increase";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $tonkho = $row['tonkho'];

    foreach ($_SESSION['cart'] as $key => &$cart_item) {
        if ($cart_item['id'] == $id_to_increase && $cart_item['size'] == $size_to_increase) {
            if ($cart_item['soluong'] < $tonkho) {
                $cart_item['soluong']++;
            }
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect back
    exit();
}
//giam so luong san pham

if (isset($_GET['decrease']) && isset($_GET['size'])) {
    $id_to_delete = $_GET['decrease'];
    $size_to_delete = $_GET['size'];

    // Duyệt qua mảng giỏ hàng
    foreach ($_SESSION['cart'] as $key => &$cart_item) {
        // Kiểm tra xem id của sản phẩm có trùng với id cần xóa không
        if ($cart_item['id'] == $id_to_delete && $cart_item['size'] == $size_to_delete) {
            // Xóa 1 sản phẩm khỏi giỏ hàng
            $cart_item['soluong']--;
            if ($cart_item['soluong'] <= 0) {
                unset($_SESSION['cart'][$key]);
            }
            break; // Sau khi giảm số lượng, thoát khỏi vòng lặp
        }
    }
    // Cập nhật lại session giỏ hàng sau khi giảm số lượng
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác tùy thuộc vào yêu cầu của bạn
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng
}
