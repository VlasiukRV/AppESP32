<?php


$sql = "SELECT id, value1, value2, value3, reading_time FROM SensorData order by reading_time desc limit 1";

$result = $mysqli->query($sql);

$sensor_data[] = array();
while ($data = $result->fetch_assoc()) {
    $sensor_data[] = $data;
}

$current_time = date("Y-m-d H:i:s", strtotime($sensor_data[1]['reading_time'] . "- 6 hours"));
$current_temperature = $sensor_data[1]['value2'];
$current_humidity = $sensor_data[1]['value3'];

$result->free();

?>

<br>
<!--<div><p><a href="index.php" class="btn btn-primary">Back</a></p></div>-->

<div class="row justify-content-center">
    <div class="col text-center">
        <h2>Current data <?php echo $current_time ?></h2>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col">
        <div class="p-3 border bg-light text-center">
            <div class="temperature-text"><h4>Temperature</h4></div>
            <div class="temperature"><h4><?php echo $current_temperature ?><span class="superscript">F</span></h4></div>
        </div>
    </div>
    <div class="col">
        <div class="p-3 border bg-light text-center">
            <div class="humidity-text"><h4>Humidity</h4></div>
            <div class="humidity"><h4><?php echo $current_humidity ?><span class="superscript">%</span></h4></div>
        </div>
    </div>
</div>


