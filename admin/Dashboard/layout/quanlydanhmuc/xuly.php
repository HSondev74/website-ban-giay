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
      window.location.href='../../../index.php?action=danhmuc&query=them'
      </script>";
      exit;
   }
} elseif (isset($_POST['btnLuu'])) {
   $tendanhmuc = $_POST['category_name'];
   $id = $_POST['category_id'];
   $sql_sua = "UPDATE danhmuc set tendanhmuc ='" . $tendanhmuc . "',danhmuc_id='" . $id . "' WHERE danhmuc_id='$_GET[id]' ";
   mysqli_query($conn, $sql_sua);
   echo "<script>alert('Bạn đã lưu thành công!')
      window.location.href='../../../index.php?action=danhmuc&query=them'
      </script>";
} else {
   $id = $_GET['id'];

   // Truy vấn SELECT để lấy ra sanpham_id
   $sql_sp = "SELECT sanpham_id
           FROM sanpham
           WHERE danhmuc_id = '" . $id . "' ";

   $result = mysqli_query($conn, $sql_sp);

   // Trích xuất sanpham_id từ kết quả của truy vấn SELECT
   $row = mysqli_fetch_assoc($result);
   $sanpham_id = $row['sanpham_id'];

   // Xây dựng các truy vấn DELETE sử dụng sanpham_id đã trích xuất
   $sql_xoa_giohang =  " DELETE FROM `giohang` WHERE sanpham_id = '" . $sanpham_id . "' ";
   $sql_xoa_danhsachyeuthich = " DELETE FROM `danhsachyeuthich` WHERE sanpham_id = '" . $sanpham_id . "' ";
   $sql_xoa_donhang = " DELETE FROM `donhang` WHERE sanpham_id = '" . $sanpham_id . "' ";
   $sql_xoa_sanpham = " DELETE FROM sanpham WHERE danhmuc_id = '" . $id . "' ";
   $sql_xoa = " DELETE FROM danhmuc WHERE danhmuc_id = '" . $id . "' ";

   // Thực thi các truy vấn DELETE
   mysqli_query($conn, $sql_xoa_giohang);
   mysqli_query($conn, $sql_xoa_danhsachyeuthich);
   mysqli_query($conn, $sql_xoa_donhang);
   mysqli_query($conn, $sql_xoa_sanpham);
   mysqli_query($conn, $sql_xoa);

   echo "<script>alert('Bạn đã xóa thành công!')
      window.location.href='../../../index.php?action=danhmuc&query=them'
      </script>";
}
