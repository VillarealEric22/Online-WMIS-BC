<?php
    //connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_inventory';
    //connect using data above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    $sql = "SELECT warehouses.warehouse_code, warehouses.warehouse_name, warehouses.warehouse_adress, warehouses.warehouse_area, warehouses.username FROM warehouses";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $w_code = $rows['warehouse_code'];
            $w_name = $rows['warehouse_name'];
            $w_add = $rows['warehouse_address'];
            $w_area = $rows['warehouse_area'];           
            $w_un =  $rows['username'];
    ?>
    <tr id='tr_<?= $w_code ?>' class ='tablerow'>
        <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $w_code ?>'></td>
        <td><?= $w_code ?></td>
        <td><?= $w_name ?></td>
        <td><?= $w_add ?></td>
        <td><?= $w_un ?></td>
    <?php
    }
    echo "number of rows: " . $result->num_rows;
?>