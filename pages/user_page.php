<div id="main" class="container">
    <nav style="display: flex; gap: 10px; align-items: center;">
        <!-- <i style=" color: black;" class='bx bx-user' ></i> -->
        <h2 style="margin-bottom: 20px;">Tài khoản của bạn</h2>
    </nav>

    <div class="user-flex">

        <div class="user-select">
            <?php
            // Kiểm tra xem $_GET['view'] có tồn tại không
            $view = isset($_GET['view']) ? $_GET['view'] : '';

            // Một mảng chứa các liên kết và văn bản của chúng
            $menuItems = array(
                'account' => 'Hồ sơ của tôi',
                'donhang' => 'Đơn hàng của tôi',
                'sodiachi' => 'Sổ địa chỉ',
                'matkhau' => 'Đổi mật khẩu'
            );
            ?>

            <!-- Dùng vòng lặp để hiển thị các phần tử menu -->
            <?php foreach ($menuItems as $action => $text) : ?>
                <a href="index.php?action=account&view=<?php echo $action; ?>">
                    <div class="flex-select <?php if ($view === $action) echo 'selected'; ?>">
                        <i class='bx <?php echo $action === "account" ? "bx-user" : ($action === "donhang" ? "bx-file" : ($action === "sodiachi" ? "bx-map" : "bx-lock-alt")); ?>'></i>
                        <p><?php echo $text; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>

        </div>

        <?php
        if (isset($_SESSION['dangnhap'])) {
            $sql = "SELECT * FROM nguoidung WHERE ten = '" . $_SESSION['dangnhap'] . "'";
            $query = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($query);
            if ($count > 0) {
                $row = mysqli_fetch_assoc($query);
                $ten = $row['ten'];
                $email = $row['email'];
                $sodienthoai = $row['sodienthoai'];
                $user_id = $row['user_id'];
                $diachi = $row['diachi'];
            }
        }
        ?>

        <?php
        if ($_GET['view'] == 'account') {
        ?>

            <div class="user-profile">
                <h1>Hồ sơ của tôi</h1>
                <form action="pages/xulyuser-profile.php?user-id=<?php echo $user_id ?>" method="post">
                    <div class="user-input">
                        <label for="">Họ và tên</label>
                        <input type="text" name="name-user" value="<?php echo $ten ? $ten : '' ?>" required>
                    </div>
                    <div class="user-input">
                        <label for="">Email</label>
                        <input type="text" name="email-user" value="<?php echo $email ? $email : '' ?>" required>
                    </div>
                    <div class="user-input">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone-user" value="<?php echo $sodienthoai ? $sodienthoai : '' ?>" required>
                    </div>

                    <input class="user-submit" name="update-profile" type="submit" value="Cập nhật">
                </form>
            </div>


        <?php
        } elseif ($_GET['view'] == 'matkhau') {
        ?>

            <div class="user-profile">
                <h1>Đổi mật khẩu</h1>
                <p style="margin-bottom: 15px;">Để đảm bảo tính bảo mật vui lòng đặt mật khẩu với ít nhất 6 kí tự</p>
                <form action="pages/xulyuser-profile.php?user-id=<?php echo $user_id ?>" method="post">
                    <div class="user-input">
                        <label for="">Mật khẩu cũ</label>
                        <input type="text" name="old-pass" placeholder="Mật khẩu cũ" autocomplete="off" required>
                    </div>
                    <div class="user-input">
                        <label for="">Mật khẩu mới</label>
                        <input type="text" name="new-pass" placeholder="Mật khẩu mới" autocomplete="off" required>
                    </div>
                    <div class="user-input">
                        <label for="">Xác nhận lại mật khẩu</label>
                        <input type="text" name="check-pass" placeholder="Xác nhận lại mật khẩu" autocomplete="off" required>
                    </div>

                    <input class="user-submit" name="change-pass" type="submit" value="Đặt lại mật khẩu">
                </form>
            </div>


        <?php

        } elseif ($_GET['view'] == 'sodiachi') { ?>

            <div class="user-profile">
                <h1>Địa chỉ</h1>
                <form action="pages/xulyuser-profile.php?user-id=<?php echo $user_id ?>" method="post">
                    <div class="user-input">
                        <label for="">Họ và tên</label>
                        <input type="text" name="name-user" value="<?php echo $ten ? $ten : '' ?>" disabled>
                    </div>
                    <div class="user-input">
                        <label for="">Địa chỉ</label>
                        <p>Yêu cầu: Số nhà Ngõ/ngách - Tỉnh thành - Quận Huyện</p>
                        <input type="text" name="address-user" value="<?php echo $diachi ? $diachi : '' ?>" required>
                    </div>
                    <div class="user-input">
                        <label for="">Quốc Tịch</label>
                        <input type="text" name="email-user" value="Việt Nam" disabled>
                    </div>
                    <div class="user-input">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone-user" value="<?php echo $sodienthoai ? $sodienthoai : '' ?>" disabled>
                    </div>

                    <input class="user-submit" name="update-profile" type="submit" value="Cập nhật">
                </form>
            </div>

        <?php
        } elseif ($_GET['view'] == 'donhang') {
        ?>

            <div class="user-profile">
                <h1>Đơn hàng</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border">Mã đơn hàng</th>
                            <th class="border">Ngày mua</th>
                            <th class="border">Tổng tiền</th>
                            <th class="border">Trạng thái đơn hàng</th>
                            <th class="border">Sản phẩm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border">Data 1</td>
                            <td class="border">Data 2</td>
                            <td class="border">Data 3</td>
                            <td class="border">Data 4</td>
                            <td class="border">Data 5</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <?php } ?>
    </div>

</div>