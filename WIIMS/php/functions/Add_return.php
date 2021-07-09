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
    if (isset($_POST['r_id'])){
        $r_id = $_POST['r_id'];
        $r_transac = $_POST['r_transac'];
        $r_code = $_POST['r_code'];
        $r_qty = $_POST['r_qty'];
        $r_price = $_POST['r_price'];
        $r_tprice = $_POST['r_tprice'];
        $r_type = $_POST['r_type'];
        $r_date = $_POST['r_date'];

        $sql = "INSERT INTO warehouses (return_id, transaction_no, product_code, quantity, item_price, item_tprice, return_type, return_date) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('iisiddss', $r_id, $r_transac, $r_code, $r_qty, $r_price, $r_tprice, $r_type, $r_date);
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