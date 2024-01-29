<section class="container" style="width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            ">
     <?php

     $account = $_SESSION['login'];

     $sql = "SELECT * FROM nguoidung WHERE email = '$account' Limit 1";
     $result = mysqli_query($conn, $sql);
     if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
     ?>
     <form action="Dashboard/layout/settings/xuly.php" method="post">
          <h1 style="font-size: x-large;
               margin: 20px auto; 
               text-align: center;
               ">ID Tài Khoản: <?php echo $row['user_id'] ?> </h1>
          <div class="form-group">
               <input type="hidden" name="id" value="<?php echo $row['user_id'] ?>">
          </div>
          <div class="form-group">
               <nav style="background-image:url('<?php echo $row['hinhanh'] ?>'); background-size: cover; background-position:center center; border-radius: 50%; height: 110px; width: 110px; border: 1px solid #3b5998;
                    margin: 20px auto;
                    ">
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
          <button class="btn btn-primary" type="submit" name="submit">Sửa tài khoản</button>
     </form>
     <?php }
     } ?>
</section>