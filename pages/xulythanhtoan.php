<?php
include('../includes/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = $_POST['ten'];
    $sodienthoai = $_POST['sodth'];
    // $tinh_thanh = $_POST['tinh_thanh'];
    // $quan_huyen = $_POST['quan_huyen'];
    // $phuong_xa = $_POST['phuong_xa'];
    $diachi = $_POST['address'];
    $note = $_POST['ghi_chu'];
    $phi_van_chuyen = 0;
    $total_price = 0;
    $ngaydat = date('Y-m-d'); // Lấy ngày hiện tại
    $user_id = null; // Mặc định user_id là null
    $thanhtoan = $_POST['payment-method'];

    if (isset($_SESSION['dangnhap']) && !empty($_SESSION['dangnhap'])) {
        $sql_user = "SELECT * FROM nguoidung WHERE ten = '{$_SESSION['dangnhap']}'";
        $result_user = mysqli_query($conn, $sql_user);
        $row_user = mysqli_fetch_assoc($result_user);

        $user_id = $row_user['user_id']; // Lấy user_id nếu user đã đăng nhập
    }

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $total_price += $product['gia'] * $product['soluong'];
            $id = $product['id'];
            $sanpham_id[] = $id;
            $soluong[] = $product['soluong'];
            $tien[] = $product['gia'] * $product['soluong'];
            $size[] = $product['size'];
        }
    }

    if ($user_id) {
        $sql_insert = "INSERT INTO donhang (id_donhang, user_id, ten, diachi, sodienthoai, note, tongtien, ngaydat, hinhthucthanhtoan, trangthai) 
                      VALUES (null, '$user_id', '$ten', '$diachi', '$sodienthoai', '$note', '$total_price', '$ngaydat', '$thanhtoan', 'Chờ xác nhận')";
    } else {
        $sql_insert = "INSERT INTO donhang (id_donhang, ten, diachi, sodienthoai, note, tongtien, ngaydat, hinhthucthanhtoan, trangthai) 
                      VALUES (null, '$ten', '$diachi', '$sodienthoai', '$note', '$total_price', '$ngaydat', '$thanhtoan', 'Chờ xác nhận')";
    }

    if (mysqli_query($conn, $sql_insert)) {
        $last_id = mysqli_insert_id($conn);

        // Lặp qua mảng sản phẩm và số lượng để thêm vào bảng chitietdonhang
        for ($i = 0; $i < count($sanpham_id); $i++) {
            $sql = "INSERT INTO chitietdonhang (id_donhang, sanpham_id, soluong, tongtien, ngaydat, size) 
                    VALUES ('$last_id', '{$sanpham_id[$i]}', '{$soluong[$i]}', '{$tien[$i]}', '$ngaydat', '{$size[$i]}')";
            mysqli_query($conn, $sql);
        }

        echo "<script>
        alert('Đặt hàng thành công');
        window.location.href = '../index.php?action=donhang&id_donhang=$last_id';</script>";
        unset($_SESSION['cart']);
    } else {
        echo "Đơn hàng không thể được đặt!<br>";
    }
}
