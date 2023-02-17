<?php
// Include config file
require_once "config.php";
require_once "inc/htmlTable.php";
require_once "inc/header.php";

$html_tableData = "";
$tableName = "";

if (isset($_GET["tableName"]) && !empty($_GET["tableName"])
) {
    $tableName = trim($_GET["tableName"]);
    $sql_query = "SELECT * FROM " . $tableName . " ORDER BY id DESC LIMIT 100";


    $html_table_setting = [
        'editRow' => true,
        'tableName' => 'SensorData'
    ];

    $html_tableData = getHtmlTable($mysqli, $sql_query, $data_table[$tableName], $html_table_setting);

}

?>

    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Back</a>
        </li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="mt-5 mb-3 clearfix">
                <h2 class="pull-left"> <?php echo $tableName; ?> </h2>
                <a href="sensor-create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add
                    New <?php echo $tableName; ?></a>
            </div>

            <?php echo $html_tableData; ?>

        </div>
    </div>

<?php

require_once "inc/footer.php";

?>