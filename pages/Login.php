<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM nguoidung WHERE email = '" . $email . "' AND matkhau = '" . $password . " ' LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($result);
        $ten = $row['ten'];


        if ($row['kieunguoidung'] == "customer") {
            // if(!isset($_SESSION['dangnhap']))
            // {
            //     $_SESSION['dangnhap'] = '';
            // }


            $_SESSION['dangnhap'] = trim($ten);
            echo "<script>alert('Đăng nhập thành công!');
            window.location.href='index.php';
            </script>";
            exit();
        }
    } else {
        echo "<script>alert('Tài khoản mật khẩu không đúng!');
        window.location.href='index.php?action=login';
        </script>";
    }
}
?>


<main id="main">
    <div class="container">
        <div class="form" style="width: 30%;">
            <!-- <img src="./images/img-header/logo-brand.png" alt="" /> -->
            <form action="" method="POST" class="form-logup">
                <h2>Đăng Nhập</h2>
                <!-- <p>Chào mừng bạn quay lại</p> -->

                <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="vd: vibesneak@gmail.com" />
                </div>

                <div class="ip-logup">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" />
                </div>

                <div class="btn-logup">
                    <input type="submit" name="login" value="Đăng Nhập" class="button" />

                    <p class="ask2 ask">
                        Bạn chưa có tài khoản.
                        <a href="index.php?action=logup">Đăng Ký Ngay !</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</main>