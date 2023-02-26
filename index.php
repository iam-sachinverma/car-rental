<?php 

@include 'config/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <title>Car Rental</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <?php include 'components/header.php'; ?>
   
   <section class="home-grid">
      <div class="box-container">
         <div class="box"></div>
      </div>
   </section>
  
   <?php include 'components/footer.php'; ?>

   <script type="text/javascript" src="js/script.js"></script>

</body>
</html>