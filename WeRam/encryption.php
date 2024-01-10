<?php
$password = $_POST["password"];
$hash = password_hash($password, PASSWORD_BCRYPT);
$_POST["password"] = $hash;


?>