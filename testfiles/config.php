<?php
/*Database credentials user 'root' pass 'toor' */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('B_PASSWORD', 'toor');
define('DB_NAME', 'users');

//Attempt to connect to MySQL database 
$link = mysqli_connection(DB_SERVER, DB_USERNAME, DB_PASSWORD, DN_NAME);

//Check connection
if($link === false){
        die("ERROR: Could not connect." . mysqli_connect_error());
}
?>
~  
