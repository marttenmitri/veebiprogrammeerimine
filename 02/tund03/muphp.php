<?php 
	$userName = "Martten 123";
	$fulltimenow = date("d,m,Y H:i:s");
	$hournow = date("H");
	$partofday = "Hagune aeg";
	$photoDir = "../photos/";
	$photoTypesAllowed = ["image/jpeg", "image/png"];

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
//Semestri vark
	$semesterStart = new DateTime("2019-9-2");
	$semesterEnd = new DateTime("2019-12-13");
	$semesterDur = $semesterStart -> diff($semesterEnd);
	//var_dump($semesterStart);
	//echo $semesterStart -> timrzone;
	$today = new DateTime("now");
	$fromSemesterStart = $semesterStart -> diff($today);
	//var_dump($fromSemesterStart);
	//echo "paevi: " .$fromSemesterStart -> format("%r%a");
	//<p>Semester on taies hoos: <meter min="0" max="100" value="50">50%</meter></p>
	$semesterinfoHTML = "";
	
	if ($fromSemesterStart -> format("%r%a") > 0 and $fromSemesterStart -> format("%r%a") <= $semesterDur -> format("%r%a")){
		$semesterinfoHTML = "<p>Semester on taies hoos: ";
		$semesterinfoHTML .= '<meter min="0"';
		$semesterinfoHTML .= '<meter max="' .$semesterDur -> format("%r%a") .'" ';
		$semesterinfoHTML .= 'value="' .$fromSemesterStart -> format("%r%a") .'" ';
		$semesterinfoHTML .= round($fromSemesterStart -> format("%r%a") / $semesterDur -> format("%r%a") * 100, 1). "%";
		$semesterinfoHTML .= "</meter></p>";
	}

//juhusliku photo kasutamine
	$photoList = [];
	$allFiles = array_slice(scandir($photoDir), 2);
	foreach ($allFiles as $file){
		$fileInfo = getimagesize($photoDir. $file);
		if(in_array($fileInfo["mime"], $photoTypesAllowed) == true){
			array_push($photoList, $file);
		}
	}
	//$photoList = ["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"];
	//var_dump($photoList[2]);
	$photoCount = count($photoList);
	$randomImgHTML = "";
	if($photoCount > 0){
		$photonum = mt_rand(0, $photoCount - 1);
		//<img src="../photos/tlu_astra_600x400_1.jpg" alt="Random Picture">
		$randomImgHTML = '<img src="' .$photoDir. $photoList[$photonum]. '" alt="Random Picture"';
	}
	else{
		$randomImgHTML =  "<p>Puuulje</p>";
	}
	//require(header.php)
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

        <div>

				<?php
				 echo $semesterinfoHTML;
				 echo  "<hr>";
				 echo $randomImgHTML;
				 ?>	
				

                <button class="button button3">
                        <a href="https://www.tlu.ee/" class="text"> <?php echo $partofday;?></a>
                </button>
		
        </div>

	</body>
	
</html>