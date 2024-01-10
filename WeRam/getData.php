<?php
    $fetchuid = 0;
    $jsonstring = "";
    $file = "userprofiles.json";

    if (isset($_GET["uid"])) {
        $fetchuid = $_GET["uid"]; 
    }


    if (file_exists($file)){
        $jsonstring = file_get_contents($file);

        //decode the string from json to PHP array
        $phparray = json_decode($jsonstring, true);

        for ($i = 1; $i <= count($phparray); $i++){
            if($fetchuid == $i){
                $jsoncode = json_encode($phparray[$i - 1], JSON_PRETTY_PRINT);
            echo $jsoncode;
            }
        }
    }

    ?>