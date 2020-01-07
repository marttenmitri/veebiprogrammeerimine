<?php
function addPicData($fileName, $altText, $privacy){
    $notice = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO vpphotos1 (userid, filename, alttext, privacy) VALUES (?, ?, ?, ?)");
    echo $conn->error;
    $stmt->bind_param("issi", $_SESSION["userId"], $fileName, $altText, $privacy);
    if($stmt->execute()){
        $notice = " Pildi andmed salvestati andmebaasi!";
    } else {
        $notice = " Pildi andmete salvestamine ebaönnestus tehnilistel põhjustel! " .$stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function profilePic($fileName, $altText){
    $notice = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO profilepic (userid, filename, alttext) VALUES (?, ?, ?)");
    echo $conn->error;
    $stmt->bind_param("iss", $_SESSION["userId"], $fileName, $altText);
    if($stmt->execute()){
        $notice = " Pildi andmed salvestati andmebaasi!";
    } else {
        $notice = " Pildi andmete salvestamine ebaönnestus tehnilistel põhjustel! " .$stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function showPics($privacy, $page, $limit){
    $picHTML = null;
    $skip = ($page-1)*$limit;

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT id, filename, alttext FROM vpphotos1 WHERE privacy=? AND deleted IS NULL ORDER BY id DESC LIMIT ?,?");
    //$stmt = $conn->prepare("SELECT vpusers.firstname, vpusers.lastname, vpphotos1.id, vpphotos1.filename, vpphotos1.alttext, AVG(vpphotoratings.rating) as AvgValue FROM vpphotos1 JOIN vpusers ON vpphotos1.userid = vpusers.id LEFT JOIN vpphotoratings ON vpphotoratings.photoid = vpphotos1.id WHERE vpphotos1.privacy = ? AND deleted IS NULL GROUP BY vpphotos1.id DESC LIMIT ?, ?");
    echo $conn->error;
    
    $stmt->bind_param("iii", $privacy, $skip, $limit);
    $stmt->bind_result($idFromDb, $fileNameDb, $altTextFromDb);
    $stmt->execute();
    while($stmt->fetch()){
        //img src=kataloog/pildifail" alt=tekst" data-
       $picHTML .= '<img src="' .$GLOBALS["pic_upload_dir_thumb"] .$fileNameDb .'" alt="';
		if(empty($altTextFromDb)){
			$picHTML .= "Illustreeriv foto";
		} else {
			$picHTML .= $altTextFromDb;
		}
		$picHTML .= '" data-fn="' .$fileNameDb .'" data-id="' .$idFromDb .'">'."\n";
	}
    if($picHTML == null){
        $picHTML = "<p>kahjuks pilti ei leidnud</p>";
    }

    $stmt->close();
    $conn->close();
    return $picHTML;
}

function countPics($privacy){
    $picCount ;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT COUNT(id) FROM vpphotos1 WHERE privacy<=? AND deleted IS NULL");
    echo $conn->error;

    $stmt->bind_param("i", $privacy);
    $stmt->bind_result($countFromDb);
    $stmt->execute();
    $stmt->fetch();
    $picCount = $countFromDb;


    $stmt->close();
    $conn->close();
    return $picCount;
}
?>