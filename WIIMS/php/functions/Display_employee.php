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
    $sql = "SELECT employees.employee_id, employees.lastname, employees.firstname, employees.middlename, employees.sex, employees.emp_address, employees.contact_number, employees.birthday FROM employees";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $employee_id = $rows['employee_id'];
            $lastname = $rows['lastname'];
            $firstname = $rows['firstname'];
            $middlename = $rows['middlename'];
            $sex =  $rows['sex'];
            $emp_address =  $rows['emp_address'];
            $contact_number =  $rows['contact_number'];
            $birthday =  $rows['birthday'];
    ?>
    <tr id='tr_<?= $username ?>' class ='tablerow'>
        <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $employee_id ?>'></td>
        <td><?= $employee_id ?></td>
        <td><?= $lastname ?></td>
        <td><?= $firstname ?></td>
        <td><?= $middlename ?></td>
        <td><?= $sex ?></td>
        <td><?= $emp_address ?></td>
        <td><?= $contact_number ?></td>
        <td><?= $birthday ?></td>
    <?php
    }
    echo "number of rows: " . $result->num_rows;
?>