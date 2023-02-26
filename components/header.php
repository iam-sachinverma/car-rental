<header class="header">

   <section class="flex">

      <a href="index.php" class="logo">Cart Rent</a>

      <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         
         <p class="name"><?= $fetch_profile['name']; ?></p>

         <div class="class="flex-btn"> 
            <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">Logout</a>
         </div>

         <?php
            }else{
         ?>
            <!-- <p class="name">please login first!</p> -->
            <div class="flex-btn">
             <a href="login.php" class="option-btn">Login</a>
            </div>
         <?php
            }
         ?>

   </section>

</header>