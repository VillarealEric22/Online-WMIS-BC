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
    if (isset($_POST['w_code'])){
        $w_code = $_POST['w_code'];
        $w_name = $_POST['w_name'];
        $w_add = $_POST['w_add'];
        $w_area = $_POST['w_area'];
        $w_un = $_POST['w_un'];

        $sql = "UPDATE warehouses SET warehouse_name = ?, warehouse_address = ?, warehouse_area = ?, username = ? WHERE warehouse_code = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssds', $w_code, $w_name, $w_add, $w_area, $w_un);
        // Close connection
        if ($stmt->execute()){
            echo $w_code. "'s record created successfully";
        } else {
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else{
        echo "Data Not Saved". $con->error;
    }
?>