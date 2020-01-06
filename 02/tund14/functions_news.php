<?php
function storeNews($newsTitle, $news, $expiredate){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn -> prepare("INSERT INTO vpnews (userid, title, content, expire) VALUES(?,?,?,?)");
	echo $conn -> error;
	$stmt -> bind_param("isss",$_SESSION["userId"], $newsTitle, $news, $expiredate);
	if($stmt -> execute()){
		$notice = "Uudis salvestati!";
	} else {
		$notice = "Uudise salvestamisel tekkis tehniline tõrge: " .$stmt -> error;
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}
