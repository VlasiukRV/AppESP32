<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mysql_esp32');
define('DB_USERNAME', 'ESP32_USER');
define('DB_PASSWORD', 'ESP32_PASSWORD');
define('DB_NAME', 'ESP32');

/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($mysqli === false){
    die("ERROR: Connection failed: " . $mysqli->connect_error);
}
?>