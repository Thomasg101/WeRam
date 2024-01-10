<?php
session_start();
echo "Today's Date is: " . date( "Y/m/d" );
include "header.inc";
include "createthumbnail.php";
$testtest123  = "";
$ifloginWorks = "not logged in";
$currentDate  = date( "Y/m/d" );
$uploadOk     = 1;
$target_dir   = "profileimages/";
$target_file;
$imageFileType;
$uid        = 0;
$identifier = "identifier.txt";
$dir        = "profileimages/";
$dest       = "thumbnails/";

if ( isset( $_SESSION["username"] ) ) {
    echo "You are logged in as: " . $_SESSION["username"];
} else {
    echo "You are not logged in! Please visit login page or create a profile";
}
// Check if file already exists
//sees if you click the delete button for the json file
if ( isset( $_GET["action"] ) && ( $_GET["action"] == "del" ) ) {
    $action = $_GET["action"];
    touch( "userprofiles.json" );
    unlink( "userprofiles.json" );
    touch( "identifier.txt" );
    unlink( "identifier.txt" );
    touch( "identifier.txt" );
    if ( $dh = opendir( $dir ) ) {
        while (  ( $file = readdir( $dh ) ) !== false ) {
            if ( !is_dir( $file ) ) {
                unlink( $dir . $file );
                unlink( $dest . $file );
                unlink( $identifier );

                file_put_contents( $identifier, 1 );
            }
        }
        closedir( $dh );
    }
}

//gets a random number from the query string
//query string is the questionmark and everything after it

if ( isset( $_GET["pageNum"] ) ) {
    $pageNum = $_GET["pageNum"];
} else {
    $pageNum = 2;
}
// define variables and set to empty values
// fix the variables
$isDataClean = true;
$name        = $connection        = $textInput        = $agreement        = $grade        = $myFile        = $username        = $password        = "";
$nameErr     = $connectionErr     = $textInputErr     = $agreementErr     = $gradeErr     = $myFileErr     = $usernameErr     = $passwordErr     = $passwordVerifyErr     = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST" && ( !empty( $_POST["createprofile"] ) && $_POST["createprofile"] == "Submit" ) ) {
    $target_file   = $target_dir . basename( $_FILES["myfile"]["name"] );
    $imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );

    if ( empty( $_POST["name"] ) ) {
        $nameErr     = "Name is required";
        $isDataClean = false;
    } else {
        $name = check_input( $_POST["name"] );
    }
    if ( empty( $_POST["grade"] ) ) {
        $gradeErr    = "Grade is required";
        $isDataClean = false;
    } else {
        $grade = check_input( $_POST["grade"] );
    }
    if ( empty( $_POST["connection"] ) ) {
        $connectionErr = "Connection is required";
        $isDataClean   = false;
    } else {
        $connection = check_input( $_POST["connection"] );
    }

    if ( empty( $_POST["textInput"] ) ) {
        $textInputErr = "Text input is required";
        $isDataClean  = false;
    } else {
        $textInput = check_input( $_POST["textInput"] );
    }

    if ( empty( $_POST["Agreement"] ) ) {
        $agreementErr = "You didn't agree";
        $isDataClean  = false;
    } else {
        $agreement = check_input( $_POST["Agreement"] );
    }
    if ( empty( $_FILES["myfile"]["name"] ) ) {
        $myFileErr   = "picture is required";
        $isDataClean = false;
    }
    if ( file_exists( $target_file ) ) {
        $myFileErr   = "picture upload error";
        $isDataClean = false;
    } else if ( $_FILES["myfile"]["size"] > 500000 ) {
        $myFileErr   = "Sorry, your file is too large.";
        $isDataClean = false;
    } else if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $myFileErr   = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $isDataClean = false;
    }
    if ( $isDataClean ) {
        $_SESSION["username"] == $_POST["username"];
        include "encryption.php";
        $uid = file_get_contents( $identifier );
        unlink( $identifier );
        if ( move_uploaded_file( $_FILES["myfile"]["tmp_name"], $target_dir . $uid . "." . $imageFileType ) ) {
        }
        if ( $dh = opendir( $dir ) ) {
            while (  ( $file = readdir( $dh ) ) !== false ) {
                if ( !is_dir( $dir . $file ) ) {

                    $src = $dir . $file;

                    $dest = "thumbnails/" . $file;

                    if ( !file_exists( $dest ) ) {
                        createThumbnail( $src, $dest, 240, 240 );
                    }

                }
            }
            closedir( $dh );
        }

        $uid++;
        file_put_contents( $identifier, $uid );

    }
    else{
        $_SESSION["username"] == "";
    }
}
/*
if($_SERVER["REQUEST_METHOD"] == "POST" && (!empty($_POST["login"]) && $_POST["login"] == "Submit")){

echo "af sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sdf sd";
//header("Location: https://pureinfotech.com/set-gpu-app-windows-10/");
// check if username exists
if (empty($_POST["username"])) {
$usernameErr = "A username is required";
} else {
$username = check_input($_POST["username"]);
$_POST["username"] = check_input($_POST["username"]);
}

// check if password exists
if (empty($_POST["password"])) {
$passwordErr = "A password is required";
} else {
$password = check_input($_POST["password"]);
$_POST["password"] = check_input($_POST["password"]);
}

// check if username and password match
if ($usernameErr == "" && $passwordErr == "") {

// read json file into array of strings
$jsonstring = file_get_contents("userprofiles.json");

// save the json data as a PHP array
$phparray = json_decode($jsonstring, true);
$verifyErr = 'The username or password entered is incorrect';
foreach ($phparray as $value) {
if ($value["username"] == $username) {
// Verify the hash against the password entered
$verify = password_verify($password, $value["password"]);
if ($verify) {
$verifyErr = '';
$testtest123 = $value["username"];
$_SESSION['username'] = $username;
$_SESSION['UID'] = $value["UID"];
// redirect the page to index.php?page=home to avoid refresh
header("Location: ./index.php?pageNum=2");
} else{
$passwordVerifyErr == "This password is incorrect";
}
}
}
} else{
header("Location: ./index.php?pageNum=3");
}
echo "bro";

}
 */
