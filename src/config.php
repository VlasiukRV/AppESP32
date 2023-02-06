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
if ($mysqli === false) {
    die("ERROR: Connection failed: " . $mysqli->connect_error);
}

$data_table = [
    'SensorData' =>[
        ['id' => ['name'=>'id','alias' => '#', 'type' => 'text']],
        ['sensor' => ['name'=>'sensor','alias' => 'Sensor', 'type' => 'text']],
        ['location' => ['name'=>'location', 'alias' => 'Location', 'type' => 'text']],
        ['value1' => ['name'=>'value1', 'alias' => 'Temperature C', 'type' => 'text']],
        ['value2' => ['name'=>'value2','alias' => 'Temperature F', 'type' => 'text']],
        ['value3' => ['name'=>'value3', 'alias' => 'Humidity %', 'type' => 'text']],
        ['reading_time' => ['name'=>'reading_time', 'alias' => 'Timestamp', 'type' => 'date']]
    ],

    'Sensors' => [
        ['id' => ['name'=>'id','alias' => '#', 'type' => 'text']],
        ['name' => ['name'=>'name','alias' => 'Name', 'type' => 'text']],
        ['location' => ['name'=>'location', 'alias' => 'Location', 'type' => 'textarea']],
        ['user' => ['name'=>'user', 'alias' => 'User', 'type' => 'text']],
        ['description' => ['name'=>'description', 'alias' => 'Description', 'type' => 'textarea']]
    ]
];

?>