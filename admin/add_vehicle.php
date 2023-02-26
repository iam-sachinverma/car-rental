<?php

include '../config/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['publish'])){

   $vehicle_model = $_POST['vehicle_model'];
   $vehicle_model = filter_var($vehicle_model, FILTER_SANITIZE_STRING);
   $vehicle_number = $_POST['vehicle_number'];
   $vehicle_number = filter_var($vehicle_number, FILTER_SANITIZE_STRING);
   $seating_capacity = $_POST['seating_capacity'];
   $seating_capacity = filter_var($seating_capacity, FILTER_SANITIZE_STRING);
   $rent = $_POST['rent'];
   $rent = filter_var($rent, FILTER_SANITIZE_STRING);
    
   $select_vehicle_number = $conn->prepare("SELECT * FROM `vehicles` WHERE vehicle_number = ?");
   $select_vehicle_number->execute([$vehicle_number]);

   if($select_vehicle_number->rowCount() > 0 AND $vehicle_number != ''){
      $message[] = 'Vehicle with same number already inserted';
   }else{
      $insert_vehicle = $conn->prepare("INSERT INTO `vehicles`(vehicle_model, vehicle_number, seating_capacity, rent) VALUES(?,?,?,?)");
      $insert_vehicle->execute([$vehicle_model, $vehicle_number, $seating_capacity, $rent]);
      $message[] = 'vehicle published!';
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Vehicle</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>


<?php include 'admin_header.php' ?>

<section class="post-editor">

   <h1 class="heading">add new car</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Enter Vehicle Model <span>*</span></p>
      <input type="text" name="vehicle_model" maxlength="100" required placeholder="add vehicle model" class="box">
      <p>Enter Vehicle Number <span>*</span></p>
      <input type="text" name="vehicle_number" maxlength="100" required placeholder="add vehicle number" class="box">
      <p>Enter Seating Capacity<span>*</span></p>
      <input type="number" name="seating_capacity" maxlength="100" required placeholder="add vehicle sitting capacity" class="box">
      <p>Enter Rent for One Day</p>
      <input type="number" name="rent" required placeholder="add per day rent" class="box" />
     
      <div class="flex-btn">
         <input type="submit" value="publish vehicle" name="publish" class="btn">
      </div>
   </form>

</section>

<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>