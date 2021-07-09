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
    $sql = "SELECT item_returns.return_id, item_returns.transaction_no, item_returns.product_code, item_returns.item_price, item_returns.quantity, sales_transaction.total_price, item_returns.return_type, item_returns.return_date FROM item_returns";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $r_id = $rows['return_id'];
            $r_transac = $rows['transaction_no'];
            $r_pcode = $rows['product_code'];
            $r_iprice = $rows['item_price'];           
            $r_qty =  $rows['quantity'];
            $r_tprice =  $rows['total_price'];
            $r_type =  $rows['return_type'];
            $r_date =  $rows['return_date'];
    ?>
    <tr id='tr_<?= $r_id ?>' class ='tablerow'>
        <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $r_id ?>'></td>
        <td><?= $r_id ?></td>
        <td><?= $r_transac ?></td>
        <td><?= $r_pcode ?></td>
        <td><?= $r_iprice ?></td>
        <td><?= $r_qty ?></td>
        <td><?= $r_tprice ?></td>
        <td><?= $r_type ?></td>
        <td><?= $r_date ?></td>
    <?php
    }
    echo "number of rows: " . $result->num_rows;
?>