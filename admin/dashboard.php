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
 
      


    </div>

   </section>
    
   
   <script src="js/admin_script.js"></script>

</body>
</html>