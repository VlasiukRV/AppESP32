<div class="row">
    <div class="col-md-12">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">ESP Sensor Data</h2>
            <a href="esp-chart.php" class="btn  pull-right"><i class="fa fa-eye"></i> View Chart</a>
        </div>
        <?php

        // Attempt select query execution
        $sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData ORDER BY id DESC";

        if($result = $mysqli->query($sql)){
            if($result->num_rows > 0){
                echo '<table class="table table-bordered table-striped">';
                echo "<thead>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Sensor</th>";
                echo "<th>Location</th>";
                echo "<th>Temperature C</th>";
                echo "<th>Temperature F</th>";
                echo "<th>Humidity</th>";
                echo "<th>Timestamp</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = $result->fetch_array()){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['sensor'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['value1'] . "</td>";
                    echo "<td>" . $row['value2'] . "</td>";
                    echo "<td>" . $row['value3'] . "</td>";
                    echo "<td>" . $row['reading_time'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                // Free result set
                $result->free();
            } else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        ?>
    </div>
</div>