if ( $isDataClean == true && $_SERVER["REQUEST_METHOD"] == "POST" && ( !empty( $_POST["createprofile"] ) && $_POST["createprofile"] == "Submit" ) ) {
    
    // read json file into array of strings
    $file = "userprofiles.json";
    if ( !file_exists( $file ) ) {
        touch( $file );
    }

    $jsonstring = file_get_contents( $file );

    //decode the string from json to PHP array
    $phparray           = json_decode( $jsonstring, true );
    $_POST["imagetype"] = $imageFileType;
    $_POST["uid"]       = $uid - 1;
    // add form submission to data
    $phparray[] = $_POST;

    // encode the php array to formatted json
    $jsoncode = json_encode( $phparray, JSON_PRETTY_PRINT );

    // write the json to the file
    file_put_contents( $file, $jsoncode );
    
}

function check_input( $data )
{
    $data = trim( $data );
    $data = stripslashes( $data );
    $data = htmlspecialchars( $data );
    return $data;
}

//post data has an unique identifier to see which form has been submitted
//modify json so that it doesn't include that
//hidden or submit

if ( $isDataClean && $_SERVER["REQUEST_METHOD"] == "POST" && $pageNum == 1 ) {
    include "home.inc";
} else if ( !$isDataClean && $_SERVER["REQUEST_METHOD"] == "POST" && ( $pageNum == 2 ) ) {
    include "form.inc";
} else if (  ( $pageNum == 1 ) && $_SERVER["REQUEST_METHOD"] != "POST" ) {
    include "form.inc";

} else if ( $pageNum == 2 && $_SERVER["REQUEST_METHOD"] != "POST" ) {
    include "home.inc";
} else if ( $pageNum == 3 && $_SERVER["REQUEST_METHOD"] != "POST" ) {
    include "login.php";
}

include "footer.inc";