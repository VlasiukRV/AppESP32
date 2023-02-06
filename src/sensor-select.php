<?php
// Include config file
require_once "config.php";
require_once "inc/htmlTable.php";

// Attempt select query execution
$sql_query = "SELECT * FROM Sensors";

$html_table_setting = [
    'editRow' => true,
    'tableName' => 'Sensors'
];

$column_array = [
    ['id', '#'],
    ['name', 'Name'],
    ['location', 'Location'],
    ['user', 'User'],
    ['description', 'Description']
];

$html_tableData = getHtmlTable($mysqli, $sql_query, $column_array, $html_table_setting);

?>

<div class="row">
    <div class="col-md-12">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Sensors Details</h2>
            <a href="sensor-create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Sensor</a>
        </div>

        <?php echo $html_tableData; ?>

    </div>
</div>
