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
      header('Location: ../../../index.php?action=danhmuc&query=them');
      exit;
   }
} elseif (isset($_POST['btnLuu'])) {
   $tendanhmuc = $_POST['category_name'];
   $id = $_POST['category_id'];
   $sql_sua = "UPDATE danhmuc set tendanhmuc ='" . $tendanhmuc . "',danhmuc_id='" . $id . "' WHERE danhmuc_id='$_GET[id]' ";
   mysqli_query($conn, $sql_sua);
   header('location: ../../../index.php?action=danhmuc&query=them');
} else {
   $id = $_GET['id'];

   $sql_xoa = " Delete from danhmuc where danhmuc_id = '" . $id . "' ";
   mysqli_query($conn, $sql_xoa);
   header('location: ../../../index.php?action=danhmuc&query=them');
}
