<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "websitebangiay";

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $database);

// Kiểm tra
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
// Xử lý dữ liệu từ form
if (isset($_POST['btnSave'])) {
   $tendanhmuc = $_POST['cate_name'];
   $sql = "INSERT INTO danhmuc (tendanhmuc) VALUES ('$tendanhmuc')";

   if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Bạn đã thêm thành công!')
      window.location.href='../../../index.php?action=danhmuc'
      </script>";
      exit;
   }
} elseif (isset($_POST['btnLuu'])) {
   $tendanhmuc = $_POST['category_name'];
   $id = $_POST['category_id'];
   $sql_sua = "UPDATE danhmuc set tendanhmuc ='" . $tendanhmuc . "',danhmuc_id='" . $id . "' WHERE danhmuc_id='$_GET[id]' ";
   mysqli_query($conn, $sql_sua);
   echo "<script>alert('Bạn đã lưu thành công!')
      window.location.href='../../../index.php?action=danhmuc'
      </script>";
} 
