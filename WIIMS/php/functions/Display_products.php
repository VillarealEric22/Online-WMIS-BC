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
    $sql = "SELECT products.product_code, products.product_name, products.manufacturer, products.product_type, products.capacity, products.color, products.item_price FROM products";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $p_code = $rows['product_code'];
            $p_name = $rows['product_name'];
            $p_mnftr = $rows['manufacturer'];
            $p_type = $rows['product_type'];           
            $p_cpty =  $rows['capacity'];
            $p_color =  $rows['color'];
            $p_iprice =  $rows['item_price'];
    ?>
    <tr id='tr_<?= $p_code ?>' class ='tablerow'>
        <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $p_code ?>'></td>
        <td><?= $p_code ?></td>
        <td><?= $p_name ?></td>
        <td><?= $p_mnftr ?></td>
        <td><?= $p_type ?></td>
        <td><?= $p_cpty ?></td>
        <td><?= $p_color ?></td>
        <td><?= $p_iprice ?></td>
    <?php
    }
    echo "number of rows: " . $result->num_rows;
?>