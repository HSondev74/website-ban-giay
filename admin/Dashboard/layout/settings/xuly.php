<?php
// Tạo kết nối
$conn = mysqli_connect("localhost", "root", "", "websitebangiay");

// Kiểm tra kết nối
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $user = $_POST['username'];
  $email = $_POST['email'];
  $new_password = $_POST['new-password'];
  $submit = $_POST['submit'];

  // Kiểm tra xem có tệp ảnh được tải lên không
  if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image = time() . '_' . $image;
    move_uploaded_file($image_tmp, 'uploads/' . $image);
  } else {
    // Nếu không có ảnh mới được tải lên, giữ nguyên ảnh cũ
    $sql = "SELECT hinhanh FROM nguoidung WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $image = $row['hinhanh'];
  }

  if ($submit == "submit") {
    // Cập nhật thông tin người dùng trong bảng nguoidung
    $sql_nguoidung = "UPDATE nguoidung SET ten=?, email=?, matkhau=?, hinhanh=? WHERE user_id=?";
    $stmt_nguoidung = mysqli_prepare($conn, $sql_nguoidung);
    mysqli_stmt_bind_param($stmt_nguoidung, "ssssi", $user, $email, $new_password, $image, $id);
    mysqli_stmt_execute($stmt_nguoidung);

    // Cập nhật thông tin người dùng trong bảng donhang
    $sql_donhang = "UPDATE donhang SET ten_nguoidung=?, email_nguoidung=? WHERE user_id=?";
    $stmt_donhang = mysqli_prepare($conn, $sql_donhang);
    mysqli_stmt_bind_param($stmt_donhang, "ssi", $user, $email, $id);
    mysqli_stmt_execute($stmt_donhang);

    // Cập nhật thông tin người dùng trong bảng danhsachyeuthich
    $sql_danhsachyeuthich = "UPDATE danhsachyeuthich SET ten_nguoidung=?, email_nguoidung=? WHERE user_id=?";
    $stmt_danhsachyeuthich = mysqli_prepare($conn, $sql_danhsachyeuthich);
    mysqli_stmt_bind_param($stmt_danhsachyeuthich, "ssi", $user, $email, $id);
    mysqli_stmt_execute($stmt_danhsachyeuthich);

    // Cập nhật thông tin người dùng trong bảng giohang
    $sql_giohang = "UPDATE giohang SET ten_nguoidung=?, email_nguoidung=? WHERE user_id=?";
    $stmt_giohang = mysqli_prepare($conn, $sql_giohang);
    mysqli_stmt_bind_param($stmt_giohang, "ssi", $user, $email, $id);
    mysqli_stmt_execute($stmt_giohang);
  } elseif ($submit == "delete") {
    // Xóa người dùng và các thông tin liên quan trong các bảng khác nếu cần
    // Ví dụ:
    // $sql_delete_other_table = "DELETE FROM other_table WHERE user_id=?";
    // $stmt_delete_other_table = mysqli_prepare($conn, $sql_delete_other_table);
    // mysqli_stmt_bind_param($stmt_delete_other_table, "i", $id);
    // mysqli_stmt_execute($stmt_delete_other_table);

    $sql_nguoidung = "DELETE FROM nguoidung WHERE user_id=?";
    $stmt_nguoidung = mysqli_prepare($conn, $sql_nguoidung);
    mysqli_stmt_bind_param($stmt_nguoidung, "i", $id);
    mysqli_stmt_execute($stmt_nguoidung);
  }

  // Kiểm tra kết quả truy vấn
  echo "<script>alert('Bạn đã sửa thành công!')</script>";
  echo "<script>window.location.href='../../../index.php?action=setting&query=them'</script>";
  exit;
}
