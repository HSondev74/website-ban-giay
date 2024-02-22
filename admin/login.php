<?php
session_start();
include('include/config.php');
if (isset($_POST['login'])) {
     $email = $_POST['email'];
     $password = $_POST['password'];
     $sql = "SELECT * FROM nguoidung WHERE email = '" . $email . "' AND matkhau = '" . $password . " ' LIMIT 1";

     $result = mysqli_query($conn, $sql);
     $count = mysqli_num_rows($result);
     if ($count > 0) {
          $row = mysqli_fetch_assoc($result);
          if ($row['kieunguoidung'] == "admin") {

               $_SESSION['login'] = $email;

               if (isset($_POST['remember'])) {
                    $cookie_name = "remember_me";
                    setcookie("email", $email, time() + (86400 * 7));
                    setcookie("pass", $password, time() + (86400 * 7));
               }

               echo "<script>alert('Đăng nhập thành công!')
          window.location.href='index.php'
          </script>";
          }
     } else {
          echo "<script>alert('Tài khoản mật khẩu không đúng!')
          window.location.href='login.php'
          </script>";
     }
}



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
     <title>Đăng Nhập Dashboard</title>
</head>

<body style="background-color: #3e3243;">
     <section class="vh-100 container" style="width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
          <div class="container py-5 h-100">
               <div class="row d-flex align-items-center justify-content-center h-100">
                    <div
                         style="width:50%; height:100%; background-image:url('./images/bgr-formlogin.jpg'); background-size: cover; background-position:center center; border-radius: 10px; ">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                         <h1>Đăng nhập</h1>
                         <form action="" method="post" autocomplete="on">
                              <!-- Email input -->
                              <div class="form-outline mb-4">
                                   <label class="form-label" for="form1Example13">Địa chỉ email</label>
                                   <input type="email" id="email" class="form-control form-control-lg" name="email" />
                              </div>

                              <!-- Password input -->
                              <div class="form-outline mb-4">
                                   <label class="form-label" for="form1Example23">Mật khẩu</label>
                                   <input type="password" id="password" class="form-control form-control-lg"
                                        name="password" />
                              </div>

                              <div class="d-flex justify-content-around align-items-center mb-4">
                                   <!-- Checkbox -->
                                   <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                             id="form1Example3" />
                                        <label class="form-check-label" for="form1Example3">Ghi nhớ mật khẩu!</label>
                                   </div>
                                   <a href="/BanGiay/admin/forgot.php">Quên mật khẩu?</a>
                              </div>

                              <!-- Submit button -->
                              <button type="submit" class="btn btn-primary btn-lg btn-block" name="login">Đăng
                                   nhập</button>

                              <!-- <span class="text-center fw-bold mx-3 mb-0 text-muted">OR</span> -->

                              <!-- <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="/BanGiay/admin/register.php" role="button">
                                   <i class="fab fa-twitter me-2"></i>Đăng kí ngay </a> -->

                         </form>
                    </div>
               </div>
          </div>
     </section>
</body>
<script>
document
     .querySelector(".form-check-input")
     .addEventListener("change", function() {
          if (this.checked) {
               var email = document.getElementById("email");
               var password = document.getElementById("password");

               function getCookie(name) {
                    const cookies = decodeURIComponent(document.cookie).split(';');
                    for (let i = 0; i < cookies.length; i++) {
                         const cookie = cookies[i].trim();
                         if (cookie.startsWith(name + '=')) {
                              return cookie.substring(name.length + 1);
                         }
                    }
                    return null;
               }

               const rememberEmail = getCookie("email");
               const rememberPassword = getCookie("pass");

               if (rememberEmail && rememberPassword) {
                    email.value = rememberEmail
                    password.value = rememberPassword;
               }


          } else {
               document.cookie =
                    "remember_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
               document.cookie =
                    "remember_password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
          }
     });
</script>

</html>