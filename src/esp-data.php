
<?php

$servername = "mysql_esp32";

// REPLACE with your Database name
$dbname = "ESP32";
// REPLACE with Database user
$username = "ESP32_USER";
// REPLACE with Database user password
$password = "ESP32_PASSWORD";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData ORDER BY id DESC";

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
<div> <a href="/esp-chart.php">ESP CHART</a> </div>

    <table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Sensor</td> 
        <td>Location</td> 
        <td>Value 1</td> 
        <td>Value 2</td>
        <td>Value 3</td> 
        <td>Timestamp</td> 
      </tr>

        <?php
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"];
        $row_value3 = $row["value3"];
        $row_reading_time = $row["reading_time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));

        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));


        echo '<tr>' .
            '<td>' . $row_id . '</td>' .
            '<td>' . $row_sensor . '</td>' .
            '<td>' . $row_location . '</td>' .
            '<td>' . $row_value1 . '</td>' .
            '<td>' . $row_value2 . '</td>' .
            '<td>' . $row_value3 . '</td>' .
            '<td>' . $row_reading_time . '</td>' .
        '</tr>';
    }
    $result->free();
}

$conn->close();
?>
</table>

</body>
</html>