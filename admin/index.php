<?php
session_start();
if (empty($_SESSION['login'])) {
     header('location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
     <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
     </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <link rel="stylesheet" href="../css/global.css">
     <link rel="stylesheet" href="./styles/style.css">
     <title>Dashboard</title>
</head>

<body>
     <section id="container">
          <?php
          include('include/config.php');
          include('../admin/Dashboard/layout/content.php');
          ?>
     </section>
</body>
<?php

try {
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "websitebangiay";
     $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $start_date = date('Y-m-01');
     $end_date = date('Y-m-t');

     $sql = "SELECT 
     ngaydat, 
     COUNT(*) AS total_orders, 
     SUM(gia * soluong) AS total_sales 
 FROM 
     donhang 
 WHERE 
     ngaydat BETWEEN :start_date AND :end_date 
 GROUP BY 
     ngaydat;
 ";
     $stmt = $conn->prepare($sql);
     $stmt->bindParam(':start_date', $start_date);
     $stmt->bindParam(':end_date', $end_date);
     $stmt->execute();

     // Lấy kết quả và đưa vào mảng
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     $json_data = json_encode($result);
} catch (PDOException $e) {
     echo "Lỗi kết nối: " . $e->getMessage();
}

?>
<script src="../admin/JS/script.js"></script>
<script>
function updateTime() {
     var currentTime = new Date();
     var hours = currentTime.getHours();
     var minutes = currentTime.getMinutes();
     var seconds = currentTime.getSeconds();
     var meridiem = "AM";
     var month = currentTime.getMonth() + 1;
     var day = currentTime.getDate();
     var year = currentTime.getFullYear();

     if (hours > 12) {
          hours = hours - 12;
          meridiem = "PM";
     }
     if (hours === 0) {
          hours = 12;
     }

     hours = (hours < 10 ? "0" : "") + hours;
     minutes = (minutes < 10 ? "0" : "") + minutes;
     seconds = (seconds < 10 ? "0" : "") + seconds;
     month = (month < 10 ? "0" : "") + month;
     day = (day < 10 ? "0" : "") + day;

     var inputBox = document.getElementById('searchInput');
     inputBox.placeholder = hours + ":" + minutes + ":" + seconds + " " + meridiem + "   " + day + "-" + month +
          "-" +
          year;
}

setInterval(updateTime, 1000);
</script>
<script>
function filterOrders() {
     var userFilter = document.getElementById("userFilter").value.toLowerCase();
     var statusFilter = document.getElementById("statusFilter").value.toLowerCase();

     var rows = document.querySelectorAll(".order tbody tr");
     rows.forEach(function(row) {
          var user = row.querySelector("td:nth-child(1) p").textContent.toLowerCase();
          var status = row.querySelector("td:nth-child(3) span").textContent.toLowerCase();

          if ((user.includes(userFilter) || !userFilter) && (status.includes(statusFilter) || !
                    statusFilter)) {
               row.style.display = "";
          } else {
               row.style.display = "none";
          }
     });

     // Xóa giá trị trong trường nhập người dùng
     document.getElementById("userFilter").value = "";

     // Đặt trỏ chuột vào trường nhập người dùng
     document.getElementById("userFilter").focus();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const JSON_DATA = <?php echo $json_data; ?>;

const ctx = document.getElementById('myChart');

new Chart(ctx, {
     type: 'bar',
     data: {
          labels: ['Đơn Hàng', 'ID Sản Phẩm', 'Tổng Tiền'],
          datasets: [{
                    label: 'Doanh Thu Theo Tháng',
                    data: JSON_DATA.map(item => {
                         console.log(item);
                         return item.total_sales;
                    }),
                    borderWidth: 2,
                    backgroundColor: 'red',
               },
               {
                    label: 'Số Lượng Đơn Theo Tháng',
                    data: JSON_DATA.map(item => {
                         return item.total_orders;
                    }),
                    borderWidth: 2,
                    backgroundColor: 'yellow',
               }, {
                    label: 'Các Ngày Có Đơn',
                    data: JSON_DATA.map(item => {
                         return item.ngaydat;
                    }),
                    borderWidth: 2,
                    backgroundColor: 'green',
               }
          ]
     },
     options: {
          scales: {
               y: {
                    beginAtZero: true
               }
          }
     }
});
</script>

</html>