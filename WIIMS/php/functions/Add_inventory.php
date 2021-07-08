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
    if (isset($_POST['insert'])){
        $i_code = $_POST['inventory_id'];
        $i_pcode = $_POST['product_code'];
        $i_qnty = $_POST['quantity'];
        $i_wcode = $_POST['warehouse_code'];
        $i_datec= $_POST['date_created'];
        $i_sma = $_POST['stack_max_amt'];
        $i_ais = $_POST['amt_in_stack'];
        $i_ca = $_POST['critical_amt'];

        $sql = "INSERT INTO item_inventory (inventory_id, product_code, quantity, warehouse_code, date_created, stack_max_amt, amt_in_stack,critical_amt) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isissiii', $i_code, $i_pcode, $i_qnty, $i_wcode, $i_datec, $i_sma, $i_ais, $i_ca);
        // Close connection
        if ($stmt->execute()){
            echo '<script> alert("New record created successfully"); </script>';
            header('location: /WIIMS/Inventory.php');
        } else {
            echo '<script> alert("Data Not Saved"); </script>'. $con->error;;
        }
        $stmt->close();
        $con->close();
    }
?>