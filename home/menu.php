<div class="menu">

<?php
  if ($_SESSION["role"] === "admin") {
  ?>

  <div class="list bg-f5 text-warning">
    <a href="./"><i class="fa fa-dashboard"></i> Dashboard</a>
  </div>
  <div class="list">
    <a href="view_route.php"><i class="fa fa-street-view"></i> Route</a>
  </div>
  <div class="list">
    <a href="view_driver.php"><i class="fa fa-users"></i> Drivers</a>
  </div>
  <div class="list">
    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
  </div>

  <?php
  }
  ?>


</div>
