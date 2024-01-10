

<br><a href="?pageNum=2">Return to Gallery</a><br>


<?php
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
	echo "<pre>";
var_dump($_POST);
echo "</pre>";
	
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?pageNum=3"; ?>">

<label for="Username">Username:</label>
        <input name="username" type="text" class="form-control">

<label>Password</label>
<input type="password" id="Password" name="password"> <input type="checkbox" onclick="showPassword()" class="form-control" class="Input"><label>Show Password</label>
<br>
<input type="submit" name="login">
</form>


<?php
echo "<pre>";
var_dump($_POST);
echo "</pre>";
?>