<?php


$sql = "SELECT MAX_TEMPERATYRE, TEMPERATYRE, MIN_TEMPERATYRE, DATE FROM sensor_data_by_hour order by DATE desc limit 50";

$result = $mysqli->query($sql);

$sensor_data[] = array();
while ($data = $result->fetch_assoc()) {
    $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'DATE');
$value1 = json_encode(array_reverse(array_column($sensor_data, 'MAX_TEMPERATYRE')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($sensor_data, 'TEMPERATYRE')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($sensor_data, 'MIN_TEMPERATYRE')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);

$result->free();

?>

<h2>ESP Weather Station</h2>
<br>
<!--<div><p><a href="index.php" class="btn btn-primary">Back</a></p></div>-->

<div class="container text-center">

    <h2>Last days</h2>

    <div class="row align-items-start">
        <div class="col">
            <div class="p-3 border bg-light">
                <div id="chart-temperature-by-hour" class="container"></div>
            </div>
        </div>
    </div>

</div>
<script>

    var value1 = <?php echo $value1; ?>;
    var value2 = <?php echo $value2; ?>;
    var value3 = <?php echo $value3; ?>;
    var reading_time = <?php echo $reading_time; ?>;
    var colors = ['#FF530D', '#18009c', '#E80C7A'];

    var chartT = new Highcharts.Chart({
        chart: {renderTo: 'chart-temperature-by-hour'},
        title: {text: 'Temperature F'},
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [{
            name: 'min Temperature F',
            data: value1
        },{
            name: 'avg Temperature F',

            data: value2
        },{
            name: 'max Temperature F',

            data: value3
        }
        ],
        plotOptions: {
            line: {
                animation: false,
                dataLabels: {enabled: true}
            },

        },
        colors: colors,
        xAxis: {
            type: 'datetime',
            categories: reading_time
        },
        yAxis: {
            title: {text: 'Temperature (Fahrenheit)'}
        },
        credits: {enabled: false}
    });

</script>
