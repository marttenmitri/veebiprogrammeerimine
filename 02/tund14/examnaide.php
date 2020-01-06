<?php
    require("../../../../config.php");
    require("functions_user.php");
    $database = "if19_martten_mi_1";
    require("examfunction.php");
    require("functions_main.php");
	
  require("classes/Session.class.php");
  SessionManager::SessionStart("vp", 0, "/~marttmit/", "greeny.cs.tlu.ee");
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

    $notice = "";
    $car = "";
    $material = "";
    $import = "";
    $export = "";


// info lisamine
    if(isset($_POST["addinfo"])) {

        if (isset($_POST["selectCar"]) and !empty($_POST["selectCar"])) {
            $car = test_input($_POST["selectCar"]);
        } else {
            $carerror = "Palun vali auto";
        }
        if (isset($_POST["selectStuff"]) and !empty($_POST["selectStuff"])) {
            $material = test_input($_POST["selectStuff"]);
        } else {
            $materialerror = "Palun vali material";
        }
        
        if (isset($_POST["import"]) and !empty($_POST["import"])) {
            $import = test_input($_POST["import"]);
        } else {
            $importerror = "Palun sisesta palju oli saabudes!";
        }

        if (isset($_POST["export"]) and !empty($_POST["export"])) {
            $export = test_input($_POST["export"]);
        } else {
            $exporterror = "Palun sisesta palju oli valjudes!";
        }

        if(empty($carerror) and empty($materialerror) and empty($importerror)and empty($exporterror)){
            $notice = storeCarInfo($car, $material, $import, $export);
    
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

            <h2>Info autode ja vilja kohta</h2>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label>Vali auto</label>
                <select name ="selectCar" id="selectCar">
                    <option value="ASD352">ASD352</option>
                    <option value="GTJ621">GTJ621</option>
                    <option value="HMH122">HMH122</option>
                    <option value="HHT432">HHT432</option>
                </select><br><br>
            <label>Vali Koorem</label>
                <select name="selectStuff" id="selectStuff">
                    <option value="wheat">wheat</option>
                    <option value="potato">potato</option>
                    <option value="candy">candy</option>
                    <option value="carrots">carrots</option>
                </select><br><br>
            <label>Sisesta sisenemismass kilogrammides </label><input type="number" name="import" id="import">
            <br><br>
            <label>Sisesta väljumismass kilogrammides </label></label> <input type="number" name="export" id="export">
            <input name="addinfo" id="addinfo" type="submit" value="Sisesta info"></span><span><?php echo $notice; ?></span>
		</form>
	</body>
</html>