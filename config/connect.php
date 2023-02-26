<?php 

  $db_name = 'mysql:host=localhost;dbname=car';
  $user_name = 'root';
  $user_password = '';

  try{

    $conn = new PDO($db_name, $user_name, $user_password);
    echo "Successfully connect with database";
    
  }catch(Exception $e){
    
    echo "Connection Failed".$e->getMessage();

  }


?>