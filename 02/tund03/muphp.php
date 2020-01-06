<?php 	
	require("../../../../config.php");
	require("getsql.php");
	require("addfilm.php");

	$userName = "Martten Mitri";
	$database = "if19_inga_pe_4";


readAllFilms();

?>

<html lang="en">

	<head>

		<title>
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="nice.css">

	</head>

	<body>

        <div>

				<?php
					echo readAllFilms();
				 ?>	
				
                <button class="button button3">
                </button>
		
        </div>

	</body>
	
</html>