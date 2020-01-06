<?php 	
	require("../../../../config.php");
	require("getsql.php");

	$userName = "Martten Mitri";
	$database = "if19_inga_pe_4";

	var_dump($_POST);
	if(isset($_POST["submitFilm"])){
		//echo "keegi subbbbbiiiis";
		if(!empty($_POST["filmTitle"])){
			storeFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenre"],$_POST["filmStudio"],$_POST["filmDirector"]);
		}
	}

?>

<html lang="en">

	<head>
		<title>
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="nice.css">

	</head>

	<body>

		<form method="POST">
			<br>
			<label>Filmi Pealkiri</label>
			<input type="text", name="filmTitle">
			<br>
			<label>Filmi tootmisaasta</label>
			<input type="number" min="1912" max="2019" value="2019" name="filmYear">
			<br>
			<label>Filmi kestus (min)</label>
			<input type="number" min="1" max="300" value="80" name="filmDuration">
			<br>
			<label>Filmi zanr</label>
			<input type="text" name="filmGenre">
			<br>
			<label>Filmi Stuudio</label>
			<input type="text" name="filmStudio">
			<br>
			<label>Filmi Lavastaja</label>
			<input type="text" name="filmDirector">
			<br>
			<input type="submit" value="Talleta filmi info" name="submitFilm">
		</form>		

		<?php
			echo readAllFilms();
		?>	

	</body>
	
</html>