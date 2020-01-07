<?php
  require("functions_main.php");
  require("../../../../config.php");
  require("functions_user.php");
  require("functions_pic.php");
  require("classes/Picupload.class.php");
  $database = "if19_martten_mi_1";
  
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
  
  $notice = null;
  $myDescription = null;

  
 if(isset($_POST["submitPassword"])){
      $notice = change_password($_POST["oldpassword"],$_POST["newpassword"]);
    }
	
  if(isset($_POST["submitProfile"])){
	$notice = storeUserProfile($_POST["description"], $_POST["bgcolor"], $_POST["txtcolor"]);
	if(!empty($_POST["description"])){
	  $myDescription = $_POST["description"];
	}
	$_SESSION["bgColor"] = $_POST["bgcolor"];
	$_SESSION["txtColor"] = $_POST["txtcolor"];
  } else {
	$myProfileDesc = showMyDesc();
	if($myProfileDesc != ""){
	  $myDescription = $myProfileDesc;
    }
  }
  
  require("header.php");
  
  //pic upload
  
  $notice = null;
  //var_dump($_POST);
  //$target_dir = "uploads/";
  $fileSizeLimit = 2500000;
  $maxPicW = 600;
  $maxPicH = 400;
  $fileNamePrefix = "vp_";
  $thumbW = 100;
  $thumbH = 100;
  
  // Check if image file is a actual image or fake image
  if(isset($_POST["submitPic"]) and !empty($_FILES["fileToUpload"] ["name"])) {

    $myPic = new Picupload($_FILES["fileToUpload"], $fileSizeLimit);
		if($myPic->error == null){
			//loome failinime
			$myPic->createFileName($fileNamePrefix);
			//teeme pildi väiksemaks
			$myPic->resizeImage($maxPicW, $maxPicH);
			//kirjutame vähendatud pildi faili
			$notice .= $myPic->savePicFile($pic_upload_dir_300 .$myPic->fileName);
			//thumbnail
			$myPic->resizeImage($thumbW, $thumbH);
			$myPic->savePicFile($pic_upload_dir_100 .$myPic->fileName);
			//salvestan originaali
			$notice .= " " .$myPic->saveOriginal($pic_upload_dir_orig .$myPic->fileName);
			//salvestan info andmebaasi
			$notice .= profilePic($myPic->fileName, test_input($_POST["picture"]));
			$notice = myPic($myPic->fileName);
		} else {
			//1 - pole pildifail, 2 - liiga suur, pole lubatud tüüp
			if($myPic->error == 1){
				$notice = "Üleslaadimiseks valitud fail pole pilt!";
			}
			if($myPic->error == 2){
				$notice = "Üleslaadimiseks valitud fail on liiga suure failimahuga!";
			}
			if($myPic->error == 3){
				$notice = "Üleslaadimiseks valitud fail pole lubatud tüüpi (lubatakse vaid jpg, png ja gif)!";
			}
		}
		unset($myPic);
	}//kas nuppu klikiti kas vajutasid nuppu
  $toScript = "\t".'<script type="text/javascript" src="javascript/checkfilesize.js" defer></script>';
  //<script type="text/javascript" src="javascript/checkfilesize.js" defer></script>"
 
?>
<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description" placeholder="Lisa siia oma tutvustus ..."><?php echo $myDescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $_SESSION["bgColor"]; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $_SESSION["txtColor"]; ?>"><br>
    <label>Vana parool: </label><input name="oldpassword" type="password" value=""><br>
      <label>Uus parool: </label><input name="newpassword" type="password" value=""><br>
      <input name="submitPassword" type="submit" value="Vaheta parool">
      <input name="submitProfile" type="submit" value="Salvesta profiil">
	  <br><br><br>
	  <label>Vali pilt</label><br>
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <br>
	  <label>Alt tekst: </label><input type="text" name="picture">
	  <br>
	  
	  <input name="submitPic" id="submitPic" type="submit" value="Lae pilt üles">
	  
	</form>
	<img src="../pic300x300/<?php echo $_SESSION["picture"]?>" alt="<?php echo $_SESSION["picture"]?>" onerror="this.onerror=null;this.src='../photos/vp_user_generic.png'">
	
	<span id="notice"><?php echo $notice; ?></span>
  
</body>
</html>





