<header class="header">

   <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

   <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p>Hello, <?= $fetch_profile['name']; ?></p>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i> <span>Home</span></a>
      <a href="add_vehicle.php"><i class="fas fa-pen"></i> <span>Add car</span></a>
      <a href="view_booking.php"><i class="fas fa-eye"></i> <span>View Booking</span></a>
      <!-- <a href="#"><i class="fas fa-user"></i> <span>accounts</span></a> -->
      
      <a href="admin_logout.php" style="color:var(--red);" onclick="return confirm('Logout from the website?');">
       &nbsp;<i class="fas fa-right-from-bracket"></i><span>Logout</span>
      </a>
   </nav>

</header>

<div id="menu-btn" class="fas fa-bars"></div>