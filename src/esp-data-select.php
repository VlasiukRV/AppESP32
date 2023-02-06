<?php
// Include config file
require_once "config.php";
require_once "inc/htmlTable.php";

// Attempt select query execution
$sql_query = "SELECT * FROM SensorData ORDER BY id DESC";

$html_table_setting = [
    'editRow' => true,
    'tableName' => 'SensorData'
];

$column_array = [
    ['id', '#'],
    ['sensor', 'Sensor'],
    ['location', 'Location'],
    ['value1', 'Temperature C'],
    ['value2', 'Temperature F'],
    ['value3', 'Humidity %'],
    ['reading_time', 'Timestamp']
];

$html_tableData = getHtmlTable($mysqli, $sql_query, $column_array, $html_table_setting);

?>

<div class="row">
    <div class="col-md-12">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">ESP Sensor Data</h2>
            <a href="esp-chart.php" class="btn  pull-right"><i class="fa fa-eye"></i> View Chart</a>
        </div>

        <?php echo $html_tableData; ?>

    </div>
</div>
