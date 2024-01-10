<?php

$encryptedMessage = "SHLhV+wPJ0YjT7nK4twJC3+Juid4d5sUZyX+8xEHjp1QhW9jSY0VwQtqEgLrj+QnlVGfp+yheG0wcwysND+uS7DZQK8VNFEGw/x1tX8F0mA1wt99xKSqdD5FJ25Ot6nAmlGOQkfCzDjL1zN0fwUfnyr3+U31aWZhMCQz2muaLwjTehanVtLzf7z5Ilsnv0605WDOOWqNwIXRXjRqoORjcNHcjWTkrz9iq76qe5rNSaVvEQpjoE4T7JqMaCzj9EBNvK8/aoMYcDA/XCHdbGKx4oaSdrySJLKclJYILyCP8egQMiQi7I9Eots/ljvsZIZPUlW8GYTSYec=";

// Store cipher method
$ciphering = "BF-CBC";

// Use OpenSSl encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Decryption of string process starts
// Used random_bytes() which gives randomly
// 16 digit values
$decryption_iv = random_bytes($iv_length);

// Store the decryption key
$decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

// Descrypt the string
$decryption = openssl_decrypt ($encryptedMessage, $ciphering,
			$decryption_key, $options, $decryption_iv);

// Display the decrypted string
echo "Decrypted String: " . $decryption;

// Write the encrypted text to the users.txt file
$decryptedusers = fopen("debug/encryption-page-decryptedusers.txt", "w") or die("Unable to open file!");
$decryptedtext = htmlspecialchars_decode($decryption);
fwrite($decryptedusers, $decryptedtext);
fclose($decryptedusers);

?>