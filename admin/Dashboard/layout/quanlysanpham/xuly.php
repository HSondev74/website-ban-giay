<?php
include('./admin/include/config.php');
$tendanhmuc = $_POST['cate_name'];
$sql = "insert into danhmuc values('$tendanhmuc')";
if (isset($tendanhmuc)) {
     mysqli_query($conn, $sql);
     echo '<script type="text/javascript>
   alert("Bạn đã thêm thành công") </script>';
     //    header('location: '../)
} else {
}
