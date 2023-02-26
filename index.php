<?php 

@include 'config/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['booking'])){

   $vehicle_id = $_POST['vehicle_id'];
   $vehicle_id = filter_var($vehicle_id, FILTER_SANITIZE_STRING);
   $days = $_POST['days'];
   $days = filter_var($days, FILTER_SANITIZE_STRING);
   $start_date = $_POST['start_date'];
   $start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
    
   $insert_vehicle = $conn->prepare("INSERT INTO `booked_vehicles`(vehicle_id, days, start_date) VALUES(?,?,?)");
   $insert_vehicle->execute([$vehicle_id, $days, $start_date]);
   $message[] = 'vehicle booked!';

}

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
   
   <section class="show-posts">

      <h1 class="heading">Cars available for rent</h1>
      <br/>

      <div class="box-container">

         <?php
            $select_vehicles = $conn->prepare("SELECT * FROM `vehicles`");
            $select_vehicles->execute();
            if($select_vehicles->rowCount() > 0){
               while($fetch_vehicles = $select_vehicles->fetch(PDO::FETCH_ASSOC)){
                  $vehicle_id = $fetch_vehicles['vehicle_id'];

         ?>
         <form method="post" class="box">
            <input type="hidden" name="vehicle_id" value="<?= $vehicle_id; ?>">

            <div class="title"><?= $fetch_vehicles['vehicle_model']; ?></div>
            <div class="posts-content"><?= $fetch_vehicles['vehicle_number']; ?></div>
            <div class="icons">
               <div class="seating">Seating: <?= $fetch_vehicles['seating_capacity']; ?></div>
               <br>
               <div class="prices">Rent per day: &nbsp; <span>₹ <?= $fetch_vehicles['rent']; ?> </span></div>
            </div>

            <br>

            <?php
               $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
               $select_profile->execute([$user_id]);
               if($select_profile->rowCount() > 0){
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>

             <div class="options">
               <select name="days" class="box" required>
               <option value="" selected disabled>Select no. of days* </option>
               <option value="1">One</option>
               <option value="2">Two</option>
               <option value="3">Three</option>
               <option value="4">Four</option>
               <option value="5">More than 5 days</option>
               </select>

               <p>Start Date:</p>
               <input type="date" id="start-date" class="box" name="start_date">
             </div>

             <div class="flex-btn">
              <input type="submit" value="Booking Vehicle" name="booking" class="btn">
             </div>
            
            <?php 
            }else{ 
            ?>
               <div class="flex-btn">
                 <a href="login.php" class="btn">Book Vehicle</a>  
               </div>
            <?php
            }
            ?>
            <br>
      
         </form>
         <?php
               }
            }else{
               echo '<p class="empty">no cards added yet! <a href="/admin/add_vehicle.php" class="btn" style="margin-top:1.5rem;">add vehicle</a></p>';
            }
         ?>

      </div>

   </section>
  
   <?php include 'components/footer.php'; ?>

   <script type="text/javascript" src="js/script.js"></script>

</body>
</html>