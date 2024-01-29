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
$danhmuc_id = $_POST['danhmuc_id'];
// xử lý hình ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;
// Xử lý dữ liệu từ form
if (isset($_POST['addSanpham'])) {
  $sql = "INSERT INTO sanpham (tensanpham,size,gia,hinhanh,tonkho,danhmuc_id,mota) VALUE ('" . $tensp . "','" . $size . "','" . $gia_bien_doi . "','" . $hinhanh . "','" . $tonkho . "','" . $danhmuc_id . "','" . $mota . "')";
  mysqli_query($conn, $sql);
  // Xử lý và lưu trữ tệp
  move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
  echo "<script>alert('Bạn đã thêm thành công!')
  window.location.href='../../../index.php?action=sanpham&query=them'
  </script>";
} elseif (isset($_POST['editsp'])) {
  // Kiểm tra xem có dữ liệu hình ảnh từ form không
  if ($_FILES['hinhanh']['name']) {
    // Xử lý hình ảnh
    $hinhanh = time() . '_' . $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

    $sql_sua = "UPDATE sanpham 
                  SET tensanpham = '" . $tensp . "',
                      size = '" . $size . "',
                      gia = '" . $gia_bien_doi . "',
                      hinhanh = '" . $hinhanh . "',
                      tonkho = '" . $tonkho . "',
                      danhmuc_id = '" . $danhmuc_id . "',
                      mota = '" . $mota . "' 
                  WHERE sanpham_id = '" . $_GET['id'] . "'";
  } else {
    // Nếu không có hình ảnh từ form
    $sql_sua = "UPDATE sanpham 
                  SET tensanpham = '" . $tensp . "',
                      size = '" . $size . "',
                      gia = '" . $gia_bien_doi . "',
                      tonkho = '" . $tonkho . "',
                      danhmuc_id = '" . $danhmuc_id . "',
                      mota = '" . $mota . "' 
                  WHERE sanpham_id = '" . $_GET['id'] . "'";
  }

  mysqli_query($conn, $sql_sua);
  echo "<script>alert('Bạn đã sửa thành công!')
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
