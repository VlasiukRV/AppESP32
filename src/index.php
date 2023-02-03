<?php
//echo phpinfo();
//    char apiServerURL [200] = "http://192.168.4.38/post-esp-data.php";
//    char apiKeyValue [13] = "tPmAT5Ab3j7F9";
//    char sensorName [10] = "DHT11";
//    char sensorLocation [10] = "Arthur";

// The MySQL service named in the docker-compose.yml.
$host = 'mysql';

// Database use name
$user = 'ESP32_USER';

//database user password
$pass = 'ESP32_PASSWORD';

// database name
$mydatabase = 'ESP32';

// check the MySQL connection status
$conn = new mysqli($host, $user, $pass, $mydatabase);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL server successfully!";
}

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.highcharts.com/highcharts.js"></script>
<style>
    body {
        min-width: 310px;
        max-width: 1280px;
        height: 500px;
        margin: 0 auto;
    }

    h2 {
        font-family: Arial;
        font-size: 2.5rem;
        text-align: center;
    }
</style>
<body>
<h2>ESP Weather Station</h2>
<br>
<div><a href="/esp-chart.php">ESP CHART</a></div>
<div> <a href="/esp-data.php">ESP DATA</a> </div>
</body>
</html>
