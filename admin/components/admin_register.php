<?php 

@include '../../config/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(isset($admin_id)){
  header('location:../dashboard.php');
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
    $user_type = $_POST['user_type'];
    $user_type = filter_var($user_type, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    
    if($select_user->rowCount() > 0){
       $message[] = 'Email address already exists!';
    }else{
       if($pass != $cpass){
          $message[] = 'Confirm passowrd not matched!';
       }else{
          $insert_admin = $conn->prepare("INSERT INTO `user`(name, email, password, user_type ) VALUES(?,?,?,?)");
          $insert_admin->execute([$name, $email, $cpass, $user_type]);
          $message[] = 'Registered Successfully !';

          $select_user = $conn->prepare("SELECT * FROM `user` WHERE email = ? AND password = ?");
          $select_user->execute([$email, $pass]);
          $row = $select_user->fetch(PDO::FETCH_ASSOC);

          if($select_user->rowCount() > 0){
            $_SESSION['admin_id'] = $row['id'];
            header('location:../dashboard.php');
          }
       }
    }
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">

</head>
<body style="padding-left: 0 !important;">

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="form-container">

   <form action="" method="POST">
      
      <h3>Register New</h3>

      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="hidden" name="user_type" class="box" value="admin" >
      <input type="submit" value="register now" name="submit" class="btn">

   </form>

</section>

<!-- custom js file link  -->
<script src="js/admin_script.js"></script>
    
</body>
</html>