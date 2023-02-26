<?php 

@include '../config/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:admin_login.php');
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Font awesome CDN link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom Admin Style Sheet -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

   <?php @include 'admin_header.php'  ?>

   <section class="dashboard">

    <h1 class="heading">Dashboard</h1>

    <div class="box-container">

      <div class="box">
         <?php
            $select_vehicles = $conn->prepare("SELECT * FROM `vehicles`");
            $select_vehicles->execute();
            $numbers_of_vehicles = $select_vehicles->rowCount();
         ?>
         <h3><?= $numbers_of_vehicles; ?></h3>
         <p>Total Vehicles</p>
         <a href="view_.php" class="btn">add vehicle</a>
      </div>
        
      <div class="box">
         <?php
            $select_booked_vehicles = $conn->prepare("SELECT * FROM `booked_vehicles`");
            $select_booked_vehicles->execute();
            $numbers_of_booked_vehicles = $select_booked_vehicles->rowCount();
         ?>
         <h3><?= $numbers_of_booked_vehicles; ?></h3>
         <p>All Booking</p>
         <a href="view_.php" class="btn">see booking</a>
      </div>

      <div class="box">
         <?php
            $select_customers = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
            $select_customers->execute(['customer']);
            $numbers_of_customers = $select_customers->rowCount();
         ?>
         <h3><?= $numbers_of_customers; ?></h3>
         <p>Total Customers</p>
         <a href="view_posts.php" class="btn">all customers</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
            $select_admins->execute(['admin']);
            $numbers_of_admins = $select_admins->rowCount();
         ?>
         <h3><?= $numbers_of_admins; ?></h3>
         <p>Total Admins</p>
         <a href="view_posts.php" class="btn">all admins</a>
      </div>


    </div>

   </section>
    
   
   <script src="js/admin_script.js"></script>

</body>
</html>