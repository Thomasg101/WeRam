<?php
	if(isset($_GET["uid"])){
		$uid = $_GET["uid"];
	}else{
		$uid = 0;
	}

	
	$file = "userprofiles.json";

	if(file_exists($file)){
		$jsonstring = file_get_contents($file);
			
		//decode the string from json to PHP array
		$phparray = json_decode($jsonstring, true);
		
		for($i = 0; $i < count($phparray); $i++){
			if($phparray[$i]["uid"] == $uid){
				echo json_encode($phparray[$i]);
				break;
			}
		}
	}
		echo $uid;


?>