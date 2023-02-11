<?php


$sql = "SELECT MAX_TEMPERATYRE, TEMPERATYRE, MIN_TEMPERATYRE, MAX_HUMIDITY, HUMIDITY, MIN_HUMIDITY, DATE FROM sensor_data_by_hour order by DATE desc limit 25";

$result = $mysqli->query($sql);

$sensor_data[] = array();
while ($data = $result->fetch_assoc()) {
    $sensor_data[] = $data;
}

$temperature_value1 = json_encode(array_reverse(array_column($sensor_data, 'MAX_TEMPERATYRE')), JSON_NUMERIC_CHECK);
$temperature_value2 = json_encode(array_reverse(array_column($sensor_data, 'TEMPERATYRE')), JSON_NUMERIC_CHECK);
$temperature_value3 = json_encode(array_reverse(array_column($sensor_data, 'MIN_TEMPERATYRE')), JSON_NUMERIC_CHECK);
$humidity_value1 = json_encode(array_reverse(array_column($sensor_data, 'MAX_HUMIDITY')), JSON_NUMERIC_CHECK);
$humidity_value2 = json_encode(array_reverse(array_column($sensor_data, 'HUMIDITY')), JSON_NUMERIC_CHECK);
$humidity_value3 = json_encode(array_reverse(array_column($sensor_data, 'MIN_HUMIDITY')), JSON_NUMERIC_CHECK);

$reading_time = json_encode(array_reverse(array_column($sensor_data, 'DATE')), JSON_NUMERIC_CHECK);


$result->free();

?>

<br>

<div class="row justify-content-center">
    <div class="col text-center">
        <h2>Last days</h2>
    </div>
</div>

<div class="row align-items-start">
    <div class="col">
        <div class="p-3 border bg-light">
            <div id="chart-temperature-by-hour" class="container"></div>
        </div>
    </div>
</div>

<div class="row align-items-start">
    <div class="col">
        <div class="p-3 border bg-light">
            <div id="chart-humidity-by-hour" class="container"></div>
        </div>
    </div>
</div>

<script>

    var temperature_value1 = <?php echo $temperature_value1; ?>;
    var temperature_value2 = <?php echo $temperature_value2; ?>;
    var temperature_value3 = <?php echo $temperature_value3; ?>;
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
            name: 'max Temperature F',
            data: temperature_value1
        }, {
            name: 'avg Temperature F',
            data: temperature_value2
        }, {
            name: 'min Temperature F',
            data: temperature_value3
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
            title: {text: 'Fahrenheit'}
        },
        credits: {enabled: false}
    });

    var humidity_value1 = <?php echo $humidity_value1; ?>;
    var humidity_value2 = <?php echo $humidity_value2; ?>;
    var humidity_value3 = <?php echo $humidity_value3; ?>;

    var chartT = new Highcharts.Chart({
        chart: {renderTo: 'chart-humidity-by-hour'},
        title: {text: 'Humidity %'},
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [{
            name: 'max Humidity',
            data: humidity_value1
        }, {
            name: 'avg HumidityF',
            data: humidity_value2
        }, {
            name: 'min Humidity',
            data: humidity_value3
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
            title: {text: '%'}
        },
        credits: {enabled: false}
    });

</script>
