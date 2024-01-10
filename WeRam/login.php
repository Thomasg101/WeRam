<?php
session_start();
$username    = $password    = "";
$usernameErr = $passwordErr = $passwordVerifyErr = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST" && ( !empty( $_POST["login"] ) && $_POST["login"] == "Submit" ) ) {

    // check if username exists
    if ( empty( $_POST["username"] ) ) {
        $usernameErr = "A username is required";
    } else {
        $username          = check_inputs( $_POST["username"] );
        $_POST["username"] = check_inputs( $_POST["username"] );
    }

    // check if password exists
    if ( empty( $_POST["password"] ) ) {
        $passwordErr = "A password is required";
    } else {
        $password          = check_inputs( $_POST["password"] );
        $_POST["password"] = check_inputs( $_POST["password"] );
    }

    // check if username and password match
    if ( $usernameErr == "" && $passwordErr == "" ) {

        // read json file into array of strings
        $jsonstring = file_get_contents( "userprofiles.json" );

        // save the json data as a PHP array
        $phparray = json_decode( $jsonstring, true );

        // loop through json file
        foreach ( $phparray as $value ) {
            // if username matches the database
            if ( $value["username"] == $username ) {

                // Check if the hash matches the password entered
                $verify = password_verify( $password, $value["password"] );

                // If it matches it will post username to session and uid
                if ( $verify ) {
                    $verifyErr            = '';
                    $_SESSION['username'] = $username;
                    $_SESSION['UID']      = $value["UID"];

                    // redirect the page to home
                    header( "Location: ./index.php?pageNum=2" );
                }
            }
        }
    } else {
        header( "Location: ./login.php" );
    }

}
function check_inputs( $data )
{
    $data = trim( $data );
    $data = stripslashes( $data );
    $data = htmlspecialchars( $data );
    return $data;
}

/*
$fileName = "userprofiles.json";
$logins = file_get_contents($fileName);
$result = false;

if(isset($logins)){
$loginsArray = json_decode($logins, true);
}

else{
echo "There are no accounts";
}

if($_SERVER["REQUEST_METHOD"] == "POST" && $pageNum == 3){

//submitted username and passord
$Username = isset($_POST['username']) ? $_POST['username'] : '';
$Password = isset($_POST['password']) ? $_POST['password'] : '';

foreach($loginsArray as $value){
echo "<pre>";
var_dump($value["username"]);
echo "</pre>";
if(($value["username"] == $Username) && (password_verify($Password, $value["password"]))){
$_SESSION["username"] = $Username;
include "home.inc";
}
else{
$_SESSION["username"] = "";
}
}

/*
if (isset($logins[$username]) && $logins[$username] == $password) {
// Success: Set session variables and redirect to Protected page
$_SESSION['UserData']['username'] = $logins[$username];
include "form.inc";
exit;
} else {
include "home.inc";
}
}
 */
include "login.inc";
?>