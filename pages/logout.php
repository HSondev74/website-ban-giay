<?php
// Bắt đầu phiên
session_start();

// Kiểm tra xem người dùng đã nhấp vào liên kết đăng xuất hay chưa
if (isset($_SESSION['dangnhap'])) {
     // Hủy phiên bằng cách xóa tất cả các biến phiên
     session_unset();

     // Hủy phiên hiện tại
     session_destroy();

     echo "<script>window.history.back();</script>";
     exit;
}
