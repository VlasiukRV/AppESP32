<?php

require_once "inc/header.php";

?>
<div class="row">
    <div class="col">
    <div class="btn-group" role="group">
        <a href="tableRow-select.php?tableName=Sensors" class="btn btn-primary">Sensors</a>
        <a href="tableRow-select.php?tableName=SensorData" class="btn btn-primary">SensorData</a>
        <a href="mqtt.php" class="btn btn-primary">get data using MQTT</a>
    </div>
    </div>
</div>

<?php

?>
<div class="row align-items-center">
    <div class="col">
        <h2>ESP Weather Station</h2>
    </div>
</div>

<?php

require_once "esp-chart-current.php";

require_once "esp-chart.php";

require_once "esp-chart-byhour.php";

require_once "inc/footer.php";
?>
