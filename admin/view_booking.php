<?php

include '../config/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Booking</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="show-posts">

   <h1 class="heading">Booked Vehicle</h1>

   <div class="box-container">

        <?php
         $select_booking = $conn->prepare("SELECT * FROM `booked_vehicles`");
         $select_booking->execute();
         if($select_booking->rowCount() > 0){
            while($fetch_booking = $select_booking->fetch(PDO::FETCH_ASSOC)){
               $vehicle_id = $fetch_booking['vehicle_id'];

               $vehicle_details = $conn->prepare("SELECT * FROM `vehicles` WHERE vehicle_id = ?");
               $vehicle_details->execute([$vehicle_id]);
               
        ?>

            <div class="box">

                <?php 
                 
                 if($fetch_vehicle = $vehicle_details->fetch(PDO::FETCH_ASSOC)){
                 
                ?>

                <div class="status" style="background-color:limegreen">Booked</div>

                <div class="title">
                    <?= $fetch_vehicle['vehicle_model']; ?>
                </div>
                
                <div class="posts-content">
                    <?= $fetch_vehicle['vehicle_number']; ?>
                </div>

                <div class="options">
                 <div class="days"><b>No.of Days:</b> &nbsp;<span>₹ <?= $fetch_booking['days']; ?> </span> </div>   
                 <br>
                 <div class="prices"><b>Rent:</b> &nbsp;<span>₹ <?= $fetch_vehicle['rent']; ?> </span></div>
                </div>

                <br>

                <?php } ?>

                <div class="icons"> 
                    <div class="days">Starting date: <?= $fetch_booking['start_date'] ?></div>
                </div>      


            </div>

        <?php
                }
            }else{
                echo '<p class="empty">Zero Booking Yet! ></p>';
            }
        ?>

   </div>

</section>


<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>