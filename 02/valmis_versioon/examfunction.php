<?php
function storeNews($car_name, $car_plate){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn -> prepare("INSERT INTO car_info (car_name, car_plate) VALUES(?,?)");
	echo $conn -> error;
	$stmt -> bind_param("ss", $car_name, $car_plate);
	if($stmt -> execute()){
		$notice = "Auto andmed salvestati!";
	} else {
		$notice = "Auto andmete salvestamisel tekkis tehniline tõrge: " .$stmt -> error;
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}

function storeCarInfo($car, $material, $import, $export){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn -> prepare("INSERT INTO car (car,material, import, export) VALUES(?,?,?,?)");
	echo $conn -> error;
	$stmt -> bind_param("ssii", $car, $material ,$import, $export);
	if($stmt -> execute()){
		$notice = "andmed salvestati!";
	} else {
		$notice = "Auto andmete salvestamisel tekkis tehniline tõrge: " .$stmt -> error;
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}
