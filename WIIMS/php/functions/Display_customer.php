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
    $sql = "SELECT customer.customer_id, customer.firstname, customer.lastname, customer.c_address, customer.contact_number FROM customer";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $c_id = $rows['customer_id'];
            $firstname = $rows['firstname'];
            $lastname = $rows['lastname'];          
            $c_address =  $rows['c_address'];
            $contact_number =  $rows['contact_number'];
    ?>
    <tr id='tr_<?= $c_id ?>' class ='tablerow'>
        <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $c_id ?>'></td>
        <td><?= $c_id ?></td>
        <td><?= $firstname ?></td>
        <td><?= $lastname ?></td>
        <td><?= $c_address ?></td>
        <td><?= $contact_number ?></td>
    <?php
    }
    echo "number of rows: " . $result->num_rows;
?>