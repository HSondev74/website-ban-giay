<?php
session_start();
include('../includes/config.php');


//tang so luong san pham

if (isset($_GET['increase'])) {
     $id_to_delete = $_GET['increase'];

     // Duyệt qua mảng giỏ hàng
     foreach ($_SESSION['cart'] as $key => &$cart_item) {
          // Kiểm tra xem id của sản phẩm có trùng với id cần xóa không
          if ($cart_item['id'] == $id_to_delete) {
               // Xóa 1 sản phẩm khỏi giỏ hàng
               $cart_item['soluong']++;
               if ($cart_item['soluong'] <= 0) {
                    unset($_SESSION['cart'][$key]);
               }
               break; // Sau khi giảm số lượng, thoát khỏi vòng lặp
          }
     }
     // Cập nhật lại session giỏ hàng sau khi giảm số lượng
     $_SESSION['cart'] = array_values($_SESSION['cart']);

     // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác tùy thuộc vào yêu cầu của bạn
     echo "<script>window.history.back();</script>";
     exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng
}
//giam so luong san pham

if (isset($_GET['decrease'])) {
     $id_to_delete = $_GET['decrease'];

     // Duyệt qua mảng giỏ hàng
     foreach ($_SESSION['cart'] as $key => &$cart_item) {
          // Kiểm tra xem id của sản phẩm có trùng với id cần xóa không
          if ($cart_item['id'] == $id_to_delete) {
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
     echo "<script>window.history.back();</script>";
     exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng
}

// xoa san pham

// Kiểm tra xem session 'cart' có tồn tại và xem có yêu cầu xóa sản phẩm không
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
     $id_to_delete = $_GET['xoa'];

     // Duyệt qua mảng giỏ hàng
     foreach ($_SESSION['cart'] as $key => &$cart_item) {
          // Kiểm tra xem id của sản phẩm có trùng với id cần xóa không
          if ($cart_item['id'] == $id_to_delete) {
               // Xóa sản phẩm khỏi giỏ hàng
               unset($_SESSION['cart'][$key]);
               // Sau khi xóa, bạn có thể thêm các xử lý khác nếu cần
          }
     }

     // Cập nhật lại session giỏ hàng sau khi xóa
     $_SESSION['cart'] = array_values($_SESSION['cart']);

     // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác tùy thuộc vào yêu cầu của bạn
     header("Location: ../index.php?action=giohang");
     exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng
}

// them san pham
if(isset($_GET['idsp'])&&isset($_GET['muangay'])) {
     $id = $_GET['idsp'];
     $soluong = 1;
     $sql = "SELECT * FROM sanpham WHERE sanpham_id = '$id' ";
     $query = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($query);
     if ($row) {
          $new_product = array(
               'tensp' => $row['tensanpham'],
               'soluong' => $soluong,
               // 'size' => $row['size'],
               'id' => $id,
               'gia' => $row['gia'],
               'hinhanh' => $row['hinhanh']
          );
          if (isset($_SESSION['cart'])) {
               $found = false;
               foreach ($_SESSION['cart'] as &$cart_item) {
                    if ($cart_item['id'] == $id) {
                         // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
                         $cart_item['soluong'] += $soluong;
                         $found = true;
                         break;
                    }
               }
               if (!$found) {
                    // Nếu sản phẩm không có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
                    $_SESSION['cart'][] = $new_product;
               }
          } else {
               // Nếu giỏ hàng không tồn tại, tạo giỏ hàng mới và thêm sản phẩm vào
               $_SESSION['cart'][] = $new_product;
          }
     }
    
     echo "<script>window.location.href = '../index.php?action=giohang';</script>";
}else if(isset($_GET['idsp']) && isset($_GET['size'])){
     $checkoutSize = $_GET['size'];
     $id = $_GET['idsp'];
     $soluong = 1;
     $sql = "SELECT * FROM sanpham WHERE sanpham_id = '$id' ";
     $query = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($query);
 
     if ($row) {
         $found = false;
 
         // Duyệt qua mảng giỏ hàng
         foreach ($_SESSION['cart'] as &$cart_item) {
             // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
             if ($cart_item['id'] == $id) {
                 // Nếu sản phẩm đã có trong giỏ hàng
                 if ($cart_item['size'] == $checkoutSize) {
                     // Nếu có cùng kích thước, tăng số lượng
                     $cart_item['soluong'] += $soluong;
                     $found = true;
                     break;
                 } else {
                     // Nếu có kích thước khác, thêm sản phẩm mới vào giỏ hàng
                     $new_product = array(
                         'tensp' => $row['tensanpham'],
                         'soluong' => $soluong,
                         'size' => $checkoutSize,
                         'id' => $id,
                         'gia' => $row['gia'],
                         'hinhanh' => $row['hinhanh']
                     );
                     $_SESSION['cart'][] = $new_product;
                     $found = true;
                     break;
                 }
             }
         }
 
         if (!$found) {
             // Nếu sản phẩm không có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
             $new_product = array(
                 'tensp' => $row['tensanpham'],
                 'soluong' => $soluong,
                 'size' => $checkoutSize,
                 'id' => $id,
                 'gia' => $row['gia'],
                 'hinhanh' => $row['hinhanh']
             );
             $_SESSION['cart'][] = $new_product;
         }
 
         // Hiển thị thông báo thông qua JavaScript và quay lại trang trước đó
         echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>";
         echo "<script>window.history.back();</script>";
     }
 }
 
 
 



