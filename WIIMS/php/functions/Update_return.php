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
        $r_tnum = $_POST['r_tnum'];
        $r_pcode = $_POST['r_pcode'];
        $r_qty = $_POST['r_qty'];
        $r_iprice = $_POST['r_iprice'];
        $r_tprice = $_POST['r_tprice'];
        $r_rtype = $_POST['r_rtype'];
        $r_rdate = $_POST['r_rdate'];
        
        $sql = "UPDATE item_returns SET transaction_no = ?, product_code = ?, quantity = ?, item_price = ?, total_price = ?, return_type = ?, return_date = ?  WHERE return_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('iisiddss', $r_id, $r_tnum, $r_pcode, $r_qty, $r_iprice, $r_tprice, $r_rtype, $r_rdate);
        // Close connection
        if ($stmt->execute()){
            echo $r_id. "'s record created successfully";
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