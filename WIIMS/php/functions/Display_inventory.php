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
    $sql = "SELECT item_inventory.inventory_id, item_inventory.product_code, item_inventory.quantity, item_inventory.warehouse_code, item_inventory.date_created, item_inventory.stack_max_amt, item_inventory.amt_in_stack, item_inventory.critical_amt FROM item_inventory";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $i_id = $rows['inventory_id'];
            $i_code = $rows['product_code'];
            $i_qty = $rows['quantity'];
            $i_wcode = $rows['warehouse_code'];           
            $i_date =  $rows['date_created'];
            $i_sma =  $rows['stack_max_amt'];
            $i_ais =  $rows['amt_in_stack'];
            $i_ca =  $rows['critical_amt'];
    ?>
    <tr id='tr_<?= $i_id ?>' class ='tablerow'>
        <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $i_id ?>'></td>
        <td><?= $i_id ?></td>
        <td><?= $i_code ?></td>
        <td><?= $i_qty ?></td>
        <td><?= $i_wcode ?></td>
        <td><?= $i_date ?></td>
        <td><?= $i_sma ?></td>
        <td><?= $i_ais ?></td>
        <td><?= $i_ca ?></td>
    <?php
    }
    echo "number of rows: " . $result->num_rows;
?>