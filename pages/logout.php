<?php
// Bắt đầu phiên
session_start();

if (isset($_SESSION['dangnhap'])) {
     session_unset();
     session_destroy();
     echo "<script>window.history.back();</script>";
     exit;
}
