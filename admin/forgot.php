<?php
include('include/config.php');
include('../vendor/index.php');

$mail = new Mailer();

function randomPassword($length = 8)
{
     return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

if (isset($_POST['submit'])) {
     $email = $_POST['email'];
     $sql_query = "SELECT * FROM nguoidung WHERE email ='" . $email . "' LIMIT 1";

     $check = mysqli_query($conn, $sql_query);
     $count = mysqli_num_rows($check);
     if ($count > 0) {
          $newPassword = randomPassword();
          $update_query = "UPDATE nguoidung SET matkhau = '" . $newPassword . "' WHERE email = '" . $email . "'";
          mysqli_query($conn, $update_query);
          $mail = new Mailer();
          $title = "Mật khẩu mới";
          $content = "Đây là mật khẩu mới vui lòng không chia sẻ bên ngoài tránh làm mất tài khoản! <span style='color: blue;'>" . $newPassword . "
          </span> ";
          $mail->sendMail($title, $content, $email);

          $message = "<p class='btn btn-success' style='text-align:center; padding:10px; width: 100%; margin:0 auto; color: #fff;'>Chúng tôi đã gửi mật khẩu mới về email của bạn, vui lòng kiểm tra hòm thư!</p>";
          header('location: login.php');
     } else {
          $message = "<p 
          class='btn btn-danger'
          style='text-align:center; padding:10px; width: 100%; margin:0 auto; color: #fff; ' >Email không tồn tại!</p>";
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
     <title>Quên mật khẩu</title>
</head>

<body style="background-color: #3e3243;">
     <form action="" method="post" style="width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
          <?php
          if (isset($message) && !empty($message)) {
               echo  $message;
          }
          ?>
          <h1 style="color: #3C91E6; text-align:center; font-weight:700; font-family:monospace; ">
               Quên mật khẩu</h1>
          <p style="text-align:center; margin:20px auto; width: 100px; height: 5px;background: #3C91E6;  "></p>
          <div class="form-group">
               <label for="exampleInputEmail1">Địa chỉ email</label>
               <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
               <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
               <div style="display: flex;
     align-items: center;
     justify-content: center;
     gap: 10px;">
                    <p class="show" style="width: 150px;
          text-align: center;
          padding: 10px;
          background-image: url('https://scr.vn/wp-content/uploads/2020/07/Background-powerpoint-HD.jpg');
          background-size: cover;
          font-size: 20px;
          font-weight: 600;
          color: rgb(10, 23, 197);
          "></p>
               </div>
               <div class="password" style="display: flex;
     align-items: center;
     justify-content: center;
     gap: 10px; margin:-20px 0 0 0;">
                    <input maxlength="1" value="" class="input" name="text" type="text" style="width: 30px;
  height: 40px;
  text-align: center;
  background-color: transparent;
  border: none;
  border-bottom: solid 2px rgb(20, 181, 230);
  font-size: 20px;
  color: black;
  outline: none;" />
                    <input maxlength="1" value="" class="input" name="text" type="text" style="width: 30px;
  height: 40px;
  text-align: center;
  background-color: transparent;
  border: none;
  border-bottom: solid 2px rgb(20, 181, 230);
  font-size: 20px;
  color: black;
  outline: none;" />
                    <input maxlength="1" value="" class="input" name="text" type="text" style="width: 30px;
  height: 40px;
  text-align: center;
  background-color: transparent;
  border: none;
  border-bottom: solid 2px rgb(20, 181, 230);
  font-size: 20px;
  color: black;
  outline: none;" />
                    <input maxlength="1" value="" class="input" name="text" type="text" style="width: 30px;
  height: 40px;
  text-align: center;
  background-color: transparent;
  border: none;
  border-bottom: solid 2px rgb(20, 181, 230);
  font-size: 20px;
  color: black;
  outline: none;" />
                    <input maxlength="1" value="" class="input" name="text" type="text" style="width: 30px;
  height: 40px;
  text-align: center;
  background-color: transparent;
  border: none;
  border-bottom: solid 2px rgb(20, 181, 230);
  font-size: 20px;
  color: black;
  outline: none;" />
               </div>
          </div>
          <div class="form-group">
               <p class="text-muted">
                    <strong>*</strong> These fields are required. Contact form template by
                    <a href="https://bootstrapious.com/p/bootstrap-recaptcha" target="_blank"></a>.
               </p>
          </div>

          <button type="submit" name="submit" class="btn btn-primary submit">Lấy lại mật khẩu</button>
     </form>
</body>
<script>
const input = document.querySelectorAll('.input');
const button = document.querySelector('.submit');
const p = document.querySelector('.show');

function charString() {
     let charStr = '';

     for (let i = 97; i <= 122; i++) {
          charStr += String.fromCharCode(i);
     }

     for (let i = 65; i <= 90; i++) {
          charStr += String.fromCharCode(i);
     }

     for (let i = 48; i <= 57; i++) {
          charStr += String.fromCharCode(i);
     }

     return charStr;
}

function generateRandomArray() {
     const str = charString();
     const arrStr = str.split('');
     let randomArray = [];

     for (let i = 0; i < 5; i++) {
          randomArray.push(randomChar(arrStr));
     }

     return randomArray;
}

function randomChar(arr) {
     p.innerText += "   " + arr[Math.floor(Math.random() * arr.length)]
     return arr[Math.floor(Math.random() * arr.length)];
}

let currentArray = generateRandomArray();

button.onclick = () => {
     let str = '';
     input.forEach(item => {
          str += item.value
     })
     if (str.value == currentArray.join('')) {
          // console.log(currentArray.join(''));
     } else {
          currentArray = generateRandomArray();
          p.innerText = currentArray.join('');
          confirm("Xin hãy nhập lại mã captcha")
     }
}
</script>

</html>