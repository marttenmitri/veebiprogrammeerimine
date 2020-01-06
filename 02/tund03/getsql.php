<?php 	
function readAllFilms(){
	//var_dump($GLOBALS);

	//andmebaasi yhenuds
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

	//valmistame ette sqg paringu, naiteks muutujanimega querry voi..
	$stmt = $conn->prepare("SELECT pealkiri, aasta FROM film");
	echo $conn->error;
	//seome saadava tulemuse muutujaga
	$stmt->bind_result($filmTitle, $filmYear);
	//taidame kasu ehk sooritame paringu
	$stmt->execute();
	echo $stmt->error;

	$filmInfoHtml = null;

	//votan tulemuse
	while($stmt->fetch()){
		$filmInfoHtml .= "<h3>" .$filmTitle ."</h3>";
		$filmInfoHtml .= "<h3>" .$filmYear ."</h3>";
	}
	//sulgeme yhendused
	$stmt->close();
	$conn->close();
	return $filmInfoHtml;
}

function storeFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector){

	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

	$stmt = $conn->prepare("INSERT INTO film(pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");

	//seon saadetava info muutujatega
	//andmetyybid S - string i - int  d- decimal
	$stmt->bind_param("siisss", $filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector );
	$stmt->execute();

	$stmt->close();
	$conn->close();
}
?>