<?php


$sql = "SELECT id, value1, value2, value3, reading_time FROM SensorData order by reading_time desc limit 100";

$result = $mysqli->query($sql);

$sensor_data[] = array();
while ($data = $result->fetch_assoc()) {
    $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'reading_time');

// ******* Uncomment to convert readings time array to your timezone ********
$i = 0;
foreach ($readings_time as $reading) {
    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    $readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading - 6 hours"));
    // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
    //$readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading + 4 hours"));
    $i += 1;
}

$value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);

$current_time =  $readings_time[1];
$current_temperature =  $sensor_data[1]['value2'];
$current_humidity =  $sensor_data[1]['value2'];

$result->free();

?>

<h2>ESP Weather Station</h2>
<br>
<!--<div><p><a href="index.php" class="btn btn-primary">Back</a></p></div>-->

<div class="container text-center">
    <h2>Current data <?php echo $current_time ?></h2>

    <div class="row">
        <div class="col">
            <div class="p-3 border bg-light">
                <div class="temperature-text"><h4>Temperature</h4></div>
                <div class="temperature"><h4><?php echo $current_temperature?><span class="superscript">F</span></h4></div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 border bg-light">
                <div class="humidity-text"><h4>Humidity</h4></div>
                <div class="humidity"><h4><?php echo $current_humidity?><span class="superscript">%</span></h4></div>
            </div>
        </div>
    </div>

    <h2>Last hour</h2>

    <div class="row align-items-start">
        <div class="col">
            <div class="p-3 border bg-light">
                <div id="chart-temperature" class="container"></div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 border bg-light">
                <div id="chart-humidity" class="container"></div>
            </div>
        </div>
        <div id="chart-pressure" class="container"></div>
    </div>

</div>
<script>

    var value1 = <?php echo $value1; ?>;
    var value2 = <?php echo $value2; ?>;
    var value3 = <?php echo $value3; ?>;
    var reading_time = <?php echo $reading_time; ?>;

    var chartT = new Highcharts.Chart({
        chart: {renderTo: 'chart-temperature'},
        title: {text: 'Temperature C'},
        series: [{
            showInLegend: false,
            data: value1
        }],
        plotOptions: {
            line: {
                animation: false,
                dataLabels: {enabled: true}
            },
            series: {color: '#059e8a'}
        },
        xAxis: {
            type: 'datetime',
            categories: reading_time
        },
        yAxis: {
            title: {text: 'Temperature (Celsius)'}
            //title: { text: 'Temperature (Fahrenheit)' }
        },
        credits: {enabled: false}
    });

    var chartH = new Highcharts.Chart({
        chart: {renderTo: 'chart-temperature'},
        title: {text: 'Temperature F'},
        series: [{
            showInLegend: false,
            data: value2
        }],
        plotOptions: {
            line: {
                animation: false,
                dataLabels: {enabled: true}
            }
        },
        xAxis: {
            type: 'datetime',
            //dateTimeLabelFormats: { second: '%H:%M:%S' },
            categories: reading_time
        },
        yAxis: {
            title: {text: 'Temperature F'}
        },
        credits: {enabled: false}
    });


    var chartP = new Highcharts.Chart({
        chart: {renderTo: 'chart-humidity'},
        title: {text: 'Humidity %'},
        series: [{
            showInLegend: false,
            data: value3
        }],
        plotOptions: {
            line: {
                animation: false,
                dataLabels: {enabled: true}
            },
            series: {color: '#18009c'}
        },
        xAxis: {
            type: 'datetime',
            categories: reading_time
        },
        yAxis: {
            title: {text: 'Humidity (%)'}
        },
        credits: {enabled: false}
    });

</script>
