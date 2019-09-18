<?php 
	$userName = "Martten 123";
	$fulltimenow = date("d,m,Y H:i:s");
	$hournow = date("H");
	$partofday = "Hagune aeg";

	if($hournow < 12){
		$partofday = "Hommik";
	}
	if($hournow >= 12 and $hournow < 18){
		$partofday = "Louna";
	}
	if($hournow > 18){
		$partofday = "ohtu";
	}
	if($hournow == 22){
		$partofday = "Mine magama";
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
                        <a href="https://www.tlu.ee/" class="text"> <?php echo $partofday;?></a>
                </button>
            
        </div>
		
	

	</body>
	
</html>