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
    $sql = "SELECT supplier.supplier_id, supplier.supplier_name, supplier.s_address, supplier.contact_number FROM supplier";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $s_id = $rows['supplier_id'];
            $s_name = $rows['supplier_name'];
            $s_add = $rows['s_address'];
            $s_num = $rows['contact_number'];           
    ?>
    <tr id='tr_<?= $s_id ?>' class ='tablerow'>
        <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $s_id ?>'></td>
        <td><?= $s_id ?></td>
        <td><?= $s_name ?></td>
        <td><?= $s_add ?></td>
        <td><?= $s_num ?></td>
    <?php
    }
    echo "number of rows: " . $result->num_rows;
?>