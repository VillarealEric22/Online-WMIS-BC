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
    if (isset($_POST['s_id'])){
        $s_id = $_POST['s_id'];
        $s_name = $_POST['s_name'];
        $s_address = $_POST['s_address'];
        $s_cnum = $_POST['s_cnum'];

        $sql = "INSERT INTO customer (supplier_id, supplier_name, s_address, contact_number) VALUES (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isss', $s_id, $s_name, $s_address, $s_cnum);
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