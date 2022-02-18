<?php
/* Database credentials */
define('DB_SERVER', 'db');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password');
define('DB_NAME1', 'demo');
 

$link = mysqli_connect(DB_SERVER , DB_USERNAME, DB_PASSWORD, DB_NAME1);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


?>