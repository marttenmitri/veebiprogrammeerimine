<?php
  require("../../../../config.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_martten_mi_1";
  //kas sisse logitud
  //kontrollime, kas on sisse loginud
  if(!isset($_SESSION["userId"])){
  header("Location: myindex.php");
  include 'CSS/newuserstyle.css';
	exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  require("header.php");

  echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";
  ?>
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
  <hr>
  <p>Olete sisselogitud! logi <a href="?logout">valja</a> </p>

</body>
</html>