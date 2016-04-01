<?php include("./inc/home_header.php"); ?>
<?php include("./inc/conntosql.php"); ?>
<?php
      echo "Welcome ".$_SESSION['username']."!";
      echo "<br>want to logout?..click on";
      ?>
      <a href='logout.php'>Logout</a>
<?php include("./inc/footer.html"); ?>