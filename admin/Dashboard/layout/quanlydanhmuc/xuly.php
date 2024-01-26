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
      echo '<script type="text/javascript">alert("Bạn đã thêm thành công") </script>';
      header('Location: ../../../index.php?action=danhmuc');
      exit; // Kết thúc script sau khi chuyển hướng
   } else {
      echo '<script type="text/javascript">alert("Thêm chưa thành công") </script>';
   }
}
