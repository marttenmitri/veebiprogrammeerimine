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

    $toScript = "\t" .'<link rel="stylesheet" type="text/css" href="style/modal.css">' ."\n";
    $toScript .= "\t" .'<script type="text/javascript" src="javascript/gallery.js" defer></script>' ."\n";
    require("header.php");
	
	$newsTitle = "";
	$news = "";
	$error="";
	$expiredate="";
	
	$notice = null;
  
if(isset($_POST["newsBtn"])) {

    if (isset($_POST["newsTitle"]) and !empty($_POST["newsTitle"])) {
        $newsTitle = test_input($_POST["newsTitle"]);
    } else {
        $titleError = "Palun sisesta uudise pealkiri!";
    }

    if (isset($_POST["newsEditor"]) and !empty($_POST["newsEditor"])) {
        $newsContent = test_input($_POST["newsEditor"]);
        $newsContent = strip_tags(html_entity_decode($newsContent));
    } else {
        $contentError = "Palun sisesta uudise sisu!";
    }

    if (isset($_POST["expiredate"]) and !empty($_POST["expiredate"])) {
        $expiredate = test_input($_POST["expiredate"]);
    } else {
        $dateError = "Palun sisesta uudise sisu!";
    }
	
	if(empty($titleError) and empty($contentError) and empty($dateError)){
        $notice = storeNews($newsTitle, $newsContent, $expiredate);

    } else {
        $notice = "Ei saa salvestada, andmed on puudulikud!";
    }
}

?>
	<body>
	  <?php
		echo "<h1>" .$userName ." koolitöö leht</h1>";
	  ?>
		<p>See leht on loodud koolis õppetöö raames
		ja ei sisalda tõsiseltvõetavat sisu!</p>
		<hr>
		<p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
			<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
			<script>tinymce.init({selector:"textarea#newsEditor", plugins: "link", menubar: "edit",});</script>
		  <h2>Lisa uudis</h2>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label>Uudise pealkiri:</label><br><input type="text" name="newsTitle" id="newsTitle" style="width: 100%;" value="<?php echo $newsTitle; ?>"><br>
			<label>Uudise sisu:</label><br>
			<textarea name="newsEditor" id="newsEditor"><?php echo $news; ?></textarea>
			<br>
			<label>Uudis nähtav kuni (kaasaarvatud)</label>
			<input type="date" name="expiredate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expiredate; ?>">
			
			<input name="newsBtn" id="newsBtn" type="submit" value="Salvesta uudis!"> <span>&nbsp;</span><span><?php echo $notice; ?></span>
		</form>
	</body>
</html>