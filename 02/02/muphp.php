<?php 
	$userName = "Martten 123";
	$fulltimenow = date("d,m,Y H:i:s");

	alert("Hello mannnn");
		function alert($msg) {
			echo "<script type='text/javascript'>alert('$msg');</script>";
			}
?>
<html lang="en">

	<head>
		<title>
			<?php echo $userName;?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="nice.css">
	</head>

	<body>
        <div class="content">
				<?php echo "<h1>Leht avati ". $fulltimenow. "</h1>";?>
                <button class="button button3">
                        <a href="https://www.tlu.ee/" class="text"> <?php echo $userName;?></a>
                </button>
            
        </div>
		
	

	</body>
	
</html>