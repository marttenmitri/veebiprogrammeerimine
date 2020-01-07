<?php
  require("../../../../config.php");
  require("functions_user.php");
  $database = "if19_martten_mi_1";
  require("functions_news.php");
    require("functions_main.php");
	
  require("classes/Session.class.php");
  SessionManager::sessionStart("vp", 0, "/~marttmit/", "greeny.cs.tlu.ee");
  //kui pole sisseloginud
  if(!isset($_SESSION["userId"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: myindex.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: myindex.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
    require("header.php");

 
?>
	<body>
	  <?php
		echo "<h1>" .$userName ." koolitöö leht</h1>";
	  ?>
		<p>See leht on loodud koolis õppetöö raames
		ja ei sisalda tõsiseltvõetavat sisu!</p>
		<hr>
		<p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
		<ul>
            <li><a href="add_film.php">lisa filme</a></li>
            <li><a href="filminfo.php">filmide info</a></li>
        </ul>
	</body>
</html>