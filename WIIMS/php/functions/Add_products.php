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
        $p_code = $_POST['product_code'];
        $p_name = $_POST['product_name'];
        $p_mftr = $_POST['manufacturer '];
        $p_type = $_POST['product_type'];
        $p_capcity= $_POST['capacity'];
        $p_color = $_POST['color'];
        $p_price = $_POST['price'];

        $sql = "INSERT INTO products (product_code, product_name, manufacturer, product_type, capacity, color, price) VALUES (?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssssd', $p_code, $p_name, $p_mftr, $p_type, $p_capcity, $p_color, $p_price);
        // Close connection
        if ($stmt->execute()){
            echo '<script> alert("New record created successfully"); </script>';
            header('location: /WIIMS/Products.php');
        } else {
            echo '<script> alert("Data Not Saved"); </script>'. $con->error;;
        }
        $stmt->close();
        $con->close();
    }
?>