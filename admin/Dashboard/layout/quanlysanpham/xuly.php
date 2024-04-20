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

    if (isset($_POST['addSanpham'])) {
        $tensp = mysqli_real_escape_string($conn, $_POST['tensanpham']);
        $gia = str_replace(".", "", $_POST['gia']);
        $tonkho = mysqli_real_escape_string($conn, $_POST['tonkho']);
        $mota = mysqli_real_escape_string($conn, $_POST['mota']);
        $all_sizes = implode(',', $_POST['size']);
        $danhmuc_id = mysqli_real_escape_string($conn, $_POST['danhmuc_id']);
        $targetDir = "uploads/";
        
        // Khởi tạo mảng để lưu trữ tên các tệp hình ảnh
        $uploadedImages = array();
        
        // Lặp qua từng tệp
        for ($i = 0; $i < count($_FILES['hinhanh']['name']); $i++) {
            $fileName = basename($_FILES['hinhanh']['name'][$i]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        
            // Kiểm tra xem tệp có hợp lệ không
            if (!empty($fileName)) {
                $allowTypes = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            
                if (in_array($fileType, $allowTypes)) {
                    // Di chuyển tệp vào thư mục uploads
                    if (move_uploaded_file($_FILES['hinhanh']['tmp_name'][$i], $targetFilePath)) {
                        // Thêm tên tệp vào mảng
                        $uploadedImages[] = $fileName;
                    } 
                } else {
                    echo "Chỉ được phép tải lên các tệp JPG, JPEG, PNG, GIF, WebP.<br>";
                }
            } 
        }
  
        // Chuyển mảng tên hình ảnh thành chuỗi để lưu vào cơ sở dữ liệu
        $hinhanh = implode(',', $uploadedImages);
        
        // Tạo câu truy vấn thêm mới sản phẩm
        $sql = "INSERT INTO sanpham (tensanpham, size, gia, hinhanh, tonkho, danhmuc_id, mota) 
                VALUES ('$tensp', '$all_sizes', '$gia', '$hinhanh', '$tonkho', '$danhmuc_id', '$mota')";
    
        // Thực thi câu truy vấn
        mysqli_query($conn, $sql);
        
          // Hiển thị thông báo và chuyển hướng
        echo "<script>alert('Bạn đã thêm thành công!');
        window.location.href='../../../index.php?action=sanpham;
        </script>";
        exit();
        
        exit();
  }
  


  if (isset($_POST['editsp'])) {
    $size_safe = '';
    if (!empty($_POST['size'])) {
        $size_safe = implode(',', $_POST['size']);
    }

    // Tạo câu truy vấn để cập nhật sản phẩm
    $sql_sua = "UPDATE sanpham 
                SET tensanpham = '" . mysqli_real_escape_string($conn, $_POST['tensanpham']) . "',
                    gia = '" . str_replace(".", "", $_POST['gia']) . "',
                    tonkho = '" . mysqli_real_escape_string($conn, $_POST['tonkho']) . "',
                    danhmuc_id = '" . mysqli_real_escape_string($conn, $_POST['danhmuc_id']) . "',
                    mota = '" . mysqli_real_escape_string($conn, $_POST['mota']) . "'";

    // Kiểm tra xem có hình ảnh mới được tải lên không

    if(!empty($size_safe))
    {
        $sql_sua .= ", size = '$size_safe'";
    }

    if (!empty($_FILES['hinhanh']['name'][0])) {
        $targetDir = "uploads/";
        $uploadedImages = array();

        // Lặp qua từng tệp
        for ($i = 0; $i < count($_FILES['hinhanh']['name']); $i++) {
            $fileName = basename($_FILES['hinhanh']['name'][$i]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Kiểm tra xem tệp có hợp lệ không
            if (!empty($fileName)) {
                $allowTypes = array('jpg', 'jpeg', 'png', 'gif', 'webp');

                if (in_array($fileType, $allowTypes)) {
                    // Di chuyển tệp vào thư mục uploads
                    if (move_uploaded_file($_FILES['hinhanh']['tmp_name'][$i], $targetFilePath)) {
                        // Thêm tên tệp vào mảng
                        $uploadedImages[] = $fileName;
                    }
                } else {
                    echo "Chỉ được phép tải lên các tệp JPG, JPEG, PNG, GIF, WebP.<br>";
                }
            }
        }

        // Nếu có hình ảnh mới, cập nhật danh sách hình ảnh
        if (!empty($uploadedImages)) {
            // $all_images = array_merge($existing_images, $uploadedImages);
            $hinhanh = implode(',', $uploadedImages);
            $sql_sua .= ", hinhanh = '$hinhanh'";
        }
    }

    $sql_sua .= " WHERE sanpham_id = '" . $_GET['id'] . "'";

    mysqli_query($conn, $sql_sua);

    echo "<script>alert('Bạn đã sửa thành công!');
        window.location.href='../../../index.php?action=sanpham';
        </script>";
    exit();
}










