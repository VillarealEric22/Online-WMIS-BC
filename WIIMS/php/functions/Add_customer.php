<?php
    //connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_inventory';
    //connect using data above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    if (isset($_POST['c_ln'])){
        $c_id = $_POST['c_id'];
        $c_fn = $_POST['c_fn']; 
        $c_ln = $_POST['c_ln'];
        $c_address = $_POST['c_address'];
        $c_cnum = $_POST['c_cnum'];

        $sql = "INSERT INTO customer (customer_id, firstname, lastname, c_address, contact_number) VALUES (?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isss', $c_id, $c_fn, $c_ln, $c_address, $c_cnum);
        // Close connection
        if ($stmt->execute()){
            echo "New record created successfully";
        } else {
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
?>