<?php

$MOSQUITTO_BROKER_URL               = getenv('MOSQUITTO_BROKER_URL');
$MOSQUITTO_BROKER_WEBSOCKET_PORT    = getenv('MOSQUITTO_BROKER_WEBSOCKET_PORT');
$MOSQUITTO_BROKER_USER              = getenv('MOSQUITTO_BROKER_USER');
$MOSQUITTO_BROKER_PASSWORD          = getenv('MOSQUITTO_BROKER_PASSWORD');

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mysql_esp32');
$MYSQL_DATABASE      = getenv('MYSQL_DATABASE');
$MYSQL_USER          = getenv('MYSQL_USER');
$MYSQL_PASSWORD      = getenv('MYSQL_PASSWORD');
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);

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