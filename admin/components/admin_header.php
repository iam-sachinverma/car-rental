<header class="header">

   <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

   <div class="profile">
     
      <!-- <a href="#" class="btn">update profile</a> -->
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i> <span>Home</span></a>
      <a href="add_cars.php"><i class="fas fa-pen"></i> <span>Add Car</span></a>
      <a href="view_cars.php"><i class="fas fa-eye"></i> <span>View Rented Car</span></a>
      <a href="admin_accounts.php"><i class="fas fa-user"></i> <span>Accounts</span></a>
      <a href="/components/admin_logout.php" style="color:var(--red);" onclick="return confirm('logout from the website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

   <div class="flex-btn">
      <a href="admin_login.php" class="option-btn">login</a>
      <a href="register_admin.php" class="option-btn">register</a>
   </div>

</header>

<div id="menu-btn" class="fas fa-bars"></div>