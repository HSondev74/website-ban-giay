<?php
include('../includes/config.php');

session_start(); // Khởi động phiên session
if (isset($_SESSION['cart']) && !empty($_SESSION['dangnhap'])) {
     if (isset($_SESSION['dangnhap']) && !empty($_SESSION['dangnhap'])) {


          // Xử lý POST Data khi form được submit
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $email = $_POST['email'];
               $ten = $_POST['ten'];
               $sodth = $_POST['sodth'];
               $tinh_thanh = $_POST['tinh_thanh'];
               $quan_huyen = $_POST['quan_huyen'];
               $phuong_xa = $_POST['phuong_xa'];
               $ghi_chu = $_POST['ghi_chu'];
               $phuong_thuc_thanh_toan = isset($_POST['payment-method']) ? $_POST['payment-method'] : '';

               // Kiểm tra và khởi tạo giỏ hàng
               if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array(); // Tạo một giỏ hàng mới nếu chưa tồn tại
               }

               // Lấy thông tin sản phẩm từ giỏ hàng
               $sanpham_id = array();
               $gia = array();
               $size = array();
               $soluong = array();

               if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $product) {
                         $sanpham_id[] = $product['id'];
                         $gia[] = $product['gia'];
                         $size[] = $product['size'];
                         $soluong[] = $product['soluong'];
                    }
               }

               // Chèn dữ liệu vào bảng đơn hàng với mỗi sản phẩm là một dòng
               $ngaydat = date('Y-m-d'); // Lấy ngày hiện tại
               $diachi = "$tinh_thanh - $quan_huyen - $phuong_xa";

               foreach ($_SESSION['cart'] as $index => $product) {
                    $sanpham_id = $product['id'];
                    $gia = $product['gia'];
                    $size = $product['size'];
                    $soluong = $product['soluong'];

                    $sql = "INSERT INTO donhang (ten, email, diachi, sanpham_id, gia, size, phuongthucthanhtoan, soluong, ngaydat) 
                  VALUES ('$ten', '$email', '$diachi', '$sanpham_id', '$gia', '$size', '$phuong_thuc_thanh_toan', '$soluong', '$ngaydat')";

                    if (mysqli_query($conn, $sql)) {
                         echo  "<script>alert('Đơn hàng của bạn đã được đặt thành công!')</script>";
                         echo "<script>window.location.href = '../index.php?action=giohang';</script>";
                         unset($_SESSION['cart'][$index]);
                    } else {
                         echo "Đơn hàng của sản phẩm $sanpham_id không thể được đặt!<br>";
                    }
               }
          }
     } else {
          header('location: ../index.php?action=login');
     }
} else {
     header('location: ../index.php?action=cuahang');
}
