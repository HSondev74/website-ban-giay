<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/global.css">
     <link rel="stylesheet" href="styles/style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <title>Dashboard</title>
</head>

<body>
     <section id="container">
          <?php
          include('include/config.php');
          include('../admin/Dashboard/layout/header.php');
          include('../admin/Dashboard/layout/content.php');
          ?>
     </section>
</body>

</html>