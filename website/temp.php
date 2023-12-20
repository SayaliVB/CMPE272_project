<?php

$password = array("chole88", "trixie44", "eve876", "dan786", "Parkmoore33", "Charlotte66", "Unicorns", "Charlie12", "PrettyBadass", "Versecret", "SmartyPants66", "MikeHan", "Richierich$$", "Dinosours2234**", "foodie&amp;23", "SuperMom93", "Manny$$73", "MannytheGreat643", "ClownCity45$", "TheUnknown144");

for($x = 0; $x < count($password); $x++) {

    //password encryption
    $cipher_algo = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $cipher_iv_len = openssl_cipher_iv_length($cipher_algo);
    echo $cipher_iv_len;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '965478510121';

    // Encryption key
    $encryption_key = "Secret_Key647";

    // Use openssl_encrypt() function to encrypt the data
    $passwordform = openssl_encrypt($password[$x], $cipher_algo, $encryption_key, 0, $encryption_iv);

    echo "<br>";
}




?>