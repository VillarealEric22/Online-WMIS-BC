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
        $i_code = $_POST['transaction_no'];
        $i_pcode = $_POST['customer_id'];
        $i_qnty = $_POST['discount_code'];
        $i_wcode = $_POST['total_price'];
        $i_datec= $_POST['transaction_date'];

        $sql = "INSERT INTO sales_transaction (transaction_no, customer_id, discount_code, total_price, transaction_date) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isssssss', $i_code, $i_pcode, $i_qnty, $i_wcode, $i_datec, $i_sma, $i_ais, $i_ca);
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