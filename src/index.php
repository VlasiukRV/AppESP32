<?php

require_once "inc/header.php";

?>
<div class="row">
    <div class="col">
    <div class="btn-group" role="group">
        <a href="sensor-select.php" class="btn btn-primary">Sensors</a>
        <a href="esp-data-select.php" class="btn btn-primary">Data</a>
    </div>
    </div>
</div>

<?php
require_once "esp-chart.php";

require_once "esp-chart-byhour.php";

require_once "inc/footer.php";
?>
