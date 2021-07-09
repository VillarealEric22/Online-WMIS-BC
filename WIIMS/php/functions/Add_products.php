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
    if (isset($_POST['p_code'])){
        $p_code = $_POST['p_code'];
        $p_name = $_POST['p_name'];
        $p_mftr = $_POST['p_mftr '];
        $p_type = $_POST['p_type'];
        $p_capcity= $_POST['p_capcity'];
        $p_color = $_POST['p_color'];
        $p_iprice = $_POST['p_iprice'];
        $p_pprice = $_POST['p_pprice'];

        $sql = "INSERT INTO products (product_code, product_name, manufacturer, product_type, capacity, color, item_price, purchase_price) VALUES (?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssssdd', $p_code, $p_name, $p_mftr, $p_type, $p_capcity, $p_color, $p_iprice, $p_pprice);
        // Close connection
        if ($stmt->execute()){
            echo "New record created successfully";
            
        } else {
            echo "Data Not Saved". $con->error;;
        }
        $stmt->close();
        $con->close();
    }
?>
