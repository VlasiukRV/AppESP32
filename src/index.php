<?php

require_once "inc/header.php";

?>

<ul class="nav justify-content-end">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="tableRow-select.php?tableName=Sensors">Sensors</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tableRow-select.php?tableName=SensorData">SensorData</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="mqtt.php">get data using MQTT</a>
    </li>
</ul>

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
