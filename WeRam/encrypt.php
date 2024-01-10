<?php

$json_string = '[{"Email":"bruh","Username":"HELLoh","Password":"hi"},{"Email":"sdasda@ewewew.com","Username":"eww","Password":"34321"}]';

// Encoding test
//$json_string = json_encode('[{"Email":"nick.pouliot@gmail.com","Username":"HELLoh","Password":"hi"},{"Email":"sdasda@ewewew.com","Username":"eww","Password":"34321"}]');

$simple_string = htmlspecialchars($json_string);
// Store cipher method
$ciphering = "BF-CBC";

// Use OpenSSl encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Use random_bytes() function which gives
// randomly 16 digit values
$encryption_iv = random_bytes($iv_length);

// Alternatively, we can use any 16 digit
// characters or numeric for iv
$encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

// Encryption of string process starts
$encryption = openssl_encrypt($simple_string, $ciphering,
		$encryption_key, $options, $encryption_iv);

// Display the encrypted string
echo "Encrypted String: " . $encryption . "\n";

// Write the encrypted text to the users.txt file
$encryptedusers = fopen("debug/encryption-page-encryptedusers.txt", "w") or die("Unable to open file!");
$encryptedtext = $encryption;
//fwrite($encryptedusers, $encryptedtext);

fwrite($encryptedusers, $encryptedtext);
fclose($encryptedusers);



?>