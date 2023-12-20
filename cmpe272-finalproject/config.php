<?php
define('DB_SERVER', '208.91.198.197:3306');
define('DB_USERNAME', 'cmpe272');
define('DB_PASSWORD', 'Hello@123321#');
define('DB_NAME', 'mp_marketplacedb');
 
/* Attempt to connect to MySQL database */
// $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
