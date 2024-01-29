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
$emailIsLogin = $_SESSION['login'];
$sql = "select * from nguoidung where email = '" . $emailIsLogin . "' LIMIT 1";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);
if ($count > 0) {
     $row = mysqli_fetch_array($query);
     // print_r($row);
}
?>
<!-- Header -->
<nav>
     <i class='bx bx-menu'></i>
     <a href="#" class="nav-link">Danh mục</a>
     <form action="#">
          <div class="form-input">
               <input id="searchInput" type="search" placeholder='<?php echo date("d-m-Y"); ?>'>
               <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
          </div>
     </form>
     <input type="checkbox" id="switch-mode" hidden>
     <label for="switch-mode" class="switch-mode"></label>
     <a href="#" class="notification">
          <i class='bx bxs-bell'></i>
          <span class="num">8</span>
     </a>
     <a href="#" class="profile">
          <img src="<?php echo $row['hinhanh'] ?>">
     </a>
</nav>
<!-- end Header -->