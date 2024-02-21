<?php
// Bắt đầu phiên
session_start();

// Kiểm tra xem người dùng đã nhấp vào liên kết đăng xuất hay chưa
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
     // Hủy phiên bằng cách xóa tất cả các biến phiên
     session_unset();

     // Hủy phiên hiện tại
     session_destroy();

     // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính sau khi đăng xuất
     header("Location: index.php"); // Thay 'index.php' bằng URL của trang đăng nhập hoặc trang chính
     exit;
}
