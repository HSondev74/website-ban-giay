<?php
// include('include/config.php');
// $message = null;
// if (isset($_POST['signup'])) {
//      $user = $_POST['user'];
//      $email = $_POST['email'];
//      $pass = $_POST['password'];
//      $cf_pass = $_POST['cf-password'];
//      $image = $_FILES['image']['name'];
//      $image_tmp = $_FILES['image']['tmp_name'];
//      $image = time() . '_' . $image;
//      if ($pass == $cf_pass) {
//           $sql = "INSERT INTO nguoidung (ten,email,matkhau,kieunguoidung,hinhanh) VALUE ('" . $user . "','" . $email . "','" . $pass . "','admin','" . $image . "')";
//           mysqli_query($conn, $sql);
//           move_uploaded_file($image_tmp, 'images/' . $image);
//           echo "<script>alert('Bạn đã đăng ký thành công!')
//   window.location.href='/BanGiay/admin/login.php'
//   </script>";
//      } else {
//           $message = "<p 
//           class='btn btn-danger'
//           style='text-align:center; padding:10px; width: 100%; margin:0 auto; color: #fff;' >Mật khẩu không trùng khớp</p>";
//      }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
     </script>
     <title>Đăng Ký Dashboard</title>
</head>

<body style="background-color: #3e3243;">
     <section class="container" style="width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 1000px;
            ">
          <div class="container py-5 h-100">
               <div class="row d-flex align-items-center justify-content-center h-100">
                    <div
                         style="width:50%; height:100%; background-image:url('./images/bgr-formlogin.jpg'); background-size: cover; background-position:center center; border-radius: 10px; ">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                         <h1 style="text-align: center; margin: -150px 0 50px 0;">Đăng Ký</h1>
                         <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                              <?php echo $message ?>
                              <!-- Image input -->
                              <div class="form-outline mb-4" style=" display: flex; justify-content: center;">
                                   <nav
                                        style="background-image:url('./images/bgr-formlogin.jpg'); background-size: cover; background-position:center center; border-radius: 50%; height: 110px; width: 110px; border: 1px solid #3b5998;">
                                        <input
                                             style="display: block;width: 100%; height: 100%; z-index: -1; opacity: 0; "
                                             type="file" id="image" name="image" multiple required />
                                   </nav>
                              </div>
                              <!-- Username input -->
                              <div class="form-outline mb-4">
                                   <label class="form-label" for="form1Example13">Tên đăng nhập*</label>
                                   <input type="text" id="user" class="form-control form-control-lg" name="user"
                                        required />
                              </div>
                              <!-- Email input -->
                              <div class="form-outline mb-4">
                                   <label class="form-label" for="form1Example13">Địa chỉ email*</label>
                                   <input type="email" id="email" class="form-control form-control-lg" name="email"
                                        required />
                              </div>
                              <!-- pass input -->
                              <div class="form-outline mb-4">
                                   <label class="form-label" for="form1Example13">Mật khẩu*</label>
                                   <input type="password" id="password" class="form-control form-control-lg"
                                        name="password" required />
                              </div>

                              <!-- Password input -->
                              <div class="form-outline mb-4">
                                   <label class="form-label" for="form1Example23">Nhập lại mật khẩu*</label>
                                   <input type="password" id="cf-password" class="form-control form-control-lg"
                                        name="cf-password" required />
                              </div>



                              <!-- Submit button -->
                              <button type="submit" class="btn btn-primary btn-lg btn-block" name="signup">Đăng
                                   ký</button>

                              <span class="text-center fw-bold mx-3 mb-0 text-muted">OR</span>

                              <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998"
                                   href="/BanGiay/admin/login.php" role="button">
                                   <i class="fab fa-twitter me-2"></i>Đăng Nhập Ngay </a>
                         </form>
                    </div>
               </div>
          </div>
     </section>
</body>

</html>