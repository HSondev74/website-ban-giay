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

$tensp = $_POST['tensanpham'];
$gia = $_POST['gia'];
$gia_bien_doi = str_replace(".", "", $gia);
$tonkho = $_POST['tonkho'];
$mota = $_POST['mota'];
$size = $_POST['size'];
// Chuỗi chứa tất cả các kích thước, phân tách bằng dấu phẩy
$all_sizes = implode(',', $_POST['size']);
$danhmuc_id = $_POST['danhmuc_id'];
// xử lý hình ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;
// Xử lý dữ liệu từ form
if (isset($_POST['addSanpham'])) {
  // Làm sạch dữ liệu trước khi chèn vào câu truy vấn SQL
  $tensp_cleaned = mysqli_real_escape_string($conn, $tensp);
  $size_cleaned = mysqli_real_escape_string($conn, $all_sizes);
  $mota_cleaned = mysqli_real_escape_string($conn, $mota);

  // Sử dụng htmlspecialchars để mã hóa dữ liệu nhập vào
  $tensp_safe = htmlspecialchars($tensp_cleaned);
  $size_safe = htmlspecialchars($size_cleaned);
  $mota_safe = htmlspecialchars($mota_cleaned);

  // Câu truy vấn INSERT với dữ liệu đã làm sạch và mã hóa
  $sql = " INSERT INTO sanpham (tensanpham, size, gia, hinhanh, tonkho, danhmuc_id, mota) VALUES ('$tensp_safe', '$size_safe', '$gia_bien_doi', '$hinhanh', '$tonkho', '$danhmuc_id', '$mota_safe')";

  // Thực thi câu truy vấn SQL
  mysqli_query($conn, $sql);

  // Xử lý và lưu trữ tệp
  move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

  // Thông báo thành công và chuyển hướng
  echo "<script>alert('Bạn đã thêm thành công!');
      window.location.href='../../../index.php?action=sanpham&query=them';
      </script>";
} elseif (isset($_POST['editsp'])) {
  // Xử lý hình ảnh
  if ($_FILES['hinhanh']['name']) {
    $hinhanh = time() . '_' . $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
  }

  // Xử lý dữ liệu trường size[] từ form
  $size_safe = '';
  if (!empty($_POST['size'])) {
    $size_safe = implode(',', $_POST['size']);
  }

  // Tạo câu truy vấn để cập nhật sản phẩm
  $sql_sua = "UPDATE sanpham 
                SET tensanpham = '$tensp',
                    size = '$size_safe',
                    gia = '$gia_bien_doi',
                    tonkho = '$tonkho',
                    danhmuc_id = '$danhmuc_id',
                    mota = '$mota'";

  // Nếu có hình ảnh từ form, thêm cập nhật cột hinhanh vào câu truy vấn
  if ($_FILES['hinhanh']['name']) {
    $sql_sua .= ", hinhanh = '$hinhanh'";
  }

  // Thêm điều kiện WHERE cho câu truy vấn
  $sql_sua .= " WHERE sanpham_id = '" . $_GET['id'] . "'";

  // Thực thi câu truy vấn
  mysqli_query($conn, $sql_sua);

  // Hiển thị thông báo và chuyển hướng
  echo "<script>alert('Bạn đã sửa thành công!');
      window.location.href='../../../index.php?action=sanpham&query=them'
      </script>";
  exit;
} else {
  $id = $_GET['id'];
  $sql = "select * from sanpham where sanpham_id = '$id' Limit 1";
  $query = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($query)) {
    unlink('uploads/' . $row['hinhanh']);
  }
  $sql_xoa = " Delete from sanpham where sanpham_id = '" . $id . "' ";
  mysqli_query($conn, $sql_xoa);
  echo "<script>alert('Bạn đã xóa thành công!')
      window.location.href='../../../index.php?action=sanpham&query=them'
      </script>";
}
