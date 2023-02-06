<?php
function getHtmlTable($mysqli, $sql_query, $column_array, $html_table_setting)
{
    $html_table = 'Oops! Something went wrong. Please try again later.';

    if ($result = $mysqli->query($sql_query)) {

        $html_table = '<div class="alert alert-danger"><em>No records were found.</em></div>';
        if ($result->num_rows > 0) {
            $html_tableHead_tr_layout = '';
            foreach ($column_array as [$column_name, $column_description]) {
                // logic here with $column_name and $column_description
                $html_tableHead_tr_layout = $html_tableHead_tr_layout
                    . sprintf('<th>%1$s</th>', $column_description);
            }

            if ($html_table_setting['editRow']) {
                $html_tableHead_tr_layout = $html_tableHead_tr_layout . '<th>Action</th>';
            }

            $html_tableData_tr_layout = '';
            while ($row = $result->fetch_array()) {

                $html_tableData_tr_layout = $html_tableData_tr_layout . '<tr>';
                foreach ($column_array as [$column_name, $column_description]) {
                    // logic here with $column_name and $column_description
                    $html_tableData_tr_layout = $html_tableData_tr_layout
                        . sprintf('<td>%1$s</td>', $row[$column_name]);
                }
                if ($html_table_setting['editRow']) {
                    $html_tableData_tr_layout = $html_tableData_tr_layout
                        . sprintf('
                        <td>
                            <a href="tableRow-read.php?id=%1$s&tableName=%2$s" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                            <a href="tableRow-update.php?id=%1$s&tableName=%2$s" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                            <a href="tableRow-delete.php?id=%1$s&tableName=%2$s" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                        </td>',
                            $row['id'],
                            $html_table_setting['tableName']
                        );
                }

                $html_tableData_tr_layout = $html_tableData_tr_layout . '</tr>';
            }
            $result->free();

            $html_table = sprintf('
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            %1$s
                        </tr>
                        </thead>
                        <tbody>
                            %2$s
                        </tbody>
                    </table>',
                $html_tableHead_tr_layout,
                $html_tableData_tr_layout);

        }

    }

    return $html_table;
}

?>