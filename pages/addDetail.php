<?php
session_start(); // Bắt buộc bắt đầu session trước khi sử dụng $_SESSION

// Kiểm tra xem session 'cartDetail' đã tồn tại chưa
if (!isset($_SESSION['cartDetail'])) {
     $_SESSION['cartDetail'] = array(); // Nếu chưa, khởi tạo là một mảng rỗng
}

// Giảm số lượng
if (isset($_GET['decrease']) && isset($_SESSION['cartDetail'][$_GET['decrease']])) {
     $_SESSION['cartDetail'][$_GET['decrease']]['soluong'] -= 1;
     // Đảm bảo số lượng không bị âm
     if ($_SESSION['cartDetail'][$_GET['decrease']]['soluong'] < 0) {
          $_SESSION['cartDetail'][$_GET['decrease']]['soluong'] = 0;
     }
}

// Tăng số lượng
if (isset($_GET['increase']) && isset($_SESSION['cartDetail'][$_GET['increase']])) {
     $_SESSION['cartDetail'][$_GET['increase']]['soluong'] += 1;
}

echo "<script>window.history.back();</script>";
exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng