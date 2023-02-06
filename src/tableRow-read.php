<?php
// Include config file
require_once "config.php";

$html ='';
// Check existence of id parameter before processing further
if( (isset($_GET["id"]) && !empty($_GET["id"])) &&
    (isset($_GET["tableName"]) && !empty($_GET["tableName"]))
){

    // Prepare a select statement
    $tableName = trim($_GET["tableName"]);
    $sql = "SELECT * FROM " . $tableName . " WHERE id = ?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);

                foreach ($data_table[$_GET["tableName"]] as $columns) {
                    foreach ($columns as $column) {
                        $html = $html . sprintf('
                            <div class="form-group">
                                <label>%1$s</label>
                                <p><b>%2$s</b></p>
                            </div>
                            ', $column['alias'], $row[$column['name']]);
                    }
                }

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">View Record</h1>

                <?php echo $html; ?>

                <p><a href="index.php" class="btn btn-primary">Back</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>