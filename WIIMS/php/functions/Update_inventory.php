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
    if (isset($_POST['i_id'])){
        $i_id = $_POST['i_id'];
        $i_pcode = $_POST['i_pcode'];
        $i_qty = $_POST['i_qty'];
        $i_wcode = $_POST['i_wcode'];
        $i_date = $_POST['i_date'];
        $i_sma = $_POST['i_sma'];
        $i_ais = $_POST['i_ais'];
        $i_ca = $_POST['i_ca'];

        $sql = "UPDATE item_inventory SET product_code = ?, quantity= ?, warehouse_code = ?, date_created = ?, stack_max_amt = ?, amt_in_stack = ?, critical_amt = ? WHERE inventory_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isissiii', $i_id, $i_pcode, $i_qnty, $i_wcode, $i_date, $i_sma, $i_ais, $i_ca);
        // Close connection
        if ($stmt->execute()){
            echo $i_id. "'s record created successfully";
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