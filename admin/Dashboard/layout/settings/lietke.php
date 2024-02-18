<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "websitebangiay";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Check if all necessary data is present
     if (isset($_POST['submit'], $_POST['username'], $_POST['email'])) {
          $login = $_SESSION['login'];
          $sql = "SELECT * FROM nguoidung WHERE email = '$login' Limit 1";
          $result = mysqli_query($conn, $sql);
          $row_id = mysqli_fetch_assoc($result);
          $id = $row_id['user_id'];

          $user = $_POST['username'];
          $email = $_POST['email'];
          $password = !empty($_POST['password']) ? $_POST['password'] : null;
          $new_password = !empty($_POST['new-password']) ? $_POST['new-password'] : null;
          $submit = $_POST['submit'];

          // Check if new image is uploaded
          if (!empty($_FILES['image']['name'])) {
               $image = $_FILES['image']['name'];
               $image_tmp = $_FILES['image']['tmp_name'];
               $image = time() . '_' . $image;
               $upload_directory = 'uploads/';
               move_uploaded_file($image_tmp, $upload_directory . $image);
          } else {
               // If no new image is uploaded, keep the old image
               $sql = "SELECT hinhanh FROM nguoidung WHERE user_id=?";
               $stmt = mysqli_prepare($conn, $sql);
               mysqli_stmt_bind_param($stmt, "i", $id);
               mysqli_stmt_execute($stmt);
               $result = mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_assoc($result);
               $image = $row['hinhanh'];
          }

          // Check if new password is provided
          if (!empty($new_password)) {
               $password = $new_password;
          }

          // Update user information in the database
          $sql_nguoidung = "UPDATE nguoidung SET ten=?, email=?, matkhau=?, hinhanh=? WHERE user_id=?";
          $stmt = mysqli_prepare($conn, $sql_nguoidung);
          mysqli_stmt_bind_param($stmt, "ssssi", $user, $email, $password, $image, $id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);

          echo "<script>alert('Bạn đã sửa thành công!')</script>";
     } else {
          echo "<script>alert('Đã có lỗi xảy ra, Vui lòng thử lại!')</script>";
     }
}
?>


<section class="container"
     style="width: 80%; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
     <?php
     // Fetch user data
     $account = $_SESSION['login'];

     $sql = "SELECT * FROM nguoidung WHERE email = ? LIMIT 1";
     $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, "s", $account);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);

     if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
     ?>
     <form action="" method="post" enctype="multipart/form-data">
          <h1 style="font-size: x-large; margin: 20px auto; text-align: center;">ID Tài Khoản:
               <?php echo $row['user_id'] ?> </h1>
          <div class="form-group">
               <nav
                    style="background-image:url('<?php echo $row['hinhanh'] ?>'); background-size: cover; background-position:center center; border-radius: 50%; height: 110px; width: 110px; border: 1px solid #3b5998; margin: 20px auto;">
                    <input type="file" style="opacity: 0; width:100%; height:100%; " name="image">
               </nav>
          </div>
          <div class="form-group">
               <label class="form-label" for="email">Tên đăng nhập:</label>
               <input type="text" class="form-control form-control-lg" name="username" id="email"
                    value="<?php echo $row['ten'] ?>">
          </div>
          <div class="form-group" style="width:100%;">
               <label class="form-label" for="email">Địa chỉ email:</label>
               <input type="email" class="form-control form-control-lg" name="email" id="email" style="width: 100%;"
                    value="<?php echo $row['email'] ?>">
          </div>
          <div class="form-group">
               <label class="form-label" for="password">Mật khẩu cũ:</label>
               <input type="password" class="form-control form-control-lg" name="password" id="password"
                    value="<?php echo $row['matkhau'] ?>">
          </div>
          <div class="form-group">
               <label class="form-label" for="password">Mật khẩu mới:</label>
               <input type="password" class="form-control form-control-lg" name="new-password" id="new-password"
                    value="" placeholder="nhập mật khẩu mới">
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Sửa tài khoản</button>
     </form>
     <?php
          }
     }
     ?>
</section>