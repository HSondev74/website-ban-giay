<?php
if(isset($_POST['logup']))
{
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Kiểm tra mật khẩu có ít nhất 6 ký tự không
    if(strlen($pass) < 6) {
        echo "<script>alert('Mật khẩu phải có ít nhất 6 ký tự! Vui lòng chọn mật khẩu khác.');
        window.location.href='index.php?action=logup';
        </script>";
        exit();
    }

    // Kiểm tra email đã tồn tại trong cơ sở dữ liệu chưa
    $check_email_sql = "SELECT * FROM nguoidung WHERE email = '$email'";
    $check_email_query = mysqli_query($conn, $check_email_sql);
    $email_exists = mysqli_num_rows($check_email_query);

    if($email_exists > 0) {
        // Email đã tồn tại, hiển thị thông báo lỗi
        echo "<script>alert('Địa chỉ email đã được sử dụng! Vui lòng chọn địa chỉ email khác.');
        window.location.href='index.php?action=logup';
        </script>";
        exit();
    } else {
        // Email chưa tồn tại, tiến hành thêm người dùng mới
        $sql = "INSERT INTO nguoidung (ten, email, matkhau, kieunguoidung, sodienthoai) VALUES ('$first_name $last_name', '$email', '$pass', 'customer', '$phone')";
        $query = mysqli_query($conn, $sql);

        if($query) {
            // Đăng ký thành công
            $_SESSION['dangnhap'] = "$first_name $last_name";
            echo "<script>alert('Đăng ký thành công!');
            window.location.href = 'index.php';
            </script>";
            exit();
        } else {
            // Đăng ký không thành công
            echo "<script>alert('Đăng ký không thành công! Vui lòng thử lại sau.');
            window.location.href='index.php?action=logup';
            </script>";
            exit();
        }
    }
}
?>




<main>
    <div class="container">
        <div class="form" style="width: 30%; margin-top:50px">
            <!-- <img src="./images/img-header/logo-brand.png" alt="" /> -->
            <form action="" method="post" class="form-logup">
                <h2>Đăng Ký</h2>
                <!-- <p>Nó miễn phí và chỉ mất một phút</p> -->

                <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa-solid fa-image-portrait"></i>
                    </span>
                    <input type="text" name="first_name"  class="form-control" placeholder="First Name" />
                </div>

                <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa-solid fa-image-portrait"></i>
                    </span>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" />
                </div>

                <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="text" name="phone" class="form-control" placeholder="phone" />
                </div>

                <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="text" name="email" class="form-control" placeholder="Email" />
                </div>

                <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="text" name="pass" class="form-control" placeholder="Password" />
                </div>

                <!-- <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="text" name="" class="form-control" placeholder=" Confirm Password" />
                </div> -->

                <div class="btn-logup">
                    <input type="submit" name="logup" value="Đăng Ký Ngay" class="button" />

                    <p class="ask1 ask">
                        Khi bạn đăng ký bằng cách nhấp vào nút đăng ký, bạn
                        đồng ý với
                        <a href="#">Các điều khoản, điều kiện</a> và
                        <a href="#">Chính sách bảo mật</a> của chúng tôi.
                    </p>

                    <p class="ask2 ask">
                        Bạn đã có tài khoản.
                        <a href="index.php?action=login">Đăng Nhập Ngay !</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</main>