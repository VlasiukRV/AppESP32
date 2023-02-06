<?php
// Include config file
require_once "config.php";

// $stmt = The SQL Statement Object
// $param = Array of the Parameters
function DynamicBindVariables($stmt, $params)
{
    if ($params != null)
    {
        // Generate the Type String (eg: 'issisd')
        $types = '';
        foreach($params as $param)
        {
            if(is_int($param)) {
                // Integer
                $types .= 'i';
            } elseif (is_float($param)) {
                // Double
                $types .= 'd';
            } elseif (is_string($param)) {
                // String
                $types .= 's';
            } else {
                // Blob and Unknown
                $types .= 'b';
            }
        }

        // Add the Type String as the first Parameter
        $bind_names[] = $types;

        // Loop thru the given Parameters
        for ($i=0; $i<count($params);$i++)
        {
            // Create a variable Name
            $bind_name = 'bind' . $i;
            // Add the Parameter to the variable Variable
            $$bind_name = $params[$i];
            // Associate the Variable as an Element in the Array
            $bind_names[] = &$$bind_name;
        }

        // Call the Function bind_param with dynamic Parameters
        call_user_func_array(array($stmt,'bind_param'), $bind_names);
    }
    return $stmt;
}

$html = '';
// Define variables and initialize with empty values
$name = $location = $user = "";
$name_err = $location_err = $user_err = "";

// Processing form data when form is submitted
if ((isset($_POST["id"]) && !empty($_POST["id"])) &&
    (isset($_POST["tableName"]) && !empty(trim($_POST["tableName"])))) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
//    $input_name = trim($_POST["name"]);
//    if (empty($input_name)) {
//        $name_err = "Please enter a name.";
//    } else {
//        $name = $input_name;
//    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($location_err) && empty($user_err)) {
        // Prepare an update statement

        $paramList = array();
        $sql_fields = '';
        foreach ($_POST as $name => $val) {
            if($name == 'id') {

            }else {
                if (!($name == 'tableName')) {
                    $sql_fields = ' '.$sql_fields.$name.'=?,';
                    $paramList[] = $val;
                }
            }
        }
        $paramList[] = $id;
        $tableName = trim($_POST["tableName"]);
        $sql = "UPDATE " .$tableName. " SET" .rtrim($sql_fields, ", "). " WHERE id=?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            DynamicBindVariables($stmt, $paramList);
            //$stmt->bind_param("sssi", $param_name, $param_location, $param_user, $id);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
} else {
    // Check existence of id parameter before processing further
    if ((isset($_GET["id"]) && !empty(trim($_GET["id"]))) &&
        (isset($_GET["tableName"]) && !empty(trim($_GET["tableName"])))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $tableName = trim($_GET["tableName"]);
        $sql = "SELECT * FROM " . $tableName . " WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    foreach ($data_table[$_GET["tableName"]] as $columns) {
                        $_err = '';
                        foreach ($columns as $column) {

                            $html_type = 'input';
                            $err_style = (!empty($_err)) ? 'is - invalid' : '';
                            $html = $html . sprintf('
                                                <div class="form-group">
                                                    <label>%3$s</label>
                                                    <input type="%1$s" name="%2$s" class="form-control 
                                                    %5$s" value="%4$s"/>
                                                    <span class="invalid-feedback">%6$s</span>
                                                </div>'
                            , $column['type'], $column['name'], $column['alias'], $row[$column['name']], $_err, $err_style);
                        }
                    }
                    $html = $html . '<input type="hidden" name="id" value="' . $param_id . '"/>';
                    $html = $html . '<input type="hidden" name="tableName" value="' . $_GET["tableName"] . '"/>';

                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();

        // Close connection
        $mysqli->close();
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
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
                <h2 class="mt-5">Update Record</h2>
                <p>Please edit the input values and submit to update the employee record.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                    <?php echo $html; ?>

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>