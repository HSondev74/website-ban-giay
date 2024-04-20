<?php
include('../includes/config.php');
session_start();
if (isset($_GET['user-id'])) {
    $user_id = $_GET['user-id'];
}

if (isset($_POST['update-profile'])) {
    if (isset($_POST['name-user']) && isset($_POST['email-user']) && isset($_POST['phone-user'])) {
        // Sanitize user inputs
        $_SESSION['dangnhap'] = $_POST['name-user'];

        $name = mysqli_real_escape_string($conn, $_POST['name-user']);
        $email = mysqli_real_escape_string($conn, $_POST['email-user']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone-user']);

        // Prepare the SQL query
        $sql = "UPDATE nguoidung SET ten = '$name', email = '$email', sodienthoai = '$phone' WHERE user_id = '$user_id'";


        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>
            window.location.href = '../index.php?action=account&view=account';
            alert('Cập nhật thành công');
            </script>";
        } else {
            echo "Cập nhật không thành công";
        }
    }
}


if (isset($_POST['change-pass'])) {
    if (isset($_GET['user-id'])) {
        $user_id = $_GET['user-id'];

        $sql = "SELECT matkhau FROM nguoidung WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $current_password = $row['matkhau'];

            // Lấy thông tin mật khẩu từ form
            $old_pass = $_POST['old-pass'];
            $new_pass = $_POST['new-pass'];
            $check_pass = $_POST['check-pass'];

            // Kiểm tra xem mật khẩu cũ nhập vào có trùng khớp với mật khẩu hiện tại không
            if (password_verify($old_pass, $current_password)) {
                // Kiểm tra xem mật khẩu mới và xác nhận mật khẩu có giống nhau không
                if ($new_pass === $check_pass) {
                    // Mật khẩu mới và xác nhận mật khẩu trùng khớp

                    // Kiểm tra mật khẩu mới có ít nhất 6 ký tự không
                    if (strlen($new_pass) >= 6) {
                        // Mã hóa mật khẩu mới
                        $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

                        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
                        $update_sql = "UPDATE nguoidung SET matkhau = '$hashed_password' WHERE user_id = '$user_id'";
                        if (mysqli_query($conn, $update_sql)) {
                            echo "<script>alert('Đổi mật khẩu thành công');</script>";
                        } else {
                            echo "<script>alert('Lỗi khi cập nhật mật khẩu');</script>";
                        }
                    } else {
                        echo "<script>alert('Mật khẩu mới phải có ít nhất 6 ký tự');</script>";
                    }
                } else {
                    echo "<script>alert('Mật khẩu mới và xác nhận mật khẩu không khớp');</script>";
                }
            } else {
                echo "<script>alert('Mật khẩu cũ không đúng');</script>";
            }
        } else {
            echo "<script>alert('Người dùng không tồn tại');</script>";
        }

        // Đóng kết nối
        mysqli_close($conn);
    } else {
        echo "<script>alert('User ID không hợp lệ');</script>";
    }
}

if (isset($_POST['update-profile'])) {
    if (isset($_POST['address-user'])) {
        $address = $_POST['address-user'];
    } else {
        echo "<script>alert('chưa nhập thông tin địa chỉ');</script>";
    }

    $sql = "UPDATE nguoidung SET diachi = '$address' WHERE user_id = '$user_id'";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo "<script>
        window.location.href = '../index.php?action=account&view=sodiachi';
        alert('Cập nhật thành công');
        </script>";
    } else {
        echo "Cập nhật không thành công";
    }
}
